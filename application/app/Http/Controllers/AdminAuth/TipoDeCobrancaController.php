<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\TipoDeCobranca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class TipoDeCobrancaController extends Controller
{
    public function index(): View
    {
        $tipos_de_cobranca = TipoDeCobranca::orderBy('descricao')->paginate(10);

        return view('admin.tipos-de-cobranca.index', compact('tipos_de_cobranca'));
    }

    public function create(): View
    {
        return view('admin.tipos-de-cobranca.create');
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
                $tipo_de_cobranca = new TipoDeCobranca();                
                $tipo_de_cobranca->id = Str::uuid();
                $tipo_de_cobranca->descricao = $request->descricao;
                $tipo_de_cobranca->user_cadastro_id = auth()->id();
                $tipo_de_cobranca->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_cobranca->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança criado com sucesso!');
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
            $tipo_de_cobranca = TipoDeCobranca::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Cobrança não encontrado.');
        }
        return view('admin.tipos-de-cobranca.show', compact('tipo_de_cobranca'));
    }

    public function edit($id)
    {  
        try {
            $tipo_de_cobranca = TipoDeCobranca::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Cobrança não encontrado.');
        }
        return view('admin.tipos-de-cobranca.edit', compact('tipo_de_cobranca'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tipo_de_cobranca = TipoDeCobranca::findOrFail($id);
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $tipo_de_cobranca->descricao = $request->descricao;
                $tipo_de_cobranca->user_ultima_atualizacao_id = auth()->id();
                $tipo_de_cobranca->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_cobranca->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança alterado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function inativar($id)
    {

        $tipo_de_cobranca = TipoDeCobranca::findOrFail($id);

        if ($tipo_de_cobranca) {
            $tipo_de_cobranca->status = 'inativo';
            $tipo_de_cobranca->save();

            return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança inativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança não encontrado.');
    }

    public function reativar($id)
    {

        $tipo_de_cobranca = TipoDeCobranca::findOrFail($id);

        if ($tipo_de_cobranca) {
            $tipo_de_cobranca->status = 'ativo';
            $tipo_de_cobranca->save();

            return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança reativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-cobranca.index')->with('msg', 'Tipo de Cobrança não encontrado.');
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = TipoDeCobranca::whereRaw("unaccent(descricao) ILIKE unaccent('%$termoPesquisa%')")
            ->get();
        
        } else {
            $resultados = [];
        }

        return view('admin.tipos-de-cobranca.search', compact('resultados', 'termoPesquisa'));
    }

}
