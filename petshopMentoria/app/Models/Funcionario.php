<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'funcionarios_servicos');
    }
    
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    /**
     * Verifica se o funcionário realiza o tipo de serviço
     *
     * @param integer $servico_id
     * @return boolean
     */
    public function fazServico(int $servico_id)
    {
        $servicos = $this->servicos();
        if ($servicos->contains($servico_id)) {
            return true;
        }
        return false;
    }

}
