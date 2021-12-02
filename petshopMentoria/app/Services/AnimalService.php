<?php

namespace App\Services;

use App\Http\Requests\Animal\AnimalPatchRequest;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Http\Requests\Animal\AnimalPutRequest;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;

class AnimalService
{
    private AnimalRepositoryInterface $repository;

    public function __construct(AnimalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listarAnimais()
    {
        $animais = $this->repository->all();
        return Response(AnimalResource::collection($animais), StatusCodeInterface::STATUS_OK);
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        $animal = $this->repository->create($request->all());
        return Response(new AnimalResource($animal), StatusCodeInterface::STATUS_CREATED);
    }

    public function exibirAnimal(int $id)
    {
        $animal = $this->repository->find($id);

        if ($animal) {
            return Response(new AnimalResource($animal), StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function corrigirAnimal(AnimalPatchRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function alterarAnimal(AnimalPutRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function removerAnimal(int $id)
    {
        if ($this->repository->delete($id)) {
            return Response(
                [],
                StatusCodeInterface::STATUS_NO_CONTENT
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }
}
