<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $table = 'tutores';
    protected $fillable = ['nome', 'telefone','cpf'];

    public static function rules()
    {
        return [
            'nome' => ['required', 'max:30'],
            'telefone' => ['required', 'max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
            'cpf'=>['required','unique:tutores']
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'regex' => 'O :attribute é invalido. (xx)xxxxx-xxxx ou (xx)xxxx-xxxx.',
            'unique'=> 'O :attribute informado já está cadastrado.'
        ];
    }

    public function animais()
    {
        return $this->hasMany(Animal::class);
    }
}
