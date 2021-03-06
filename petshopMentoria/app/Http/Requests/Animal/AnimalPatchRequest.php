<?php

namespace App\Http\Requests\Animal;

use Illuminate\Foundation\Http\FormRequest;

class AnimalPatchRequest extends FormRequest
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
            'nome' =>  ['max:25'],
            'idade' => ['integer'],
            'tipo' =>  ['in:gato,cachorro'],
            'raca' =>  ['max:15'],
        ];
    }

    public function messages()
    {
        return [
            'integer' => 'O campo de :attribute deve ser do tipo inteiro.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'in' => 'O campo de :attribute deve ser um dos tipos: :values'
        ];
    }

    public function attributes()
    {
        return [
            'raca' => 'raça',
        ];
    }
}
