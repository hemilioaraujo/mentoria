<?php

namespace App\Repositories\Eloquent;

use App\Models\Tutor;
use App\Repositories\Contracts\TutorRepositoryInterface;

class TutorRepository extends AbstractRepository implements TutorRepositoryInterface
{
    protected $model = Tutor::class;

    public function animais()
    {
        return parent::$model->animais();
    }

    public function animaisId(int $id_animal)
    {
        return $this->animais()->find($id_animal);
    }
}
