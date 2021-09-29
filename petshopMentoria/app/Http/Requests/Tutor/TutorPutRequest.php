<?php

namespace App\Http\Requests\Tutor;

use App\Repositories\Contracts\TutorRepositoryInterface;
use App\Rules\CpfRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule as ValidationRule;

class TutorPutRequest extends FormRequest
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
                    'nome' => ['required', 'max:30'],
                    'telefone' => ['required', 'max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
                    'cpf' => ['required']
                ];
            }
        }

        return [
            'nome' => ['required', 'max:30'],
            'telefone' => ['required', 'max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
            'cpf' => ['required', 'unique:tutores']
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
