<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\TipoDeLogradouro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class TiposDeLogradouroController extends Controller
{
    public function index(): View
    {
        $tipos_de_logradouro = TipoDeLogradouro::paginate(20);

        return view('admin.tipos-de-logradouro.index', compact('tipos_de_logradouro'));
    }

    public function create(): View

    {
        return view('admin.tipos-de-logradouro.create');
    }

    public function store(Request $request)
    {
        try {
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $tipo_de_logradouro = new TipoDeLogradouro();                
                $tipo_de_logradouro->id = Str::uuid();
                $tipo_de_logradouro->descricao = $request->descricao;
                $tipo_de_logradouro->user_cadastro_id = auth()->id();
                $tipo_de_logradouro->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_logradouro->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-logradouro.index')->with('msg', 'Tipo de Logradouro criado com sucesso!');
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
            $tipo_de_logradouro = TipoDeLogradouro::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Logradouro não encontrado.');
        }
        return view('admin.tipos-de-logradouro.show', compact('tipo_de_logradouro'));
    }

    public function edit($id)
    {  
        try {
            $tipo_de_logradouro = TipoDeLogradouro::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Logradouro não encontrado.');
        }
        return view('admin.tipos-de-logradouro.edit', compact('tipo_de_logradouro'));
    }

    public function update (Request $request, $id)
    {
        try {
            $tipo_de_logradouro = TipoDeLogradouro::findOrFail($id);
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $tipo_de_logradouro->descricao = $request->descricao;
                $tipo_de_logradouro->user_ultima_atualizacao_id = auth()->id();
                $tipo_de_logradouro->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_logradouro->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-logradouro.index')->with('msg', 'Tipo de Logradouro alterado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = TipoDeLogradouro::where('descricao', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.tipos-de-logradouro.search', compact('resultados', 'termoPesquisa'));
    }

}