<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
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
            'numero_contrato' => 'required|unique:contratos',
            'arquivo' => 'nullable|file|mimes:pdf|max:20480',

        ];
    }

    public function messages(): array
    {
        return [
            'numero_contrato.required' => 'O campo número do contrato é obrigatório.',
            'numero_contrato.unique' => 'O número do contrato já está em uso.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O tamanho máximo do arquivo é de 20MB.',

        ];
    }
}
