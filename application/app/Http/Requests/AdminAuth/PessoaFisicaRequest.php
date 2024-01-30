<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'cpf' => 'required|cpf|unique:pessoa_fisica',
            'email' => 'nullable|email|max:255',
            'tipo_de_logradouro' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:cidades,id',
            'senha' => 'nullable|string|max:255',
            'senha_temporaria' => 'nullable|in:sim,nao',
            'status' => 'nullable|in:ativo,inativo,pendente-pagamento',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rg' => 'nullable|string|max:20',
            'data_de_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable',
            'nacionalidade' => 'nullable|string|max:255',
            'nome_da_mae' => 'nullable|string|max:255',
            'nome_do_pai' => 'nullable|string|max:255',
            'titulo_de_eleitor' => 'nullable|string|max:20',
            'numero_pis_pasep' => 'nullable|string|max:20',
            'escolaridade' => 'nullable|string|max:255',
       
        ];
    }

    public function messages(): array
    {
        return [

            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode ter mais de :max caracteres.',
            
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.cpf' => 'O CPF informado é inválido.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de :max caracteres.',
            
            'tipo_de_logradouro.string' => 'O campo tipo de logradouro deve ser uma string.',
            'tipo_de_logradouro.max' => 'O campo tipo de logradouro não pode ter mais de :max caracteres.',
            
            'logradouro.string' => 'O campo logradouro deve ser uma string.',
            'logradouro.max' => 'O campo logradouro não pode ter mais de :max caracteres.',
            
            'numero.string' => 'O campo número deve ser uma string.',
            'numero.max' => 'O campo número não pode ter mais de :max caracteres.',
            
            'complemento.string' => 'O campo complemento deve ser uma string.',
            'complemento.max' => 'O campo complemento não pode ter mais de :max caracteres.',
            
            'bairro.string' => 'O campo bairro deve ser uma string.',
            'bairro.max' => 'O campo bairro não pode ter mais de :max caracteres.',
            
            'estado_id.required' => 'O campo estado é obrigatório.',
            'estado_id.exists' => 'O estado selecionado não é válido.',
            
            'cidade_id.required' => 'O campo cidade é obrigatório.',
            'cidade_id.exists' => 'A cidade selecionada não é válida.',
            
            'senha.string' => 'O campo senha deve ser uma string.',
            'senha.max' => 'O campo senha não pode ter mais de :max caracteres.',
            
            'senha_temporaria.in' => 'O campo senha temporária deve ser sim ou não.',
            
            'status.in' => 'O campo status deve ser ativo, inativo ou pendente-pagamento.',
            
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ter um formato válido: jpeg, png, jpg, gif, svg.',
            'imagem.max' => 'A imagem não pode ter mais de :max kilobytes.',
            
            'rg.string' => 'O campo RG deve ser uma string.',
            'rg.max' => 'O campo RG não pode ter mais de :max caracteres.',
            
            'data_de_nascimento.date' => 'O campo data de nascimento deve ser uma data válida.',
            
            'estado_civil.in' => 'O campo estado civil deve ser Solteiro(a), Casado(a), Viúvo(a), Divorciado(a), Casado(a), União Estável, Anulado(a).',
            
            'nacionalidade.string' => 'O campo nacionalidade deve ser uma string.',
            'nacionalidade.max' => 'O campo nacionalidade não pode ter mais de :max caracteres.',
            
            'nome_da_mae.string' => 'O campo nome da mãe deve ser uma string.',
            'nome_da_mae.max' => 'O campo nome da mãe não pode ter mais de :max caracteres.',
            
            'nome_do_pai.string' => 'O campo nome do pai deve ser uma string.',
            'nome_do_pai.max' => 'O campo nome do pai não pode ter mais de :max caracteres.',
            
            'titulo_de_eleitor.string' => 'O campo título de eleitor deve ser uma string.',
            'titulo_de_eleitor.max' => 'O campo título de eleitor não pode ter mais de :max caracteres.',
            
            'numero_pis_pasep.string' => 'O campo número PIS/PASEP deve ser uma string.',
            'numero_pis_pasep.max' => 'O campo número PIS/PASEP não pode ter mais de :max caracteres.',
            
            'escolaridade.string' => 'O campo escolaridade deve ser uma string.',
            'escolaridade.max' => 'O campo escolaridade não pode ter mais de :max caracteres.',
        

        ];
    }
}
