<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class PessoaFisicaRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'cpf' => [
                'required',
                'unique:pessoa_fisica',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                function ($attribute, $value, $fail) {
                    $value = preg_replace('/[^0-9]/', '', $value);
                    $pessoaFisica = DB::table('pessoa_fisica')->where('cpf', $value)->exists();
                    if ($pessoaFisica) {
                        $fail('O CPF já existe na base de dados.');
                    }
                },
            ],
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'tipo_de_logradouro_id' => 'required|exists:tipos_de_logradouro,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:cidades,id',
            'imagem' => 'nullable|uploaded|image|mimes:jpeg,png,jpg,gif|max:2048',    
        ];
    }

    public function messages(): array
    {
        return [

            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não deve ultrapassar 255 caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.regex' => 'O CPF deve estar no formato XXX.XXX.XXX-XX.',

            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo email não deve ultrapassar 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O campo telefone deve ser uma string.',
            'telefone.max' => 'O campo telefone não deve ultrapassar 255 caracteres.',

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

            'imagem.image' => 'O arquivo deve ser uma imagem válida.',
            'imagem.mimes' => 'A imagem deve ter um formato válido (jpeg, png, jpg, gif).',
            'imagem.max' => 'A imagem não deve ultrapassar 255 kilobytes.',
            'uploaded' => 'O arquivo no campo imagem falhou ao ser enviado.',  


        ];
    }
}
