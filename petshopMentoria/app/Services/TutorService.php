<?php

namespace App\Services;

use App\Http\Requests\Tutor\TutorPatchRequest;
use App\Http\Requests\Tutor\TutorPostRequest;
use App\Http\Requests\Tutor\TutorPutRequest;
use App\Repositories\Contracts\TutorRepositoryInterface;
use App\Repositories\Eloquent\TutorRepository;
use Fig\Http\Message\StatusCodeInterface;


class TutorService
{
    private $repository;
    private $validator;

    public function __construct(TutorRepositoryInterface $repository, )
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return Response($this->repository->all(), StatusCodeInterface::STATUS_OK);
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
            return Response([], StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
