<?php

namespace App\Http\Controllers\ProprietarioAuth;

use App\Http\Controllers\Controller;
use App\Models\Proprietario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('proprietario.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Proprietario::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $proprietario = new Proprietario;

        $proprietario->id = Str::uuid();
        $proprietario->name = $request->name;
        $proprietario->email = $request->email;
        $proprietario->password = $request->password;
        $proprietario->save();

        Auth::login($proprietario);

        return redirect('/proprietario/login');
    }
}
