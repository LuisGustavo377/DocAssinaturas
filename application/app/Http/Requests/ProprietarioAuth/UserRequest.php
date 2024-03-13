<?php

namespace App\Http\Requests\ProprietarioAuth;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'cpf' => 'required|unique:users',
            'email' => 'required|unique:users',
            'telefone' => 'required',
            'senha_temporaria' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'O CPF já está em uso.',
            'email.unique' => 'O email já está em uso.',
            'email.required' => 'O campo email é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'senha_temporaria.required' => 'O campo Senha Temporária é obrigatório.',
        ];
    }
}
