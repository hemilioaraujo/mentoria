<?php

namespace App\Services;

use App\Http\Requests\Servico\ServicoRequest;
use App\Http\Requests\Servico\ServicoPatchRequest;
use App\Repositories\Contracts\ServicoRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;

class ServicoService
{
    private ServicoRepositoryInterface $repository;

    public function __construct(ServicoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $tutores = $this->repository->all();
        return Response($tutores, StatusCodeInterface::STATUS_OK);
    }

    public function post(ServicoRequest $request)
    {
        $tutor = $this->repository->create($request->all());
        return Response($tutor, StatusCodeInterface::STATUS_CREATED);
    }

    public function show(int $id)
    {
        $tutor = $this->repository->find($id);
        if ($tutor) {
            return Response($tutor, StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function patch(ServicoPatchRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(ServicoRequest $request, int $id)
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
