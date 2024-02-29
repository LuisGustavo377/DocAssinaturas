<?php

namespace App\Http\Requests\AdminAuth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeDeNegocioEditRequest extends FormRequest
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
            'licenca_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'grupo_de_negocio_id.required' => 'O campo Grupo de Negócio é obrigatório.',
            'licenca_id.required' => 'O campo Licença é obrigatório.',
        ];
    }
}
