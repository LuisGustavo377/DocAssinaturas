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
            'grupo_de_negocio_id' => 'required',        
            'contrato_id' => 'required|string',
            'tipo_de_renovacao' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'descricao' => 'required|string|max:255',  
            'numero_contrato' => 'required|unique:contratos',
            'arquivo' => 'nullable|file|mimes:pdf|max:20480',
            'plano_id' => 'required',      
        ];
    }

    public function messages(): array
    {
        return [

            'grupo_de_negocio_id.required' => 'Selecione um Grupo de Negócio.',
            'contrato_id.required' => 'Selecione um Contrato.',
            'tipo_de_renovacao.required' => 'Selecione o Tipo de Renovação.',
            'inicio.required' => 'O campo Início é obrigatório.',
            'termino.required' => 'O campo Término é obrigatório.',

            'descricao.max' => 'O campo descrição não pode ter mais de :max caracteres.',
            'descricao.required' => 'O campo descrição é obrigatório.',

            'numero_contrato.required' => 'O campo número do contrato é obrigatório.',
            'numero_contrato.unique' => 'O número do contrato já está em uso.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O tamanho máximo do arquivo é de 20MB.',
            'plano_id' => 'Selecione um plano',
        

        ];
    }
}
