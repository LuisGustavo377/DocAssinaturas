<?php

namespace App\Http\Requests\ProprietarioAuth;

use Illuminate\Foundation\Http\FormRequest;

class EstabelecimentoRequest extends FormRequest
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
            // VALIDAÇÕES CADASTRO ESTABELECIMENTO
            'regime' => 'required',
            'name' => 'required|min:3|max:255',
            'telefone' => 'required',
            'cpf' => 'nullable|numeric|digits:11|unique:estabelecimentos',
            'cnpj' =>'nullable|numeric|digits:14|unique:estabelecimentos',
            'email' => 'required|email|unique:estabelecimentos',
            'senha_temporaria' => 'required',

            // VALIDAÇÕES FORMULARIO ENDEREÇO

            'logradouro' => 'required|min:3|max:255',
            'numero' => 'required',
            'complemento' => 'nullable',
            'bairro' => 'required|min:3|max:255',
            'estado' => 'required',
            'cidade' => 'required',

            // VALIDAÇÕES CADASTRO RESPONSAVEL ESTABELECIMENTO

            'nome_responsavel' => 'required|min:3|max:255',
            'telefone_responsavel' => 'required',
            'cpf_responsavel' => 'required|min:11|numeric',
            'email_responsavel' => 'required|email',

        ];
    }

    public function messages(): array
    {
        return [

            // VALIDAÇÕES CADASTRO ESTABELECIMENTO
            'name.required' => '*O campo Nome é obrigatório.',
            'name.min' => '*O campo Nome deve ter pelo menos 3 caracteres.',
            'name.max' => '*O campo Nome deve ter no máximo 255 caracteres.',
            'cpf.unique' => '*O CPF já está cadastrado.',
            'cpf.numeric' => '*O campo CPF aceita apenas números.',
            'cpf.digits' => '*O CPF deve conter 11 dígitos.',
            'cnpj.unique' => '*O CNPJ já está cadastrado.',
            'cnpj.numeric' => '*O campo CNPJ aceita apenas números.',
            'cnpj.digits' => '*O CNPJ deve conter 14 dígitos.',
            'telefone.required' => '*O campo Telefone é obrigatório.',
            'telefone.regex' => 'O campo Telefone deve conter apenas dígitos e ter entre 10 e 11 caracteres.',
            'email.required' => '*O campo Email é obrigatório.',
            'email.unique' => '*O Email já está cadastrado.',
            'email.email' => '*Preencha um email válido (Exemplo: email@email.com).',
            'senha_temporaria.required' => '*O campo Senha Temporária é obrigatório.',
            'regime.required' => '*Selecione o campo Regime.',

            //VALIDAÇÕES ENDEREÇO

            'logradouro.required' => '*O campo Nome é obrigatório.',
            'logradouro.min' => '*O campo Nome deve ter pelo menos 3 caracteres.',
            'logradouro.max' => '*O campo Nome deve ter no máximo 255 caracteres.',
	        'numero.required' => '*O campo Número é obrigatório.',
            'bairro.required' => '*O campo Bairro é obrigatório.',
            'estado.required' => '*O campo Estado é obrigatório.',
            'cidade.required' => '*O campo Cidade é obrigatório.',

            // VALIDAÇÕES CADASTRO RESPONSAVEL ESTABELECIMENTO

            'nome_responsavel.required' => '*O campo Nome do Responsável é obrigatório.',
            'nome_responsavel.min' => '*O campo Nome do Responsável deve ter pelo menos 3 caracteres.',
            'nome_responsavel.max' => '*O campo Nome do Responsável deve ter no máximo 255 caracteres.',
            'telefone_responsavel.required' => '*O campo Telefone é obrigatório.',
            'telefone_responsavel.numero' => 'O campo Telefone do responsável deve conter apenas dígitos e ter entre 10 e 11 caracteres.',
            'cpf_responsavel.required' => '*O campo Nome do Responsável é obrigatório.',
            'cpf_responsavel.min' => '*O campo CPF do Responsável deve ter 11 caracteres.',
            'cpf_responsavel.numeric' => '*O campo CPF aceita apenas números.',
            'email_responsavel.email' => '*Preencha um Email do responsavel válido (Exemplo: email@email.com).',
            'email_responsavel.required' => '*O campo Email do responsável é obrigatório.',

        ];
    }
}
