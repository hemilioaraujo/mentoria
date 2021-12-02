<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Services\FuncionarioService;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private FuncionarioService $service;

    public function __construct(FuncionarioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function post(FuncionarioRequest $request)
    {
        return $this->service->post($request);
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function patch(FuncionarioPatchRequest $request, int $id)
    {
        return $this->service->patch($request, $id);
    }

    public function put(FuncionarioRequest $request, int $id)
    {
        return $this->service->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }

    public function agendamentos(int $id)
    {
        return $this->service->agendamentos($id);
    }
}
