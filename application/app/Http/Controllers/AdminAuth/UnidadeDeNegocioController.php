<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use App\Models\Licenca;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UnidadeDeNegocioController extends Controller
{
    public function index(): View
    {
        $unidades = UnidadeDeNegocio::orderBy('id')->get();

        return view('admin.unidade-de-negocio.index', compact('unidades'));
    }


    public function create(): View
    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get();
        $licenca = Licenca::orderBy('id')->get();
        $pessoaF = PessoaFisica::all();

        return view('admin.unidade-de-negocio.create', compact('unidades', 'gruposDeNegocios', 'pessoaF'));
    }



    public function store(Request $request)
    {
        // dd($request);
        try {
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Início - Salvar Unidade de Negócio no Banco
                $unidade = new UnidadeDeNegocio();
                $unidade->fill($request->all());
                $unidade->id = Str::uuid();
                $unidade->user_cadastro_id = $user_id;
                $unidade->tipo_pessoa = $request->tipoPessoaInput;

                if ($request->tipoPessoaInput === 'pf') {
                    $unidade->pessoa_id = $request->cpfIdInput;
                    $unidade->save();

                    // Salvar o unidade_negocio_id na tabela PessoaFisica
                    $pessoaFisica = PessoaFisica::find($request->cpfIdInput);
                    if ($pessoaFisica) {
                        $pessoaFisica->unidade_de_negocio_id = $unidade->id;
                        $pessoaFisica->save();
                    }
                } elseif ($request->tipoPessoaInput === 'pj') {
                    $unidade->pessoa_id = $request->razaoSocialIdInput;
                    $unidade->save();

                    // Salvar o unidade_negocio_id na tabela PessoaJuridica
                    $pessoaJuridica = PessoaJuridica::find($request->razaoSocialIdInput);
                    if ($pessoaJuridica) {
                        $pessoaJuridica->unidade_de_negocio_id = $unidade->id;
                        $pessoaJuridica->save();
                    }
                }
                // Fim - Salvar Unidade de Negócio no Banco

                DB::commit();

                return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade de Negócio criada com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $unidade = UnidadeDeNegocio::findOrFail($id);
        $grupo = GrupoDeNegocios::where('id', $unidade->grupo_de_negocio_id)->first();
        $licenca = Licenca::where('id', $unidade->licenca_id)->first();

        if ($unidade->tipo_pessoa === 'pf') {
            $nome = $unidade->pessoaFisica->nome;
        } elseif ($unidade->tipo_pessoa === 'pj') {
            $nome = $unidade->pessoaJuridica->razao_social;
        } else {
            // Tratar caso em que tipo de pessoa é desconhecido ou inválido
            $nome = null;
        }

        return view('admin.unidade-de-negocio.show', compact('unidade', 'grupo', 'nome', 'licenca'));
    }

    public function edit($id)
    {
        try {
            $unidade = UnidadeDeNegocio::findOrFail($id);
            $grupo = GrupoDeNegocios::where('id', $unidade->grupo_de_negocio_id)->first();

            if ($unidade->tipo_pessoa === 'pf') {
                $nome = $unidade->pessoaFisica->nome;
            } elseif ($unidade->tipo_pessoa === 'pj') {
                $nome = $unidade->pessoaJuridica->razao_social;
            } else {
                // Tratar caso em que tipo de pessoa é desconhecido ou inválido
                $nome = null;
            }
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Unidade não encontrada.');
        }

        return view('admin.unidade-de-negocio.edit', compact('unidade', 'grupo', 'nome'));
    }


    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $unidade = UnidadeDeNegocio::findOrFail($id);

            if (!$unidade) {
                throw new \Exception('Unidade não encontrado');
            }

            $unidade->nome = $request->input('name');
            $unidade->observacao = $request->input('observacao');
            $unidade->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $unidade->save();

            DB::commit();

            return redirect()->route('admin.unidade-de-negocio.index', ['id' => $unidade->id])->with('msg', 'Unidade alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = UnidadeDeNegocio::where('nome', 'ILIKE', "%$termoPesquisa%")->get();
        } else {
            $resultados = [];
        }

        return view('admin.unidade-de-negocio.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'inativo';
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade inativado com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade não encontrado.');
    }

    public function reativar($id)
    {

        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'ativo';
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade reativada com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade não encontrado.');
    }

    public function licencasPorGrupo(Request $request)
    {
        $grupo_de_negocio_id = $request->grupo_de_negocio_id;
        $licencas = Licenca::where('grupo_de_negocio_id', $grupo_de_negocio_id)->get();
        return response()->json($licencas);
    }
}
