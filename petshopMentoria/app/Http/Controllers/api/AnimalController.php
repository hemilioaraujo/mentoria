<?php

/**
 * [TODO:]
 * Estudar services e repositores
 * 
 */

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalRequest;
use App\Models\Animal;
use App\Models\Tutor;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    public function index(AnimalRepositoryInterface $model)
    {
        $animais = $model->all();
        foreach ($animais as $animal) {
            $animal['tutor'] = $animal->tutor;
        }
        return Response($animais, StatusCodeInterface::STATUS_OK);
    }

    public function post(AnimalRepositoryInterface $model, AnimalRequest $request)
    {
        $request->validate(Animal::rules(), Animal::messages());
        $animal = $model->create($request->all());
        return Response($animal, StatusCodeInterface::STATUS_CREATED);
    }

    public function show(AnimalRepositoryInterface $model, int $id)
    {
        $animal = $model->find($id);

        if ($animal) {
            return Response($animal, StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function patch(AnimalRepositoryInterface $model, Request $request, int $id)
    {
        if ($model->update($request->all(), $id)) {
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

    public function put(AnimalRepositoryInterface $model, Request $request, int $id)
    {
        $request->validate(Animal::rules(), Animal::messages());
        if ($model->update($request->all(), $id)) {
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

    public function delete(AnimalRepositoryInterface $model, int $id)
    {
        if ($model->delete($id)) {
            return Response(
                [],
                StatusCodeInterface::STATUS_OK
            );
        }

        /**
         * Sempre retorna vazio no response de destroy
         * e NO_CONTENT no status
         */
        return Response(
            [],
            StatusCodeInterface::STATUS_NO_CONTENT
        );
    }
}
