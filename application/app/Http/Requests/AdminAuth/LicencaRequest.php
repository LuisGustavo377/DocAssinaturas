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
            //Validações Contrato
            'numero_contrato' => 'required|unique:contratos',
            'arquivo' => 'nullable|file|mimes:pdf|max:20480',
            'plano_id' => 'required',

            //Validações Licenca
            'grupo_de_negocio_id' => 'required',   
            'tipo_de_renovacao' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',

            //Validação Unidade de Negocios

            'tipoPessoaInput' => 'required',
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

            //Mensagens validação atributos contrato
            'numero_contrato.required' => 'O campo número do contrato é obrigatório.',
            'numero_contrato.unique' => 'O número do contrato já está em uso.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O tamanho máximo do arquivo é de 20MB.',
            'plano_id' => 'Selecione um plano',

             //Mensagens validação atributos Licencas
            'grupo_de_negocio_id.required' => 'Selecione um Grupo de Negócio.',
                        'tipo_de_renovacao.required' => 'Selecione o Tipo de Renovação.',
            'inicio.required' => 'O campo Início é obrigatório.',
            'termino.required' => 'O campo Término é obrigatório.',


            // Mensagens validação atributos Unidade de Negocio

            'tipoPessoaInput.required' => 'O campo Tipo de Pessoa é obrigatório.',
            'cpfInput.exists' => 'O CPF fornecido não existe na base de dados.',
            'cnpjInput.exists' => 'O CNPJ fornecido não existe na base de dados.',
            'cpfInput.required_if' => 'O campo CPF é obrigatório.',
            'cnpjInput.required_if' => 'O campo CNPJ é obrigatório.',
            'senha_temporaria.required' => 'O campo Senha Temporária é obrigatório.',       

        ];
    }
}
