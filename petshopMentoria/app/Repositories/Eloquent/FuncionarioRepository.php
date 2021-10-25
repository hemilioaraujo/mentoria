<?php

namespace App\Repositories\Eloquent;

use App\Models\Funcionario;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;

class FuncionarioRepository extends AbstractRepository implements FuncionarioRepositoryInterface
{
    protected $model = Funcionario::class;

    public function fazServico(int $id)
    {
        return parent::$model->fazServico($id);
    }

    public function disponivel(string $inicio, string $fim)
    {
        dd('entrou no repository');
        return parent::$model->disponivel($inicio, $fim);
    }
}
