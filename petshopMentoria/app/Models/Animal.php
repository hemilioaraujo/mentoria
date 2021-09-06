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
}
