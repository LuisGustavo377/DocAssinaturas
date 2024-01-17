<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estabelecimento;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        dd($request);
    }

}
