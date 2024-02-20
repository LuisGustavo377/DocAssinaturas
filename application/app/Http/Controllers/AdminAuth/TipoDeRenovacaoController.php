<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\TipoDeRenovacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class TipoDeRenovacaoController extends Controller
{
    public function index(): View
    {
        $tipos_de_renovacao = TipoDeRenovacao::orderBy('descricao')->paginate(20);
        

        return view('admin.tipos-de-renovacao.index', compact('tipos_de_renovacao'));
    }

    public function create(): View
    {
        return view('admin.tipos-de-renovacao.create');
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
                $tipos_de_renovacao = new TipoDeRenovacao();                
                $tipos_de_renovacao->id = Str::uuid();
                $tipos_de_renovacao->descricao = $request->descricao;
                $tipos_de_renovacao->user_cadastro_id = auth()->id();
                $tipos_de_renovacao->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipos_de_renovacao->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação criado com sucesso!');
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
            $tipo_de_renovacao = TipoDeRenovacao::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Renovacao não encontrado.');
        }
        return view('admin.tipos-de-renovacao.show', compact('tipo_de_renovacao'));
    }

    public function edit($id)
    {
        try {
            $tipo_de_renovacao = TipoDeRenovacao::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Renovação não encontrado.');
        }
        return view('admin.tipos-de-renovacao.edit', compact('tipo_de_renovacao'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tipo_de_renovacao = TipoDeRenovacao::findOrFail($id);

            if (auth()->check()) {
                
                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $tipo_de_renovacao->descricao = $request->descricao;
                $tipo_de_renovacao->user_ultima_atualizacao_id = auth()->id();
                $tipo_de_renovacao->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_renovacao->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação alterado com sucesso!');
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
            $resultados = TipoDeRenovacao::where('descricao', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.tipos-de-renovacao.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $tipo_de_renovacao = TipoDeRenovacao::findOrFail($id);

        if ($tipo_de_renovacao) {
            $tipo_de_renovacao->status = 'inativo';
            $tipo_de_renovacao->save();

            return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação inativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação não encontrado.');
    }

    public function reativar($id)
    {

        $tipo_de_renovacao = TipoDeRenovacao::findOrFail($id);

        if ($tipo_de_renovacao) {
            $tipo_de_renovacao->status = 'ativo';
            $tipo_de_renovacao->save();

            return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação reativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-renovacao.index')->with('msg', 'Tipo de Renovação não encontrado.');
    }
}
