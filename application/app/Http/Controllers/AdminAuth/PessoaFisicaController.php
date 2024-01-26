<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\PessoaFisica;
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
        return view('admin.pessoa-fisica.create');
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
