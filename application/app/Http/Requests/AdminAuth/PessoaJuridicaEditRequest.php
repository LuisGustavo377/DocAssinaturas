<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;

class PessoaJuridicaEditRequest extends FormRequest
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
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cnpj' => ['required', 'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/'],
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'tipo_de_logradouro_id' => 'required|exists:tipos_de_logradouro,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:cidades,id',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',      
        ];
    }

    public function messages(): array
    {
        return [
            'razao_social.required' => 'O campo razão social é obrigatório.',
            'razao_social.string' => 'O campo razão social deve ser uma string.',
            'razao_social.max' => 'O campo razão social não pode ter mais de 255 caracteres.',
            
            'nome_fantasia.required' => 'O campo nome fantasia é obrigatório.',
            'nome_fantasia.string' => 'O campo nome fantasia deve ser uma string.',
            'nome_fantasia.max' => 'O campo nome fantasia não pode ter mais de 255 caracteres.',
            
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.regex' => 'O CNPJ deve estar no formato xx.xxx.xxx/xxxx-xx.',

            
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de 255 caracteres.',
            
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O campo telefone deve ser uma string.',
            'telefone.max' => 'O campo telefone não pode ter mais de 20 caracteres.',
            
            'tipo_de_logradouro_id.required' => 'O campo tipo de logradouro é obrigatório.',
            'tipo_de_logradouro_id.exists' => 'O tipo de logradouro selecionado é inválido.',
            
            'logradouro.required' => 'O campo logradouro é obrigatório.',
            'logradouro.string' => 'O campo logradouro deve ser uma string.',
            'logradouro.max' => 'O campo logradouro não pode ter mais de 255 caracteres.',
            
            'numero.required' => 'O campo número é obrigatório.',
            'numero.string' => 'O campo número deve ser uma string.',
            'numero.max' => 'O campo número não pode ter mais de 20 caracteres.',
            
            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro deve ser uma string.',
            'bairro.max' => 'O campo bairro não pode ter mais de 255 caracteres.',
            
            'estado_id.required' => 'O campo estado é obrigatório.',
            'estado_id.exists' => 'O estado selecionado é inválido.',
            'cidade_id.required' => 'O campo cidade é obrigatório.',
            'cidade_id.exists' => 'A cidade selecionada é inválida.',
            
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg ou gif.',
            'imagem.max' => 'A imagem não pode ter mais de 2MB.',        
        ];
    }
}
