<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface AnimalRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function create(array $data);
}
