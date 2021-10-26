<?php

namespace App\Repositories\Eloquent;

use App\Models\Agendamento;
use App\Repositories\Contracts\AgendamentoRepositoryInterface;

class AgendamentoRepository extends AbstractRepository implements AgendamentoRepositoryInterface
{
    protected $model = Agendamento::class;

    public function agendamentosPorFuncionario(int $id, $data = null)
    {
        return Agendamento::where('funcionario_id', $id)->get();
    }
}
