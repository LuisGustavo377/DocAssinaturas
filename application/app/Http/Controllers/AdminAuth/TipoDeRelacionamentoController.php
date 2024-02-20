<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\TipoDeRelacionamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class TipoDeRelacionamentoController extends Controller
{
    public function index(): View
    {
        $tipos_de_relacionamento = TipoDeRelacionamento::orderBy('descricao')->paginate(20);
        

        return view('admin.tipos-de-relacionamento.index', compact('tipos_de_relacionamento'));
    }

    public function create(): View
    {
        return view('admin.tipos-de-relacionamento.create');
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
                $tipo_de_relacionamento = new TipoDeRelacionamento();                
                $tipo_de_relacionamento->id = Str::uuid();
                $tipo_de_relacionamento->descricao = $request->descricao;
                $tipo_de_relacionamento->user_cadastro_id = auth()->id();
                $tipo_de_relacionamento->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_relacionamento->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento criado com sucesso!');
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
            $tipo_de_relacionamento = TipoDeRelacionamento::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Relacionamento não encontrado.');
        }
        return view('admin.tipos-de-relacionamento.show', compact('tipo_de_relacionamento'));
    }

    public function edit($id)
    {
        try {
            $tipo_de_relacionamento = TipoDeRelacionamento::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Tipo de Relacionamento não encontrado.');
        }
        return view('admin.tipos-de-relacionamento.edit', compact('tipo_de_relacionamento'));
    }

    public function update(Request $request, $id)
    {
        try {
            $tipo_de_relacionamento = TipoDeRelacionamento::findOrFail($id);

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $tipo_de_relacionamento->descricao = $request->descricao;
                $tipo_de_relacionamento->user_ultima_atualizacao_id = auth()->id();
                $tipo_de_relacionamento->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $tipo_de_relacionamento->save();

                DB::commit();

                return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento alterado com sucesso!');
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
            $resultados = TipoDeRelacionamento::where('descricao', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.tipos-de-relacionamento.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $tipo_de_relacionamento = TipoDeRelacionamento::findOrFail($id);

        if ($tipo_de_relacionamento) {
            $tipo_de_relacionamento->status = 'inativo';
            $tipo_de_relacionamento->save();

            return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento inativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento não encontrado.');
    }

    public function reativar($id)
    {

        $tipo_de_relacionamento = TipoDeRelacionamento::findOrFail($id);

        if ($tipo_de_relacionamento) {
            $tipo_de_relacionamento->status = 'ativo';
            $tipo_de_relacionamento->save();

            return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento reativado com sucesso.');
        }

        return redirect()->route('admin.tipos-de-relacionamento.index')->with('msg', 'Tipo de Relacionamento não encontrado.');
    }
}
