<?php

namespace App\Repositories\Eloquent;

use App\Models\FuncionarioServico;
use App\Repositories\Contracts\FuncionarioServicoRepositoryInterface;

class FuncionarioServicoRepository extends AbstractRepository implements FuncionarioServicoRepositoryInterface
{
    protected $model = FuncionarioServico::class;
}
