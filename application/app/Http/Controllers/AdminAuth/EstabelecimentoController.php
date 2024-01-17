<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
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

class EstabelecimentoController extends Controller
{

    public function index(): View
    {
        return view('admin.estabelecimentos.index');
    }

    
    public function create(): View
    {
        return view('admin.estabelecimentos.create');
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
                $estabelecimento->user_id = $user_id;

                // Image Upload
                if ($request->hasFile('logo') && $request->file('logotipo')->isValid()) {

                    $requestImage = $request->logo;

                    $extension = $requestImage->extension();

                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                    $requestImage->move(public_path('img/estabelecimentos'), $imageName);

                    $estabelecimento->logo = $imageName;
                }


                $estabelecimento->save();
             

                // Atualize o campo estabelecimento_id do usuário
                $user = Auth::user();
                $user->estabelecimento_id = $estabelecimento->id;
                $user->save();

                
                // Fim - Salvar Estabelecimento no Banco


                DB::commit();

                return redirect()->route('estabelecimentos.index')->with('msg', 'Estabelecimento criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

}
