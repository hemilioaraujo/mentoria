<?php

namespace App\Http\Requests\Tutor;

use App\Repositories\Contracts\TutorRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class TutorPatchRequest extends FormRequest
{
    protected $model;
    protected $tutor_id;
    protected $tutor;

    public function __construct(TutorRepositoryInterface $model)
    {
        $this->model = $model;
    }
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
        $this->tutor_id = $this->route('id');
        $this->tutor = $this->model->find($this->tutor_id);

        if ($this->__isset('cpf')) {
            if ($this->tutor->cpf == $this->__get('cpf')) {
                return [
                    'nome' => ['max:30'],
                    'telefone' => ['max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
                ];
            }
        }

        return [
            'nome' => ['max:30'],
            'telefone' => ['max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
            'cpf' => ['unique:tutores']
        ];
    }

    public function messages()
    {
        return [
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'regex' => 'O :attribute é invalido. (xx)xxxxx-xxxx ou (xx)xxxx-xxxx.',
            'unique' => 'O :attribute informado já está cadastrado.'
        ];
    }
}
