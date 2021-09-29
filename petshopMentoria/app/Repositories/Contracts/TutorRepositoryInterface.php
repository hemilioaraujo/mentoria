<?php

namespace App\Repositories\Contracts;

/**
 * [TODO:]
 * adicionar os métodos do contrato
 * refazer uma requests para cada método
 */
interface TutorRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function create(array $data);
}
