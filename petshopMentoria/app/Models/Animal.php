<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animais';
    protected $fillable = ['nome', 'idade', 'tipo', 'raca'];
    // identificador único, nome, idade, se é gato ou cachorro e sua respectiva raça; 
    // Além do nome e telefone para contato de seu dono.

    public static function rules()
    {
        return [
            'nome' => ['required', 'max:25'],
            'idade' => ['required', 'integer'],
            'tipo' => ['required', 'in:gato,cachorro'],
            'raca' => ['required', 'max:15'],
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'integer' => 'O campo de :attribute deve ser do tipo inteiro.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'in' => 'O campo de :attribute deve ser um dos tipos: :values'
        ];
    }
}
