<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\TipoDeLogradouro;
use App\Models\PessoaFisica;
use App\Models\PessoaFisicaTelefone;
use App\Models\PessoaFisicaEndereco;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\AdminAuth\PessoaFisicaRequest;
use App\Http\Requests\AdminAuth\PessoaFisicaEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PessoaFisicaController extends Controller
{

    public function index()
    {     
        if (Auth::check()) {
            // Se o usuário estiver autenticado, recupere as pessoas físicas com seus telefones e endereços associados
            $pessoas = PessoaFisica::with('telefones', 'enderecos')->orderBy('nome')->get();
        } else {
            // Se o usuário não estiver autenticado, defina $pessoas como uma array vazia
            $pessoas = [];
        }
    
        // Passe as pessoas físicas recuperadas para a view e retorne a view
        return view('admin.pessoa-fisica.index', compact('pessoas'));
    }
    

    public function create(): View
    {        
        // Obtém todos os estados, cidades e tipos de logradouro do banco de dados
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tipos_de_logradouro = TipoDeLogradouro::all();
      
        // Retorna a view de criação com os dados dos estados, cidades e tipos de logradouro
        return view('admin.pessoa-fisica.create', compact('estados', 'cidades', 'tipos_de_logradouro'));
    }
    

    public function store(PessoaFisicaRequest $request)
    {
        try {
            // Verifica se o usuário está autenticado
            if (Auth::check()) {

                // Inicia uma transação de banco de dados
                DB::beginTransaction();
                   
    
                // Define os atributos que devem ser convertidos para maiúsculas
                $atributosParaMaiusculas = [
                    'nome', 
                    'tipo_de_logradouro',
                    'logradouro',
                    'complemento',
                    'bairro',
                ];    
                
                //-- Inicio - Salvar na Pessoa Física
                // Cria uma nova instância de PessoaFisica
                $pessoa = new PessoaFisica;
                $pessoa->id = Str::uuid();
                $pessoa->nome =  $request->nome;
                $pessoa->cpf =  $request->cpf;
                $pessoa->email =  $request->email;
                $pessoa->user_cadastro_id = Auth::id();
                $pessoa->user_ultima_atualizacao_id = Auth::id();                          
                // Aplica a função que salva os atributos em maiúsculas
                $pessoa->salvarComAtributosMaiusculos($atributosParaMaiusculas);
        
                // Verifica se uma imagem foi enviada e a processa
                if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                    $request->validate([
                        'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adiciona validação de imagem
                    ]);

                    $requestImage = $request->imagem;
                    $extension = $requestImage->getClientOriginalExtension();
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage->move(public_path('img/pessoaFisica'), $imageName);
                    $pessoa->imagem = $imageName;

                } else {
                    $pessoa->imagem = 'imagem_padrao';
                }// Fim - Upload de Imagem                   
                    
                // Salva a pessoa física no banco de dados
                $pessoa->save();

                //-- Fim - Salvar na Pessoa Física

                //-- Inicio - Salvar telefone na tabela pessoa_fisica_telefones
                // Cria uma nova instância de PessoaFisicaTelefone
                $telefone = new PessoaFisicaTelefone;
                $telefone->id = Str::uuid();
                $telefone->pessoa_fisica_id = $pessoa->id;
                $telefone->status = 'ativo'; 
                $telefone->telefone = $request->telefone;                                
                $telefone->user_cadastro_id = Auth::id();
                $telefone->user_ultima_atualizacao_id = Auth::id();
                    
                // Salva o telefone no banco de dados
                $telefone->save();
                //-- Fim - Salvar telefone na tabela pessoa_fisica_telefones

                //-- Inicio - Salvar endereço na tabela pessoa_fisica_enderecos
                // Cria uma nova instância de PessoaFisicaEndereco
                $endereco = new PessoaFisicaEndereco;
                $endereco->id = Str::uuid();
                $endereco->tipo_de_logradouro_id = $request->tipo_de_logradouro_id;
                $endereco->logradouro = $request->logradouro;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->status = 'ativo'; 
                $endereco->estado_id = $request->estado_id;
                $endereco->cidade_id = $request->cidade_id;
                $endereco->pessoa_fisica_id = $pessoa->id;                                                    
                $endereco->user_cadastro_id = Auth::id();
                $endereco->user_ultima_atualizacao_id = Auth::id();
                // Aplica a função que salva os atributos em maiúsculas
                $endereco->salvarComAtributosMaiusculos($atributosParaMaiusculas);
                    
                // Salva o endereço no banco de dados
                $endereco->save();
                //-- Inicio - Salvar endereço na tabela pessoa_fisica_endereco   
    
                // Confirma a transação
                DB::commit();
    
                // Redireciona de volta à página de índice com uma mensagem de sucesso
                return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Física criada com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverte a transação e lança a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Encontra a pessoa física pelo ID fornecido, incluindo apenas os telefones e endereços ativos
        $pessoa = PessoaFisica::with(['telefones' => function ($query) {
            $query->where('status', 'ativo');
        }, 'enderecos' => function ($query) {
            $query->where('status', 'ativo');
        }])->findOrFail($id);
               
        // Retorna a view de show com os dados da pessoa física e as listas de estados, cidades e tipos de logradouro
        return view('admin.pessoa-fisica.show', compact('pessoa'));
    }
    
    
    public function edit($id)
    {
        // Encontra a pessoa física pelo ID fornecido, incluindo apenas os telefones e endereços ativos
        $pessoa = PessoaFisica::with(['telefones' => function ($query) {
            $query->where('status', 'ativo');
        }, 'enderecos' => function ($query) {
            $query->where('status', 'ativo');
        }])->findOrFail($id);
    
        // Obtém todos os estados, cidades e tipos de logradouro
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tiposDeLogradouro = TipoDeLogradouro::all();
               
        // Retorna a view de edição com os dados da pessoa física e as listas de estados, cidades e tipos de logradouro
        return view('admin.pessoa-fisica.edit', compact('pessoa', 'estados', 'cidades', 'tiposDeLogradouro'));
    }


    public function update(PessoaFisicaEditRequest $request, $id)
    {
        try {
            // Verifica se o usuário está autenticado
            if (Auth::check()) {
                // Inicia uma transação de banco de dados
                DB::beginTransaction();
                
                // Define os atributos que devem ser convertidos para maiúsculas
                $atributosParaMaiusculas = [
                    'nome', 
                    'logradouro',
                    'complemento',
                    'bairro',
                ];    
                
                // Encontra a pessoa física pelo ID fornecido
                $pessoa = PessoaFisica::findOrFail($id);            
              
                //-- Inicio - Salvar na Pessoa Física
                
                // Atualiza os campos da pessoa física com os dados fornecidos no formulário
                $pessoa->nome =  $request->nome;
                $pessoa->cpf =  $request->cpf;
                $pessoa->email =  $request->email;
                $pessoa->user_ultima_atualizacao_id = Auth::id();              
                    
                // Verifica se uma nova imagem foi enviada e a processa
                if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                    $request->validate([
                        'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adiciona validação de imagem
                    ]);
        
                    $requestImage = $request->imagem;
                    $extension = $requestImage->getClientOriginalExtension();
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage->move(public_path('img/pessoaFisica'), $imageName);
                    $pessoa->imagem = $imageName;
        
                } 
                        
                // Salva as alterações na pessoa física
                $pessoa->salvarComAtributosMaiusculos($atributosParaMaiusculas);
                $pessoa->save();
    
                //-- Fim - Salvar na Pessoa Física

                //-- Inicio - Verificar se o telefone já existe
                $telefoneExistente = PessoaFisicaTelefone::where('pessoa_fisica_id', $pessoa->id)
                    ->where('telefone', $request->telefone)
                    ->first();

                if (!$telefoneExistente) {
                    // O telefone não existe, então crie um novo registro

                    // Define o status dos telefones existentes como 'inativo'
                    $pessoa->telefones()->update(['status' => 'inativo']);

                    // Cria um novo registro de telefone
                    $telefone = new PessoaFisicaTelefone;
                    $telefone->id = Str::uuid();
                    $telefone->pessoa_fisica_id = $pessoa->id;
                    $telefone->telefone = $request->telefone; 
                    $telefone->status = 'ativo';       
                    $telefone->user_cadastro_id = Auth::id();                         
                    $telefone->user_ultima_atualizacao_id = Auth::id();
                    $telefone->save();
                }
                //-- Fim - Verificar se o telefone já existe
    
                //-- Inicio - Verificar se o endereço já existe
                $enderecoExistente = PessoaFisicaEndereco::where('pessoa_fisica_id', $pessoa->id)
                    ->where('tipo_de_logradouro_id', $request->tipo_de_logradouro_id)
                    ->where('logradouro', $request->logradouro)
                    ->where('numero', $request->numero)
                    ->where('complemento', $request->complemento)
                    ->where('bairro', $request->bairro)
                    ->where('estado_id', $request->estado_id)
                    ->where('cidade_id', $request->cidade_id)
                    ->first();

                if (!$enderecoExistente) {
                    // Define o status dos endereços existentes como 'inativo'
                    $pessoa->enderecos()->update(['status' => 'inativo']);

                    // Cria um novo registro de endereço
                    $endereco = new PessoaFisicaEndereco;
                    $endereco->id = Str::uuid();
                    $endereco->tipo_de_logradouro_id = $request->tipo_de_logradouro_id;
                    $endereco->logradouro = $request->logradouro;
                    $endereco->numero = $request->numero;
                    $endereco->complemento = $request->complemento;
                    $endereco->bairro = $request->bairro;
                    $endereco->estado_id = $request->estado_id;
                    $endereco->cidade_id = $request->cidade_id;
                    $endereco->pessoa_fisica_id = $pessoa->id;    
                    $endereco->status = 'ativo'; 
                    $endereco->user_cadastro_id = Auth::id();                                                
                    $endereco->user_ultima_atualizacao_id = Auth::id();
                    $endereco->salvarComAtributosMaiusculos($atributosParaMaiusculas);
                    
                    $endereco->save();
                }
                //-- Fim - Verificar se o endereço já existe
        
                // Confirma a transação
                DB::commit();
        
                // Redireciona de volta à página de índice com uma mensagem de sucesso
                return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Física alterada com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverte a transação e lança a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = PessoaFisica::where('nome', 'ILIKE', "%$termoPesquisa%")
            ->orWhere('cpf', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.pessoa-fisica.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $pessoa = PessoaFisica::findOrFail($id);

        if ($pessoa) {
            $pessoa->status = 'inativo';
            $pessoa->save();

            return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Fisica inativado com sucesso.');
        }

        return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa não encontrado.');
    }

    public function reativar($id)
    {

        $pessoa = PessoaFisica::findOrFail($id);

        if ($pessoa) {
            $pessoa->status = 'ativo';
            $pessoa->save();

            return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Fisica ativada com sucesso.');
        }

        return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa não encontrado.');
    }

    
}