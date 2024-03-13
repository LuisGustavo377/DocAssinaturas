<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\UnidadeDeNegocioRequest;
use App\Http\Requests\AdminAuth\UnidadeDeNegocioEditRequest;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use App\Models\Licenca;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\Proprietario;
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
        $unidades = UnidadeDeNegocio::orderBy('id')->paginate(20);
        return view('admin.unidade-de-negocio.index', compact('unidades'));
    }


    public function create(): View
    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get();
        $pessoaF = PessoaFisica::all();

        return view('admin.unidade-de-negocio.create', compact('unidades', 'gruposDeNegocios', 'pessoaF'));
    }



    public function store(UnidadeDeNegocioRequest $request)
    {
        try {
            if (auth()->check()) {

                DB::beginTransaction();

                // Início - Salvar Unidade de Negócio no Banco
                $unidade = new UnidadeDeNegocio();
                $unidade->id = Str::uuid();
                $unidade->grupo_de_negocio_id = $request->grupo_de_negocio_id;
                $unidade->licenca_id = $licenca->id;
                $unidade->user_cadastro_id = auth()->id();
                $unidade->tipo_pessoa = $request->tipoPessoaInput;

                if ($request->tipoPessoaInput === 'pf') {
                                        // Salvar o unidade_negocio_id na tabela PessoaFisica
                    $pessoaFisicaCpfInput = preg_replace('/[^0-9]/', '', $request->cpfInput);
                    $pessoaFisica = PessoaFisica::where('cpf', $pessoaFisicaCpfInput)->first();
                    $unidade->pessoa_id = $pessoaFisica->id;
                    $unidade->save();


                    if ($pessoaFisica) {
                        $pessoaFisica->unidade_de_negocio_id = $unidade->id;
                        $pessoaFisica->save();

                        // Obter o e-mail da pessoa física
                        $email = $pessoaFisica->email;
                        $cpf_cnpj = $pessoaFisica->cpf;

                        // Criar um novo proprietário para pessoa física
                        $proprietario = new Proprietario();
                        $proprietario->id = Str::uuid();
                        $proprietario->pessoa_id = $pessoaFisica->id;
                        $proprietario->unidade_de_negocio_id = $unidade->id;
                        $proprietario->name = $pessoaFisica->nome;
                        $proprietario->cpf_cnpj = $cpf_cnpj;
                        $proprietario->email = $email;
                        $proprietario->password = $request->senha_temporaria;
                        $proprietario->password_temp = 'true';
                        $proprietario->user_cadastro_id = Auth::id();
                        $proprietario->user_ultima_atualizacao_id = Auth::id();
                        
                        $proprietario->save();
                    }
                } elseif ($request->tipoPessoaInput === 'pj') {
                    $pessoaJuridicaCnpjInput = preg_replace('/[^0-9]/', '', $request->cnpjInput);
                    $pessoaJuridica = PessoaJuridica::where('cnpj', $pessoaJuridicaCnpjInput)->first();
                    $unidade->pessoa_id = $pessoaJuridica->id;
                    $unidade->save();

                    // Salvar o unidade_negocio_id na tabela PessoaJuridica
                    $pessoaJuridica = PessoaJuridica::find($request->razaoSocialIdInput);

                    if ($pessoaJuridica) {
                        $pessoaJuridica->unidade_de_negocio_id = $unidade->id;
                        $pessoaJuridica->save();

                        // Obter o e-mail da pessoa jurídica
                        $email = $pessoaJuridica->email;
                        $cpf_cnpj = $pessoaJuridica->cnpj;

                        // Criar um novo proprietário para pessoa jurídica
                        $proprietario = new Proprietario();
                        $proprietario->id = Str::uuid();
                        $proprietario->pessoa_id = $pessoaJuridica->id;
                        $proprietario->unidade_de_negocio_id = $unidade->id;
                        $proprietario->name = $pessoaJuridica->razao_social;
                        $proprietario->email = $email;
                        $proprietario->cpf_cnpj = $cpf_cnpj;
                        $proprietario->password = $request->senha_temporaria;
                        $proprietario->password_temp = 'true';
                        $proprietario->user_cadastro_id = Auth::id();
                        $proprietario->user_ultima_atualizacao_id = Auth::id();
                        $proprietario->save();
                    }
                }
                // Fim - Salvar Unidade de Negocio no BD
                

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

        return view('admin.unidade-de-negocio.show', compact('unidade', 'grupo', 'licenca'));
    }

    public function edit($id)
    {
        try {
            $unidade = UnidadeDeNegocio::findOrFail($id);
            $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
            $licenca = Licenca::where('id', $unidade->licenca_id)->first();
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Unidade não encontrada.');
        }

        return view('admin.unidade-de-negocio.edit', compact('unidade', 'gruposDeNegocios', 'licenca'));
    }


    public function update(UnidadeDeNegocioEditRequest $request, $id)
    {
        try {

            $unidade_id = $id;

            DB::beginTransaction();

            $unidade = UnidadeDeNegocio::findOrFail($id);

            if (!$unidade) {
                throw new \Exception('Unidade não encontrado');
            }

            $unidade->fill($request->only(['grupo_de_negocio_id', 'licenca_id']));
            $unidade->user_ultima_atualizacao_id = auth()->id();

            if($request->senha_temporaria !==null){
                $proprietario = Proprietario::where('unidade_de_negocio_id', $id)->firstOrFail();
                $proprietario->password = $request->senha_temporaria;
                $proprietario->password_temp = 'true';
                $proprietario->save();

            }

            $unidade->save();

            DB::commit();

            return redirect()->route('admin.unidade-de-negocios.index', ['id' => $unidade->id])->with('msg', 'Unidade alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (strlen($termoPesquisa) >= 3) {
            if (Auth::check()) {
                $resultados = DB::table('unidades_de_negocio')
                    ->leftJoin('pessoa_fisica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_fisica.id')
                    ->leftJoin('pessoa_juridica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_juridica.id')
                    ->where(function ($query) use ($termoPesquisa) {
                        $query->whereRaw("unaccent(pessoa_fisica.nome) ILIKE unaccent('%$termoPesquisa%')")
                            ->orWhereRaw("unaccent(pessoa_juridica.razao_social) ILIKE unaccent('%$termoPesquisa%')");
                    })
                    ->select('unidades_de_negocio.id', 'unidades_de_negocio.status', 'pessoa_fisica.nome', 'pessoa_juridica.razao_social')
                    ->get();
            } else {
                $resultados = [];
            }
        } else {
            $resultados = [];
        }

        return view('admin.unidade-de-negocio.search', compact('resultados', 'termoPesquisa'));
    }



    public function inativar($id)
    {
        $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'inativo';
            $unidade->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade inativado com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade não encontrado.');
    }

    public function reativar($id)
    {
        $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'ativo';
            $unidade->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade reativada com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade não encontrado.');
    }

    public function licencasPorGrupo(Request $request)
    {
        $grupo_de_negocio_id = $request->grupo_de_negocio_id;
        $licencas = Licenca::where('grupo_de_negocio_id', $grupo_de_negocio_id)->get();
        return response()->json($licencas);
    }
}