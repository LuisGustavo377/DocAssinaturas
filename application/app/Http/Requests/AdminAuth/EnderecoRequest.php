<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
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
            'tipo_de_logradouro_id' => 'required|exists:tipos_de_logradouro,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:cidades,id',    
        ];
    }

    public function messages(): array
    {
        return [

            'tipo_de_logradouro_id.required' => 'O campo tipo de logradouro é obrigatório.',
            'tipo_de_logradouro_id.exists' => 'O tipo de logradouro selecionado é inválido.',

            'logradouro.string' => 'O campo logradouro deve ser uma string.',
            'logradouro.max' => 'O campo logradouro não deve ultrapassar 255 caracteres.',
            'logradouro.required' => 'O campo logradouro é obrigatório.',

            'numero.string' => 'O campo número deve ser uma string.',
            'numero.max' => 'O campo número não deve ultrapassar 255 caracteres.',
            'numero.required' => 'O campo número é obrigatório.',

            'complemento.string' => 'O campo complemento deve ser uma string.',
            'complemento.max' => 'O campo complemento não deve ultrapassar 255 caracteres.',

            'bairro.string' => 'O campo bairro deve ser uma string.',
            'bairro.max' => 'O campo bairro não deve ultrapassar 255 caracteres.',
            'bairro.required' => 'O campo bairro é obrigatório.',            

            'estado_id.required' => 'O campo estado é obrigatório.',
            'estado_id.exists' => 'O estado selecionado é inválido.',

            'cidade_id.required' => 'O campo cidade é obrigatório.',
            'cidade_id.exists' => 'A cidade selecionada é inválida.',
        ];
    }
}
