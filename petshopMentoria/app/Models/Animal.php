<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animais';
    protected $fillable = ['nome', 'idade', 'tipo', 'raca', 'tutor_id'];
    // identificador único, nome, idade, se é gato ou cachorro e sua respectiva raça;
    // Além do nome e telefone para contato de seu dono.

    public static function rules()
    {
        return [
            'nome' => ['required', 'max:25'],
            'idade' => ['required', 'integer'],
            'tipo' => ['required', 'in:gato,cachorro'],
            'raca' => ['required', 'max:15'],
            'tutor_id' => ['required', 'exists:tutores,id']
        ];
    }

    public static function messages()
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'integer' => 'O campo de :attribute deve ser do tipo inteiro.',
            'max' => 'O campo de :attribute não pode ser maior que :max.',
            'in' => 'O campo de :attribute deve ser um dos tipos: :values',
            'exists'=> 'O id de tutor não existe.'
        ];
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}
