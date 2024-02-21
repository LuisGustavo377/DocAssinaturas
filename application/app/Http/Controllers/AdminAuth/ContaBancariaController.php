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

        $contas = UnidadeDeNegocioContaBancaria::orderBy('numero_conta')->paginate(20);

        return view('admin.contas-bancarias.index', compact('contas'));

    }

    public function create(): View

    {   
        $bancos = Banco::orderBy('nome')->get(); 
        $unidades = UnidadeDeNegocio::all();
        dd($unidades); 
        
        
        return view('admin.contas-bancarias.create', compact('bancos'));
        
    }

    public function store(Request $request)
    {

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