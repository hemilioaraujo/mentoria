<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Http\Requests\Animal\AnimalPatchRequest;
use App\Http\Requests\Animal\AnimalPutRequest;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Services\AnimalService;
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
        return $this->animalService->listarAnimais();
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        return $this->animalService->registrarAnimal($request);
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
