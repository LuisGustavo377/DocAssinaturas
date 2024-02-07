<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;

class PlanosRequest extends FormRequest
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
            'nome' => 'required|unique:planos',
            'valor' => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome do plano é obrigatório.',
            'valor.required' => 'O campo valor é obrigatório.',

        ];
    }
}
