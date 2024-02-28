<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeDeNegocioRequest extends FormRequest
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
            'tipoPessoaInput' => 'required',
            'licenca_id' => 'required',
            'cpfInput' => [
                'required_if:tipoPessoaInput,pf', // CPF deve ser fornecido se o tipo de pessoa for PF
                function ($attribute, $value, $fail) {
                    if ($this->input('tipoPessoaInput') == 'pf') {
                        // Remove a máscara do CPF (apenas dígitos)
                        $value = preg_replace('/[^0-9]/', '', $value);
                        $exists = DB::table('pessoa_fisica')->where('cpf', $value)->exists();
                        if (!$exists) {
                            $fail('O CPF não existe na base de dados.');
                        }
                    }
                },
            ],
            'cnpjInput' => [
                'required_if:tipoPessoaInput,pj', // CNPJ deve ser fornecido se o tipo de pessoa for PJ
                function ($attribute, $value, $fail) {
                    if ($this->input('tipoPessoaInput') == 'pj') {
                        // Remove a máscara do CNPJ (apenas dígitos)
                        $value = preg_replace('/[^0-9]/', '', $value);
                        $exists = DB::table('pessoa_juridica')->where('cnpj', $value)->exists();
                        if (!$exists) {
                            $fail('O CNPJ não existe na base de dados.');
                        }
                    }
                },
            ],
            
            'senha_temporaria' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'grupo_de_negocio_id.required' => 'O campo Grupo de Negócio é obrigatório.',
            'tipoPessoaInput.required' => 'O campo Tipo de Pessoa é obrigatório.',
            'licenca_id.required' => 'O campo Licença é obrigatório.',
            'cpfInput.exists' => 'O CPF fornecido não existe na base de dados.',
            'cnpjInput.exists' => 'O CNPJ fornecido não existe na base de dados.',
            'cpfInput.required_if' => 'O campo CPF é obrigatório.',
            'cnpjInput.required_if' => 'O campo CNPJ é obrigatório.',
            'senha_temporaria.required' => 'O campo Senha Temporária é obrigatório.',
        ];
    }
}
