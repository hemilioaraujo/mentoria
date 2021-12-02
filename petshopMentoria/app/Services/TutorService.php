<?php

namespace App\Services;

use App\Http\Requests\Tutor\TutorPatchRequest;
use App\Http\Requests\Tutor\TutorPostRequest;
use App\Http\Requests\Tutor\TutorPutRequest;
use App\Http\Resources\TutorResource;
use App\Repositories\Contracts\TutorRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;

class TutorService
{
    private TutorRepositoryInterface $repository;

    public function __construct(TutorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $tutores = $this->repository->all();
        return Response($tutores, StatusCodeInterface::STATUS_OK);
    }

    public function post(TutorPostRequest $request)
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

    public function patch(TutorPatchRequest $request, int $id)
    {
        if ($this->repository->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(TutorPutRequest $request, int $id)
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

    public function animais(int $id)
    {
        $tutor = $this->repository->find($id);
        if ($tutor) {
            return Response(new TutorResource($tutor), StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function animaisId(int $id_tutor, int $id_animal)
    {
        $tutor = $this->repository->find($id_tutor);
        if ($tutor) {
            $animais = $tutor->animais();
            $animal = $animais->find($id_animal);
            if ($animal) {
                return Response($animal, StatusCodeInterface::STATUS_OK);
            }
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
