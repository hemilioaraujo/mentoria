<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Http\Requests\Animal\AnimalPatchRequest;
use App\Http\Requests\Animal\AnimalPutRequest;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Services\AnimalService;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    private AnimalService $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    public function listarAnimais(AnimalRepositoryInterface $model)
    {
        $response = $this->animalService->listarAnimais();
        if ($response['success']) {
            return Response(
                AnimalResource::collection($response['data']),
                StatusCodeInterface::STATUS_OK
            );
        }
        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        $response = $this->animalService->registrarAnimal($request);
        if ($response['success']) {
            return Response(
                new AnimalResource($response['data']),
                StatusCodeInterface::STATUS_CREATED
            );
        }
        return Response(
            $response['exception'],
            StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE
        );
    }

    public function exibirAnimal(int $id)
    {
        return $this->animalService->exibirAnimal($id);
    }

    public function corrigirAnimal(AnimalPatchRequest $request, int $id)
    {
        return $this->animalService->corrigirAnimal($request, $id);
    }

    public function alterarAnimal(AnimalPutRequest $request, int $id)
    {
        return $this->animalService->alterarAnimal($request, $id);
    }

    public function removerAnimal(int $id)
    {
        return $this->animalService->removerAnimal($id);
    }

    public function racas()
    {
        return $this->animalService->racas();
    }
}
