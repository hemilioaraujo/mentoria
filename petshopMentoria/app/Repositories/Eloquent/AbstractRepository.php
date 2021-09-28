<?php

namespace App\Repositories\Eloquent;

use Illuminate\Http\Request;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function update(array $data, int $id)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
    
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}