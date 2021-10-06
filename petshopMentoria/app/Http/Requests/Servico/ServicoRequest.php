<?php

namespace App\Http\Requests\Servico;

use Illuminate\Foundation\Http\FormRequest;

class ServicoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => ['required', 'max:30'],
            'valor' => ['numeric', 'between:0,10000.00']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'between' => 'O campo de :attribute deve estar entre 0 - 10000.',
            'numeric' => 'O campo de :attribute deve ser numérico.',
            'max' => 'O campo de :attribute deve tex máximo de :max caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'descricao' => 'descrição',
        ];
    }
}
