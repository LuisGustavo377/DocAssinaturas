<?php

namespace App\Http\Requests\ProprietarioAuth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');
        
        return [
            'name' => 'required|string|max:255',
            'cpf' => [
                'required',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                function ($attribute, $value, $fail) {
                    $value = preg_replace('/[^0-9]/', '', $value);
                    $id = $this->route('id');
            
                    // Verifica se o CPF é diferente do CPF atual
                    $user = User::findOrFail($id);
                    if ($value !== $user->cpf) {
                        // Se o CPF for diferente do CPF atual, verifica se já existe no banco de dados
                        $novoCpfValidado = User::where('cpf', $value)->exists();
            
                        if ($novoCpfValidado) {
                            $fail('O CPF já existe na base de dados.');
                        }
                    }
                },
            ],

            'email' => [
                'required',
                function ($attribute, $value, $fail) {
                    
                    $id = $this->route('id');
            
                    // Verifica se o CPF é diferente do CPF atual
                    $user = User::findOrFail($id);
                    if ($value !== $user->email) {
                        // Se o CPF for diferente do CPF atual, verifica se já existe no banco de dados
                        $novoEmailValidado = User::where('email', $value)->exists();
            
                        if ($novoEmailValidado) {
                            $fail('O e-mail já existe na base de dados.');
                        }
                    }
                },
            ],
        ];
    }

    
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.regex' => 'O formato do CPF é inválido.',
            
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
        ];
    }
}
