<?php

namespace App\Repositories\Eloquent;

use App\Models\Funcionario;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;

class FuncionarioRepository extends AbstractRepository implements FuncionarioRepositoryInterface
{
    protected $model = Funcionario::class;
}
