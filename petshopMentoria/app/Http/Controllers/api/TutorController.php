<?php

namespace App\Http\Controllers\api;

use Fig\Http\Message\StatusCodeInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tutor\TutorPatchRequest;
use App\Http\Requests\Tutor\TutorPostRequest;
use App\Http\Requests\Tutor\TutorPutRequest;
use App\Http\Requests\Tutor\TutorRequest;
use App\Models\Tutor;
use App\Repositories\Contracts\TutorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TutorController extends Controller
{
    public function index(TutorRepositoryInterface $model)
    {
        return Response($model->all(), StatusCodeInterface::STATUS_OK);
    }

    public function post(TutorRepositoryInterface $model, TutorPostRequest $request)
    {
        $request->validate(Tutor::rules(), Tutor::messages());
        $tutor = $model->create($request->all());
        return Response($tutor, StatusCodeInterface::STATUS_CREATED);
    }

    public function show(TutorRepositoryInterface $model, int $id)
    {
        $tutor = $model->find($id);
        if ($tutor) {
            return Response($tutor, StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function patch(TutorRepositoryInterface $model, TutorPatchRequest $request, int $id)
    {
        if ($model->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(TutorRepositoryInterface $model, TutorPutRequest $request, int $id)
    {
        if ($model->update($request->all(), $id)) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function delete(TutorRepositoryInterface $model, int $id)
    {
        if ($model->delete($id)) {
            return Response([], StatusCodeInterface::STATUS_OK);
        }

        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
