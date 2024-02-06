<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;

class LicencaRequest extends FormRequest
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
            'grupos_de_negocio_id' => 'required',        
            'contrato_id' => 'required|string',
            'tipo_de_renovacao' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'descricao' => 'nullable|string|max:255',        
        ];
    }

    public function messages(): array
    {
        return [

            'grupos_de_negocio_id.required' => 'Selecione um Grupo de Negócio.',
            'contrato_id.required' => 'Selecione um Contrato.',
            'tipo_de_renovacao.required' => 'Selecione o Tipo de Renovação.',
            'inicio.required' => 'O campo Início é obrigatório.',
            'termino.required' => 'O campo Término é obrigatório.',

            'descricao.max' => 'O campo descrição não pode ter mais de :max caracteres.',
        

        ];
    }
}
