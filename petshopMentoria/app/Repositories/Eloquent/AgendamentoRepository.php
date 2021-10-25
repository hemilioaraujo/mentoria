<?php

namespace App\Repositories\Eloquent;

use App\Models\Agendamento;
use App\Repositories\Contracts\AgendamentoRepositoryInterface;

class AgendamentoRepository extends AbstractRepository implements AgendamentoRepositoryInterface
{
    protected $model = Agendamento::class;
}
