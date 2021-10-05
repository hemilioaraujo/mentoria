<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutores';
    protected $fillable = ['nome', 'telefone', 'cpf'];

    public function animais()
    {
        return $this->hasMany(Animal::class)->get();
    }
}
