<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaFisica;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EstabelecimentoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
     
        
        return view('admin.pessoa-fisica.create', compact('estados', 'cidades'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (Auth::check()) {
                $user_id = Auth::id(); // Recupera o ID do usuário da sessão
    
                DB::beginTransaction();
    
                // Inicio - Salvar Grupo no Banco
    
                $pessoa = new PessoaFisica;
    
                $pessoa->id = Str::uuid();
                $pessoa->tipo_relacionamento = $request->tipo_de_logradouro;
                $pessoa->nome = $request->nome; 
                $pessoa->cpf = $request->cpf; 
                $pessoa->email = $request->email; 
                $pessoa->tipo_logradouro = $request->tipo_de_logradouro;               
                $pessoa->logradouro = $request->logradouro;
                $pessoa->numero = $request->numero;
                $pessoa->complemento = $request->complemento;
                $pessoa->bairro = $request->bairro;
                $pessoa->estado_id = $request->estado_id;
                $pessoa->cidade_id = $request->cidade_id;
                $pessoa->imagem = $request->imagem;

                // Dados Necessários quando a pessoa for Funcionário
                $pessoa->rg = $request->rg;
                $pessoa->data_de_nascimento = $request->data_de_nascimento;
                $pessoa->estado_civil = $request->estado_civil;
                $pessoa->nacionalidade = $request->nacionalidade;
                $pessoa->nome_da_mae = $request->nome_da_mae;
                $pessoa->nome_do_pai = $request->nome_do_pai;
                $pessoa->titulo_de_eleitor = $request->titulo_de_eleitor;
                $pessoa->numero_pis_pasep = $request->numero_pis_pasep;
                $pessoa->escolaridade = $request->escolaridade;
                $pessoa->cargo_id = $request->cargo_id;
                // Fim Dados Necessários quando a pessoa for Funcionário
                $pessoa->tipo_relacionamento_id = $request->tipo_relacionamento_id;
                $pessoa->user_cadastro_id = $user_id ;
                $pessoa->user_ultima_atualizacao_id = $user_id ;
                $pessoa->save();   
                
                // //Salva telefone na tabela PessoaFisica telefones

                // $pessoa_telefone->telefone = $request->telefone; 
    
                DB::commit();
    
                return redirect()->route('admin.pessoa-fisica.index')->with('msg', 'Pessoa Física criado com sucesso!');
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
    public function show(PessoaFisica $pessoaFisica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PessoaFisica $pessoaFisica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaFisica $pessoaFisica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PessoaFisica $pessoaFisica)
    {
        //
    }
}