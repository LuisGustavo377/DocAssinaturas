<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Admin;
use App\Models\TipoDeRelacionamento;
use App\Models\TipoDeLogradouro;
use App\Models\PessoaFisica;
use App\Models\PessoaFisicaTelefone;
use App\Models\PessoaFisicaEndereco;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AdminAuth\PessoaFisicaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


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
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    
    {        
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tipos_de_logradouro = TipoDeLogradouro::all();
      
        return view('admin.pessoa-fisica.create', compact('estados', 'cidades', 'tipos_de_logradouro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PessoaFisicaRequest $request)
    {

        try {
            if (Auth::check()) {

                DB::beginTransaction();
                   
    
                $atributosParaMaiusculas = [
                    'nome', 
                    'tipo_de_logradouro',
                    'logradouro',
                    'complemento',
                    'bairro',
                ];    
                
                //-- Inicio - Salvar na Pessoa Física
                    $pessoa = new PessoaFisica;
                    $pessoa->id = Str::uuid();
                    $pessoa->nome =  $request->nome;
                    $pessoa->cpf =  $request->cpf;
                    $pessoa->email =  $request->email;
                    $pessoa->user_cadastro_id = Auth::id();
                    $pessoa->user_ultima_atualizacao_id = Auth::id();                          
                    $pessoa->salvarComAtributosMaiusculos($atributosParaMaiusculas);
        
                    // Inicio - Upload de Imagem
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
                    
                    $pessoa->save();//Salva no banco PessoaFisica

                //-- Fim - Salvar na Pessoa Física

                //-- Inicio - Salvar telefone na tabela pessoa_fisica_telefones
                    $telefone = new PessoaFisicaTelefone;
                    $telefone->id = Str::uuid();
                    $telefone->pessoa_fisica_id = $pessoa->id;
                    $telefone->telefone = $request->telefone;                                
                    $telefone->user_cadastro_id = Auth::id();
                    $telefone->user_ultima_atualizacao_id = Auth::id();
                    
                    $telefone->save();
                //-- Fim - Salvar telefone na tabela pessoa_fisica_telefones

                //-- Inicio - Salvar telefone na tabela pessoa_fisica_enderecos
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
                    $endereco->user_cadastro_id = Auth::id();
                    $endereco->user_ultima_atualizacao_id = Auth::id();
                    $endereco->salvarComAtributosMaiusculos($atributosParaMaiusculas);
                    
                    $endereco->save();
                //-- Inicio - Salvar telefone na tabela pessoa_fisica_endereco   
    
                DB::commit();
    
                return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Física criada com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pessoa = PessoaFisica::with('telefones', 'enderecos')->findOrFail($id);
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tiposDeLogradouro = TipoDeLogradouro::all();
        return view('admin.pessoa-fisica.show', compact('pessoa', 'estados', 'cidades', 'tiposDeLogradouro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pessoa = PessoaFisica::with('telefones', 'enderecos')->findOrFail($id);
            $estados = Estado::all();
            $cidades = Cidade::all();
            $tipos_de_logradouro = TipoDeLogradouro::all();

        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção
            abort(404, 'Pessoa não encontrada.');
        }

        return view('admin.pessoa-fisica.edit', compact('pessoa', 'estados', 'cidades', 'tipos_de_logradouro'));
    }
    

    public function update(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                DB::beginTransaction();
    
                // Recupere a pessoa que você deseja atualizar
                $pessoa = PessoaFisica::findOrFail($id);                   
        
                $atributosParaMaiusculasPessoa = [
                    'nome', 
                ];    

                $atributosParaMaiusculasEndereco = [
                    'logradouro',
                    'complemento',
                    'bairro',
                ];
                
                //-- Inicio - Salvar na Pessoa Física
                $pessoa->nome =  $request->nome;
                $pessoa->cpf =  $request->cpf;
                $pessoa->email =  $request->email;
                $pessoa->user_ultima_atualizacao_id = Auth::id();                          
                    
                // Inicio - Upload de Imagem
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
                        
                $pessoa->save();//Salva no banco PessoaFisica
    
                //-- Fim - Salvar na Pessoa Física
    
                //-- Inicio - Salvar telefone na tabela pessoa_fisica_telefones
                $telefone = new PessoaFisicaTelefone;
                $telefone->id = Str::uuid();
                $telefone->pessoa_fisica_id = $pessoa->id;
                $telefone->telefone = $request->telefone; 
                $telefone->status = 'ativo';       
                $telefone->user_cadastro_id = Auth::id();                         
                $telefone->user_ultima_atualizacao_id = Auth::id();
                $telefone->save();
            //-- Fim - Salvar telefone na tabela pessoa_fisica_telefones
    
                //-- Inicio - Salvar telefone na tabela pessoa_fisica_enderecos
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
                
                $endereco->save();
                //-- Inicio - Salvar telefone na tabela pessoa_fisica_endereco   
        
                DB::commit();
        
                return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Física alterada com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }
    
}