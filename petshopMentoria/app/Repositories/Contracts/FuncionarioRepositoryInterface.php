<?php

namespace App\Repositories\Contracts;

interface FuncionarioRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function create(array $data);

    /**
     * [DOUBT:] Porque os métodos fazServico e disponivel funcionaram
     * independente de estarem no contrato do repository?
     */
    public function fazServico(int $id);
    public function disponivel(string $inicio, string $fim);
}
