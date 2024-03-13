<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\LicencaRequest as AdminAuthLicencaRequest;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\Contrato;
use App\Models\ContratoArquivo;
use App\Models\Plano;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use App\Models\Licenca;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\TipoDeRenovacao;
use App\Models\Proprietario;
use App\Http\Requests\AdminAuth\UnidadeDeNegocioRequest;
use App\Http\Requests\AdminAuth\UnidadeDeNegocioEditRequest;
use App\Http\Requests\AdminAuth\LicencaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class LicencasController extends Controller
{
    public function index(): View
    {

        $usuario = Auth::check();

        $licencas = Licenca::orderBy('descricao')->paginate(20);
        $grupos = GrupoDeNegocios::all();

        return view('admin.licencas.index', compact('licencas', 'grupos'));
    }


    public function create(): View

    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get(); // talvez ainda nem precise 
        $licencas = Licenca::orderBy('id')->get();
        $tiposDeRenovacao = TipoDeRenovacao::all();
        $planos = Plano::all();
        $contratos = Contrato::all();

        // $pessoas = $gruposDeNegocios->merge($unidades); utilizar na unidade de negócio

        return view('admin.licencas.create', compact('unidades', 'gruposDeNegocios', 'licencas', 'tiposDeRenovacao', 'contratos', 'planos'));
    }

    public function store(LicencaRequest $request){

        try {    
            $grupo = GrupoDeNegocios::where('id', $request->grupo_de_negocio_id)->first();
            $contagem_licencas_grupo = Licenca::where('grupo_de_negocio_id', $request->grupo_de_negocio_id)->count();
          
            
            if (auth()->check()) {

                // Ordem de criação no banco: Unidade, Contrato, Licença

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao',
                ];

 
                // Início - Salvar Contrato no Banco
                $contrato = new Contrato();
                $contrato->fill($request->all());
                $contrato->status = 'ativo';
                $contrato->id = Str::uuid();
                $contrato->user_cadastro_id = auth()->id();
                $nameFile = null;

                // Verificar se o arquivo está presente no formulário
                if ($request->hasFile('arquivo')) {

                    $extensao = $request->file('arquivo')->getClientOriginalExtension();

                    // Gerar um nome de arquivo único com base no ID do contrato e na extensão
                    $nameFile = $contrato->id . '.' . $extensao; // O nome do arquivo do contrato, tera o mesmo nome do ID com contrato
                    

                    // Salvar o arquivo no disk 'contratos'
                    $path = $request->file('arquivo')->storeAs('contratos', $nameFile);

                    // Salvar o nome do arquivo no objeto de contrato/ caso haja futura mudança...Não descomentar
                    // $contrato->arquivo = $nameFile;

                }
                $contrato->save();
                // Fim - Salvar Contrato no Banco


                // -- Início -- Salvar arquivos na tabela ContratosArquivos --

                $arquivo_contrato = new ContratoArquivo();
                $arquivo_contrato->id = Str::uuid();
                $arquivo_contrato->numero_contrato = $contrato->numero_contrato;
                $arquivo_contrato->arquivo = $nameFile;
                $arquivo_contrato->contrato_id = $contrato->id;
                $arquivo_contrato->user_cadastro_id = Auth::id();
                $arquivo_contrato->user_ultima_atualizacao_id = Auth::id();

                $arquivo_contrato->save();

               
                // -- Fim -- Salvar arquivos na tabela ContratosArquivos --

                // Inicio - Salvar Licenca no Banco

                $licenca = new Licenca();
                $licenca->id = Str::uuid();
                $licenca->numero_contrato = $contrato->numero_contrato;
                $licenca->descricao = $grupo->nome . '-' . $request->numero_contrato . '-' .  '00' . ($contagem_licencas_grupo + 1);
                $licenca->inicio = $request->inicio;
                $licenca->termino = $request->termino;
                $licenca->grupo_de_negocio_id = $request->grupo_de_negocio_id;
                $licenca->status = 'ativo';
                $licenca->contrato_id = $contrato->id;
                $licenca->tipo_de_renovacao_id = $request->tipo_de_renovacao;
                $licenca->user_cadastro_id = auth()->id();
                $licenca->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $licenca->save();
                //Fim - Salvar Licencca no BD

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

                // Inicio - Vincular numero da unidade a licença

                $licenca->unidade_de_negocio_id = $unidade->id;
                $licenca->save();
                // Fim - Vincular numero da unidade a licença

                DB::commit();

                return redirect()->route('admin.licencas.index')->with('msg', 'Licença criada com sucesso!');
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
            $tiposDeRenovacao = TipoDeRenovacao::all();
            $licenca = Licenca::findOrFail($id);

            $unidade_de_negocio = UnidadeDeNegocio::leftJoin('pessoa_fisica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_fisica.id')
            ->leftJoin('pessoa_juridica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_juridica.id')
            ->where('unidades_de_negocio.id', $licenca->unidade_de_negocio_id)
            ->first();

            
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Licença não encontrada.');
        }

        return view('admin.licencas.show', compact('licenca', 'tiposDeRenovacao', 'unidade_de_negocio'));
    }

    public function edit($id)
    {
        try {
            $tiposDeRenovacao = TipoDeRenovacao::all();
            $licenca = Licenca::findOrFail($id);

            $unidade_de_negocio = UnidadeDeNegocio::leftJoin('pessoa_fisica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_fisica.id')
            ->leftJoin('pessoa_juridica', 'unidades_de_negocio.pessoa_id', '=', 'pessoa_juridica.id')
            ->where('unidades_de_negocio.id', $licenca->unidade_de_negocio_id)
            ->first();
            
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Licença não encontrada.');
        }

        return view('admin.licencas.edit', compact('licenca', 'tiposDeRenovacao', 'unidade_de_negocio'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $atributosParaMaiusculas = [
                'descricao',
            ];

            $licenca = Licenca::findOrFail($id);

            if (!$licenca) {
                throw new \Exception('Licença não encontrado');
            }

            $licenca->fill($request->all());
            $licenca->user_ultima_atualizacao_id = auth()->id();
            $licenca->salvarComAtributosMaiusculos($atributosParaMaiusculas);
            $licenca->save();

            DB::commit();

            return redirect()->route('admin.licencas.index', ['id' => $licenca->id])->with('msg', 'Licença alterada com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');
        $licenca = Licenca::all();

        if (Auth::check()) {
            $resultados = Licenca::with('grupoDeNegocios')
                ->whereHas('grupoDeNegocios', function ($query) use ($termoPesquisa) {
                    $query->whereRaw("unaccent(descricao) ILIKE unaccent('%$termoPesquisa%')");
                })
                ->get();
        } else {
            $resultados = [];
        }

        return view('admin.licencas.search', compact('resultados', 'termoPesquisa', 'licenca'));
    }   


    public function inativar($id)
    {

        $licenca = Licenca::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'inativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença inativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrada.');
    }

    public function reativar($id)
    {

        $licenca = Licenca::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'ativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença reativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrada.');
    }

    public function licencasPorGrupo(Request $request)
    {
        $grupo_de_negocio_id = $request->grupo_de_negocio_id;
        $licencas = Licenca::where('grupo_de_negocio_id', $grupo_de_negocio_id)->get();
        return response()->json($licencas);
    }
}