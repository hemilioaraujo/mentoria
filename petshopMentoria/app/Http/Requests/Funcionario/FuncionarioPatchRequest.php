<?php

namespace App\Http\Requests\Funcionario;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioPatchRequest extends FormRequest
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
            'nome' => ['max:30'],
        ];
    }

    public function messages()
    {
        return [
            'max' => 'O campo de :attribute deve tex máximo de :max caracteres.',
        ];
    }
}
