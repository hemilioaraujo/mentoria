<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $table = 'tutores';
    protected $fillable = ['nome', 'telefone'];

    public static function rules()
    {
        return [
            'nome' => ['required', 'max:30'],
            'telefone' => ['required', 'max:15', 'regex:/(\(\d{2}\))(\d{4,5}\-\d{4})/i'],
            'cpf'=>['required']
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'regex' => 'O :attribute é invalido. (xx)xxxxx-xxxx ou (xx)xxxx-xxxx.'
        ];
    }
}
