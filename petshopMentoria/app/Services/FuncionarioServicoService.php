<?php

namespace App\Services;

use App\Http\Requests\FuncionarioServico\FuncionarioServicoPostRequest;
use App\Http\Requests\FuncionarioServico\FuncionarioServicoPatchRequest;
use App\Repositories\Contracts\FuncionarioServicoRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;

class FuncionarioServicoService
{
    private FuncionarioServicoRepositoryInterface $repository;
    public function __construct(FuncionarioServicoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $funcionarios_servicos = $this->repository->all();
        return Response($funcionarios_servicos, StatusCodeInterface::STATUS_OK);
    }

    public function post(FuncionarioServicoPostRequest $request)
    {
        $funcionario_servico = $this->repository->create($request->all());
        return Response($funcionario_servico, StatusCodeInterface::STATUS_CREATED);
    }

    public function show(int $id)
    {
        $funcionario_servico = $this->repository->find($id);
        if ($funcionario_servico) {
            return Response($funcionario_servico, StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function patch(FuncionarioServicoPatchRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(FuncionarioServicoPostRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function delete(int $id)
    {
        if ($this->repository->delete($id)) {
            return Response([], StatusCodeInterface::STATUS_NO_CONTENT);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
