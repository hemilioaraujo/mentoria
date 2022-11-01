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
        if ($response->ok) {
            return Response(
                AnimalResource::collection($response->data),
                $response->status_code
            );
        }
        return Response(
            [],
            $response->status_code
        );
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        $response = $this->animalService->registrarAnimal($request);
        if ($response['success']) {
            return Response(
                new AnimalResource($response['data']),
                $response['status_code']
            );
        }
        return Response(
            [],
            $response['status_code']
        );
    }

    public function exibirAnimal(int $id)
    {
        $response = $this->animalService->exibirAnimal($id);
        if ($response['success'] && $response['status_code'] == 200) {
            return Response(
                new AnimalResource($response['data']),
                $response['status_code']
            );
        }
        return Response(
            [],
            $response['status_code']
        );
    }

    public function corrigirAnimal(AnimalPatchRequest $request, int $id)
    {
        $response = $this->animalService->corrigirAnimal($request, $id);
        
        return Response(
            [],
            $response['status_code']
        );
    }

    public function alterarAnimal(AnimalPutRequest $request, int $id)
    {
        $response = $this->animalService->alterarAnimal($request, $id);
        
        return Response(
            [],
            $response['status_code']
        );
    }

    public function removerAnimal(int $id)
    {
        $response = $this->animalService->removerAnimal($id);
        
        return Response(
            [],
            $response['status_code']
        );
    }

    public function racas()
    {
        return $this->animalService->racas();
    }
}
