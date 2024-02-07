<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\TipoDeLogradouro;
use App\Models\PessoaJuridica;
use App\Models\PessoaJuridicaTelefone;
use App\Models\PessoaJuridicaEndereco;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\AdminAuth\PessoaFisicaRequest;
use App\Http\Requests\AdminAuth\PessoaFisicaEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PessoaJuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $pessoas = PessoaJuridica::orderBy('razao_social')->get();
        } else {
            $pessoas = [];
        }

        return view('admin.pessoa-juridica.index', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtém todos os estados, cidades e tipos de logradouro do banco de dados
        $estados = Estado::all();
        $cidades = Cidade::all();
        $tipos_de_logradouro = TipoDeLogradouro::all();
        
        // Retorna a view de criação com os dados dos estados, cidades e tipos de logradouro
        return view('admin.pessoa-juridica.create', compact('estados', 'cidades', 'tipos_de_logradouro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(PessoaJuridica $pessoaJuridica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PessoaJuridica $pessoaJuridica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaJuridica $pessoaJuridica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PessoaJuridica $pessoaJuridica)
    {
        //
    }
}