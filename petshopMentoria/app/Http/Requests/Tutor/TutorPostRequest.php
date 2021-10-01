<?php

namespace App\Http\Requests\Tutor;

use Illuminate\Foundation\Http\FormRequest;

class TutorPostRequest extends FormRequest
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
            'nome' => ['required', 'max:30'],
            'telefone' => ['required', 'max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
            'cpf' => ['required', 'unique:tutores', 'max:11']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'regex' => 'O :attribute é invalido. (xx)xxxxx-xxxx ou (xx)xxxx-xxxx.',
            'unique' => 'O :attribute informado já está cadastrado.'
        ];
    }
}
