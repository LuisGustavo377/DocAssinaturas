<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaFisica;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Admin;
use App\Models\TipoDeRelacionamento;
use App\Models\TipoDeLogradouro;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
        if (Auth::check()) {
            $pessoas = PessoaFisica::orderBy('nome')->get();
        } else {
            $pessoas = [];
        }

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
                //-- Inicio - Salvar telefone na tabela pessoa_fisica_enderecos
                

   
    
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
        $pessoa = PessoaFisica::findOrFail($id);
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tipos_de_logradouro = TipoDeLogradouro::all();
        return view('admin.pessoa-fisica.show', compact('pessoa', 'estados', 'cidades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pessoa = PessoaFisica::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção
            abort(404, 'Pessoa não encontrada.');
        }
    
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tipos_de_logradouro = TipoDeLogradouro::all();

        return view('admin.pessoa-fisica.edit', compact('pessoa', 'estados', 'cidades', 'tipos_de_logradouro'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pessoa = PessoaFisica::findOrFail($id);

            if (!$pessoa) {
                throw new \Exception('Pessoa não encontrada');
            }

            $atributosParaMaiusculas = [
                'nome', 
                'tipo_de_logradouro',
                'logradouro',
                'complemento',
                'bairro',
            ]; 

            //Preenche a nova instancia com os dados do request
            $pessoa->fill($request->all()); 

            // Atualiza o campo cpf se fornecido e diferente do cpf atual
            if ($request->has('cpf') && $request->input('cpf') !== $pessoa->cpf) {
                $pessoa->cpf = $request->input('cpf');
                $validator = (new PessoaFisicaRequest)->getValidatorInstance();
                $validator->validate();        
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }     
                
            }
            else{

                // Obter regras e mensagens do PessoaFisicaRequest
                $rules = (new PessoaFisicaRequest)->rules();
                $messages = (new PessoaFisicaRequest)->messages();

                // Remover a regra unique do campo cpf
                unset($rules['cpf']);
                unset($messages['cpf.unique']);

                // Validar todos os campos, exceto o campo cpf
                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }

            $pessoa->user_ultima_atualizacao_id = auth()->id();
            $pessoa->salvarComAtributosMaiusculos($atributosParaMaiusculas);

            // Upload de Imagem
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $request->validate([
                    'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adiciona validação de imagem
                ]);

                $requestImage = $request->imagem;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage->move(public_path('img/pessoaFisica'), $imageName);
                $pessoa->imagem = $imageName;
            }

            $pessoa->save();

            DB::commit();

            return redirect()->route('admin.pessoa-fisica.index', ['id' => $pessoa->id])->with('msg', 'Pessoa Física alterada com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}