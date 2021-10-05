<?php

namespace App\Repositories\Contracts;

interface TutorRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function create(array $data);
    public function animais();
    public function animais_id(int $id_animal);
}
