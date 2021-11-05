<?php

namespace App\Http\Requests\Agendamento;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoPostRequest extends FormRequest
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
            'animal_id' => ['required', 'exists:animais,id', 'integer'],
            'funcionario_id' => ['required', 'exists:funcionarios,id', 'integer'],
            'servico_id' => ['required', 'exists:servicos,id', 'integer'],
            'inicio' => ['required', 'date'],
            'fim' => ['required', 'date','after:inicio']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'integer' => 'O campo de :attribute deve ser do tipo inteiro.',
            'exists' => 'O :attribute informado não existe.',
            'date' => 'A :attribute informadas não são válidas.',
            'after' => 'A data final não pode ser igual ou anterior a de início.'
        ];
    }

    public function attributes()
    {
        return [
            'animal_id' => 'animal',
            'funcionario_id' => 'funcionário',
            'servico_id' => 'serviço',
        ];
    }
}
