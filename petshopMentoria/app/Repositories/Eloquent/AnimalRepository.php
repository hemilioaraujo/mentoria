<?php

namespace App\Repositories\Eloquent;

use App\Models\Animal;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AnimalRepository extends AbstractRepository implements AnimalRepositoryInterface
{
    protected $model = Animal::class;

    public function tutor()
    {
        return parent::$model->tutor();
    }
}
