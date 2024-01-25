<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\GrupoDeNegocios;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EstabelecimentoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GrupoDeNegociosController extends Controller
{
    public function index(): View
    {
        $grupos = GrupoDeNegocios::all();
              
        // Pass the data to the view
        return view('admin.grupo-de-negocios.index', compact('grupos'));
    }


    public function create(): View
    
    {
        return view('admin.grupo-de-negocios.create');
    }

    public function store(Request $request)
    {       
     
       try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $grupo = new GrupoDeNegocios;

                $grupo->id = Str::uuid();
                $grupo->nome = $request->name;
                $grupo->observacao = $request->observacao;
                $grupo->user_cadastro_id = $user_id;    
                $grupo->save();     


                DB::commit();

                return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo de Negócio criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    
    public function show($id)
    {
        try {
            $grupo = GrupoDeNegocios::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Grupo não encontrado.');
        }
    
        return view('admin.grupo-de-negocios.show', compact('grupo'));
    }

    public function edit($id)
    {
        try {
            $grupo = GrupoDeNegocios::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Grupo não encontrado.');
        }
    
        return view('admin.grupo-de-negocios.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
    
            // Recuperando o grupo pelo ID
            $grupo = GrupoDeNegocios::findOrFail($id);
    
            if (!$grupo) {
                throw new \Exception('Grupo não encontrado');
            }
    
            // Atualizando os campos necessários       
            $grupo->nome = $request->input('name');
            $grupo->observacao = $request->input('observacao');
    
            $grupo->save();
    
            // Se todas as operações foram concluídas com sucesso, faça o commit da transação.
            DB::commit();
    
            return redirect()->route('admin.grupo-de-negocios.edit', ['id' => $grupo->id])->with('msg', 'Grupo alterado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

}
