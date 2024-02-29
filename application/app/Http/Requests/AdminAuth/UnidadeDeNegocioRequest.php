<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
                'required_if:tipoPessoaInput,pf',
                function ($attribute, $value, $fail) {
                    if ($this->input('tipoPessoaInput') == 'pf') {
                        $value = preg_replace('/[^0-9]/', '', $value);
                        $pessoaFisica = DB::table('pessoa_fisica')->where('cpf', $value)->first();
                        if (!$pessoaFisica) {
                            $fail('O CPF não existe na base de dados.');
                        } else {
                            // Verifica se o CPF está vinculado a uma unidade de negócio
                            $cpfLinked = DB::table('unidades_de_negocio')->where('pessoa_id', $pessoaFisica->id)->exists();
                            if ($cpfLinked) {
                                throw ValidationException::withMessages([
                                    'cpfInput' => ['O CPF já está vinculado a uma unidade de negócio.'],
                                ]);
                            }
                        }
                    }
                },
            ],
            'cnpjInput' => [
                'required_if:tipoPessoaInput,pj',
                function ($attribute, $value, $fail) {
                    if ($this->input('tipoPessoaInput') == 'pj') {
                        $value = preg_replace('/[^0-9]/', '', $value);
                        $pessoaJuridica = DB::table('pessoa_juridica')->where('cnpj', $value)->first();
                        if (!$pessoaJuridica) {
                            $fail('O CNPJ não existe na base de dados.');
                        } else {
                            // Verifica se o CNPJ está vinculado a uma unidade de negócio
                            $cnpjLinked = DB::table('unidades_de_negocio')->where('pessoa_id', $pessoaJuridica->id)->exists();
                            if ($cnpjLinked) {
                                throw ValidationException::withMessages([
                                    'cnpjInput' => ['O CNPJ já está vinculado a uma unidade de negócio.'],
                                ]);
                            }
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
