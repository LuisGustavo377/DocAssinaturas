<?php

namespace App\Http\Requests\ProprietarioAuth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
                Rule::unique('users', 'cpf')->ignore($userId),

            ],
            'email' => 'required|email|unique:users,email,' . $userId,
            'telefone' => 'required|string|max:20',
            'senha_temporaria' => 'required|string|min:8',
            'nova_senha' => 'nullable|string|min:8|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.regex' => 'O formato do CPF é inválido.',
            'cpf.unique' => 'O CPF está já em uso.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.unique' => 'O email já está em uso.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',

            'senha_temporaria.required' => 'O campo Senha Temporária é obrigatório.',
            'senha_temporaria.min' => 'A senha temporária deve ter pelo menos 8 caracteres.',
            'nova_senha.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'nova_senha.confirmed' => 'A confirmação da nova senha não corresponde.',
        ];
    }
}
