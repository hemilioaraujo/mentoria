<?php

namespace App\Services;

use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;
use Facade\FlareClient\Http\Response;
use Fig\Http\Message\StatusCodeInterface;

class FuncionarioService
{
    private FuncionarioRepositoryInterface $repository;

    public function __construct(FuncionarioRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listarFuncionarios()
    {
        $funcionarios = $this->repository->all();
        return Response($funcionarios, StatusCodeInterface::STATUS_OK);
    }

    public function registrarFuncionario(FuncionarioRequest $request)
    {
        $funcionario = $this->repository->create($request->all());
        return Response($funcionario, StatusCodeInterface::STATUS_CREATED);
    }

    public function exibirFuncionario(int $id)
    {
        $funcionario = $this->repository->find($id);
        if ($funcionario) {
            return Response($funcionario, StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function corrigirFuncionario(FuncionarioPatchRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function alterarFuncionario(FuncionarioRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function removerFuncionario(int $id)
    {
        if ($this->repository->delete($id)) {
            return Response([], StatusCodeInterface::STATUS_NO_CONTENT);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function agendamentos(int $id)
    {
        $funcionario = $this->repository->find($id);
        if ($funcionario) {
            return $funcionario->agendamentos->toJson();
            return Response($funcionario->agendamentos, StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
