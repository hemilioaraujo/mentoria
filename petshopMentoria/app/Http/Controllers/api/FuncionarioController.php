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

    public function listarFuncionarios()
    {
        return $this->service->listarFuncionarios();
    }

    public function registrarFuncionario(FuncionarioRequest $request)
    {
        return $this->service->registrarFuncionario($request);
    }

    public function exibirFuncionario(int $id)
    {
        return $this->service->exibirFuncionario($id);
    }

    public function corrigirFuncionario(FuncionarioPatchRequest $request, int $id)
    {
        return $this->service->corrigirFuncionario($request, $id);
    }

    public function alterarFuncionario(FuncionarioRequest $request, int $id)
    {
        return $this->service->alterarFuncionario($request, $id);
    }

    public function removerFuncionario(int $id)
    {
        return $this->service->removerFuncionario($id);
    }

    public function agendamentos(int $id)
    {
        return $this->service->agendamentos($id);
    }
}
