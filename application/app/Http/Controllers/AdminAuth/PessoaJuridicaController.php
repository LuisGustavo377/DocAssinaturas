<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaJuridica;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
