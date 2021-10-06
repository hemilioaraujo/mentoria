<?php

namespace App\Repositories\Eloquent;

use App\Models\Servico;
use App\Repositories\Contracts\ServicoRepositoryInterface;

class ServicoRepository extends AbstractRepository implements ServicoRepositoryInterface
{
    protected $model = Servico::class;
}
