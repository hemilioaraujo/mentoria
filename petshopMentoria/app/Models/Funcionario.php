<?php

namespace App\Models;

use Carbon\Carbon;
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
        $servicos = $this->servicos;
        if ($servicos->contains($servico_id)) {
            return true;
        }
        return false;
    }

    public function disponivel(string $inicio, string $fim, int $id = null)
    {
        $inicio = new Carbon($inicio);
        $fim = new Carbon($fim);
        $inicio_agenda = new Carbon();
        $fim_agenda = new Carbon();

        foreach ($this->agendamentos as $agenda) {
            $inicio_agenda->setDateTimeFrom($agenda->inicio);
            $fim_agenda->setDateTimeFrom($agenda->fim);

            if ($agenda->id != $id) {
                if ($inicio->between($agenda->inicio, $agenda->fim)) {
                    return false;
                }
                if ($fim->between($agenda->inicio, $agenda->fim)) {
                    return false;
                }
                if ($inicio_agenda->between($inicio, $fim)) {
                    return false;
                }
                if ($fim_agenda->between($inicio, $fim)) {
                    return false;
                }
            }
        }
        return true;
    }
}
