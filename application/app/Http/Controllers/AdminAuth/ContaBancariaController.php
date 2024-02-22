<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\UnidadeDeNegocioContaBancaria;
use App\Models\UnidadeDeNegocio;
use App\Models\Banco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class ContaBancariaController extends Controller
{
    public function index(): View
    {
        $bancos = Banco::orderBy('nome')->get(); 
        $unidades = UnidadeDeNegocio::all();
        $contas = UnidadeDeNegocioContaBancaria::orderBy('numero_conta')->paginate(20);

        return view('admin.contas-bancarias.index', compact('contas'));

    }

    public function create(): View

    {   
        $bancos = Banco::orderBy('nome')->get(); 
        $unidades = UnidadeDeNegocio::all();
              
        return view('admin.contas-bancarias.create', compact('bancos', 'unidades'));
        
    }

    public function store(Request $request)
    {
        
        try {
            if (auth()->check()) {

                DB::beginTransaction();


                // Início - Salvar Plano no Banco
                $conta = new UnidadeDeNegocioContaBancaria();                
                $conta->id = Str::uuid();
                $conta->fill($request->all());
                $conta->unidade_de_negocio_id = $request->unidade_de_negocio_id;
                $conta->user_cadastro_id = auth()->id();
                $conta->save();

                DB::commit();

                return redirect()->route('admin.contas-bancarias.index')->with('msg', 'Conta Bancaria criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update (Request $request, $id)
    {
        
    }
    public function inativar($id)
    {

    }

    public function reativar($id)
    {

     
    }

    public function search(Request $request)
    {

    }

}