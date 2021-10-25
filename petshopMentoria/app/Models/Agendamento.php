<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = ['animal_id', 'funcionario_id', 'servico_id', 'inicio', 'fim'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
