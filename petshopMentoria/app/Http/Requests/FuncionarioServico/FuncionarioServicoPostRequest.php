<?php

namespace App\Http\Requests\FuncionarioServico;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioServicoPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'funcionario_id' => ['required', 'exists:funcionarios,id','numeric'],
            'servico_id' => ['required','exists:servicos,id', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório.',
            'exists' => 'O :attribute não existe.',
            'numeric' => 'O id do :attribute deve ser numérico'
        ];
    }

    public function attributes()
    {
        return [
            'funcionario_id' => 'funcionário',
            'servico_id' => 'serviço'
        ];
    }
}
