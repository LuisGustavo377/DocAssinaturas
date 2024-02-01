<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaFisica;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Admin;
use App\Models\Cargo;
use App\Models\TipoDeRelacionamento;
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
        $cargos = Cargo::all();  
        
        return view('admin.pessoa-fisica.create', compact('estados', 'cidades', 'cargos'));
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
    
                $pessoa = new PessoaFisica;
    
                $atributosParaMaiusculas = [
                    'nome', 
                    'tipo_de_logradouro',
                    'logradouro',
                    'complemento',
                    'bairro',
                ];              
    
                $pessoa->fill($request->all());
                $pessoa->id = Str::uuid();                
                $pessoa->user_cadastro_id = $user_id ;
                $pessoa->user_ultima_atualizacao_id = $user_id ;
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
                else{
                    $pessoa->imagem = 'imagem_padrao';
                }
    
                $pessoa->save();   
    
                // Salva telefone na tabela PessoaFisica telefones
                // $pessoa_telefone->telefone = $request->telefone; 
    
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
        return view('admin.pessoa-fisica.show', compact('pessoa'));
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