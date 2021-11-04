<?php

namespace App\Http\Requests\Agendamento;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoFiltroDataRequest extends FormRequest
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
            'data' => ['date'],
        ];
    }

    public function messages()
    {
        return [
            'date' => 'O valor de :attribute deve ser uma data válida.',
        ];
    }

    public function attributes()
    {
        return [];
    }
}
