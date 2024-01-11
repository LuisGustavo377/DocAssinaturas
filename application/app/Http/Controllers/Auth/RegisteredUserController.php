<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $request->validate([
            'name' => ['required' => 'O campo nome é obrigatório.', 'string', 'max:255'],
            'email' => [
                'required' => 'O campo email é obrigatório.',
                'string',
                'lowercase',
                'email' => 'Por favor, insira um endereço de e-mail válido.',
                'max:255',
                'unique' => 'Este endereço de e-mail já está em uso.',
            ],
            'password' => [
                'required' => 'O campo senha é obrigatório.',
                'confirmed' => 'A confirmação da senha não corresponde.',
                Rules\Password::defaults(),
            ],
        ]);

        $user = new User;

        $user->id = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
