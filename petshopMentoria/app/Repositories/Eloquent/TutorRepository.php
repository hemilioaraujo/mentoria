<?php

namespace App\Repositories\Eloquent;

use App\Models\Tutor;
use App\Repositories\Contracts\TutorRepositoryInterface;

class TutorRepository extends AbstractRepository implements TutorRepositoryInterface
{
    protected $model = Tutor::class;
}
