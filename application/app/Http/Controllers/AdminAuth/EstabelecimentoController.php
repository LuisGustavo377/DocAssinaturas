<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
use App\Models\EnderecoEstabelecimento;
use App\Models\ResponsavelEstabelecimento;
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

class EstabelecimentoController extends Controller
{

    public function index(): View
    {
        
        $estabelecimentos = Estabelecimento::all();
                
        // Pass the data to the view
        return view('admin.estabelecimentos.index', compact('estabelecimentos'));
    }

    
    public function create(): View
    
    {
        // Consultas iniciais
        $estados = Estado::all();
        $cidades = Cidade::all();
        $admins = Admin::all();

        return view('admin.estabelecimentos.create', compact('estados', 'cidades', 'admins'));
    }

    public function store(EstabelecimentoRequest $request)
    {       
        dd($request);
       try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Estabelecimento no Banco

                $estabelecimento = new Estabelecimento;

                $estabelecimento->nome = $request->name;
                $estabelecimento->regime = $request->regime;
                $estabelecimento->cpf = $request->cpf;
                $estabelecimento->cnpj = $request->cnpj;
                $estabelecimento->numero_telefone = $request->telefone;
                $estabelecimento->email = $request->email;
                $estabelecimento->senha = $request->senha_temporaria;
                $estabelecimento->senha_temporaria = 'sim';
                $estabelecimento->admin_id = $user_id;

                // Image Upload
                if ($request->hasFile('logotipo') && $request->file('logotipo')->isValid()) {

                    $requestImage = $request->logotipo;

                    $extension = $requestImage->extension();

                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                    $requestImage->move(public_path('img/estabelecimentos'), $imageName);

                    $estabelecimento->logo = $imageName;
                }

                $estabelecimento->save();

                
             

                // // Atualize o campo estabelecimento_id do usuário
                // $user = Auth::user();
                // $user->estabelecimento_id = $estabelecimento->id;
                // $user->save();

                
                // Fim - Salvar Estabelecimento no Banco


                DB::commit();

                return redirect()->route('admin.estabelecimento.index')->with('msg', 'Estabelecimento criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }





}