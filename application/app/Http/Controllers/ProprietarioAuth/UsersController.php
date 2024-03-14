<?php

namespace App\Http\Controllers\ProprietarioAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\GruposDeNegocioRequest;
use App\Http\Requests\ProprietarioAuth\UserEditRequest;
use App\Http\Requests\ProprietarioAuth\UserRequest;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; 

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view('proprietario.users.index', compact('users'));
    }


    public function create(): View

    {
        return view('proprietario.users.create');
    }

    public function store(UserRequest $request)
    {

        try {

            if (auth()->check()) {
                
                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $user = new User();

                $user->fill($request->all());
                $user->id = Str::uuid();
                $user->user_cadastro_id = auth()->id(); // Recupera o ID do usuário da sessão
                $user->password = $request->senha_temporaria;
                $user->password_temp = 'true';
                $user->save();


                DB::commit();

                return redirect()->route('proprietario.users.index')->with('msg', 'Usuário criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('proprietario.users.show', compact('user'));
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: User não encontrado
            abort(404, 'Usuário não encontrado.');
        }

        return view('proprietario.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();
    
            $user = User::findOrFail($id);
    
            if (!$user) {
                throw new \Exception('Usuário não encontrado');
            }
            
            $user->fill($request->all());
            $user->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            
            $user->save();
            
            DB::commit();
            
            return redirect()->route('proprietario.users.index')->with('msg', 'Usuário alterado com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {

            $resultados = User::whereRaw("unaccent(name) ILIKE unaccent('%$termoPesquisa%')")
                ->orWhereRaw("unaccent(name) ILIKE unaccent('%$termoPesquisa%')")
                ->get();
        } else {
            $resultados = [];
        }


        return view('proprietario.users.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $user = User::findOrFail($id);

        if ($user) {
            $user->status = 'inativo';
            $user->save();

            return redirect()->route('proprietario.users.index')->with('msg', 'Usuário inativado com sucesso.');
        }

        return redirect()->route('proprietario.users.index')->with('msg', 'Usuário não encontrado.');
    }

    public function reativar($id)
    {

        $user = User::findOrFail($id);

        if ($user) {
            $user->status = 'ativo';
            $user->save();

            return redirect()->route('proprietario.users.index')->with('msg', 'Usuário reativado com sucesso.');
        }

        return redirect()->route('proprietario.users.index')->with('msg', 'Usuário não encontrado.');
    }
}
