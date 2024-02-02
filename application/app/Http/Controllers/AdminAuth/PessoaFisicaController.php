<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaFisica;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Admin;
use App\Models\TipoDeRelacionamento;
use App\Models\TipoDeLogradouro;
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
    public function store(Request $request)
    {
        try {
            if (Auth::check()) {

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
                $pessoa->user_cadastro_id = Auth::id();
                $pessoa->user_ultima_atualizacao_id = Auth::id();
                $pessoa->salvarComAtributosMaiusculos($atributosParaMaiusculas);
    
                // Inicio - Upload de Imagem
                if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                    $request->validate([
                        'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adiciona validação de imagem
                    ]);

                    $requestImage = $request->imagem;
                    $extension = $requestImage->extension();
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                    // Salva a imagem original
                    $requestImage->move(public_path('img/pessoaFisica'), $imageName);

                    // Redimensiona a imagem para um tamanho específico
                    $resizedImage = Image::make(public_path('img/pessoaFisica') . '/' . $imageName)
                        ->fit(100, 100) // Tamanho desejado
                        ->save();

                    $pessoa->imagem = $imageName;
                } else {
                    $pessoa->imagem = 'imagem_padrao';
                }
                
                // Fim - Upload de Imagem


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

            $pessoa->fill($request->all());
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
            else{
                $pessoa->imagem = 'imagem_padrao';
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