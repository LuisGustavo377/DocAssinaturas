<?php

namespace App\Http\Requests;

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
            'telefone' => [
                'required',
                function ($attribute, $value, $fail) {
                    $digitsOnly = preg_replace('/[^0-9]/', '', $value); // Remove caracteres especiais
                    if (strlen($digitsOnly) < 10 || strlen($digitsOnly) > 11) {
                        $fail('O número de telefone deve conter entre 10 e 11 dígitos.');
                    }
                },
            ],
            'cpf' => 'required|regex:/^\d{11}$/|unique:estabelecimentos',
            'cnpj' => 'required|regex:/^\d{14}$/|unique:estabelecimentos',
            'email' => 'required|email|unique:estabelecimentos',
            'senha_temporaria' => 'required',
            // 'logradouro' => 'required|max:255',
            // 'numero' => 'required',
            // 'complemento' => 'nullable',
            // 'estado' => 'required',
            // 'cidade' => 'required',

            // VALIDAÇÕES CADASTRO RESPONSAVEL ESTABELECIMENTO

            // 'nome_responsavel' => 'required|min:3|max:255',
            // 'numero_telefone_responsavel' => [
            //     'nullable',
            //     function ($attribute, $value, $fail) {
            //         $digitsOnly = preg_replace('/[^0-9]/', '', $value); // Remove caracteres especiais
            //         if (strlen($digitsOnly) < 10 || strlen($digitsOnly) > 11) {
            //             $fail('O número de telefone deve conter entre 10 e 11 dígitos.');
            //         }
            //     },
            // ],
            // 'cpf_responsavel' => 'min:11|numeric',
            // 'email_responsavel' => 'required|email',

        ];
    }

    public function messages(): array
    {
        return [

            // VALIDAÇÕES CADASTRO ESTABELECIMENTO
            'name.required' => '*O campo Nome é obrigatório.',
            'name.min' => '*O campo Nome deve ter pelo menos 3 caracteres.',
            'name.max' => '*O campo Nome deve ter no máximo 255 caracteres.',
            'cpf.required' => '*O campo CPF é obrigatório.',
            'cpf.unique' => '*O CPF já está cadastrado.',
            'cpf.min' => '*O campo CPF deve conter 11 números.',
            'cpf.max' => '*O campo CPF deve ter 11 números.',

            'cnpj.required' => '*O campo CNPJ é obrigatório.',
            'cnpj.unique' => '*O CNPJ já está cadastrado.',
            'cnpj.min' => '*O campo CNPJ deve ter 14 números.',
            'cnpj.max' => '*O campo CNPJ deve ter 14 números.',
            'cnpj.integer' => '*O campo CNPJ deve conter apenas números.',
            'telefone.required' => '*O campo Telefone é obrigatório.',
            'telefone.regex' => 'O campo Telefone deve conter apenas dígitos e ter entre 10 e 11 caracteres.',
            'email.required' => '*O campo Email é obrigatório.',
            'email.unique' => '*O Email já está cadastrado.',
            'email.email' => '*Preencha um email válido (Exemplo: email@email.com).',
            'senha_temporaria.required' => '*O campo Senha Temporária é obrigatório.',
            'regime.required' => '*Selecione o campo Regime.',

            // VALIDAÇÕES CADASTRO RESPONSAVEL ESTABELECIMENTO

            // 'nome_responsavel.required' => '*O campo Nome do Responsável é obrigatório.',
            // 'nome_responsavel.min' => '*O campo Nome do Responsável deve ter pelo menos 3 caracteres.',
            // 'nome_responsavel.max' => '*O campo Nome do Responsável deve ter no máximo 255 caracteres.',
            // 'numero_telefone_responsavel.required' => '*O campo Número do Responsável de telefone é obrigatório.',
            // 'numero_telefone_responsavel.regex' => 'O Número de telefone do responsável deve conter apenas dígitos e ter entre 10 e 11 caracteres.',
            // 'cpf_responsavel.min' => '*O campo CPF do Responsável deve ter 11 caracteres.',
            // 'cpf_responsavel.numeric' => '*O campo CPF aceita apenas números.',
            // 'email_responsavel.email' => '*Preencha um Email do responsavel válido (Exemplo: email@email.com).',
            // 'email_responsavel.request' => '*O campo Email do responsável é obrigatório.',

        ];
    }
}
