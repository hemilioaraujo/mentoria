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

    public function index(AnimalRepositoryInterface $model)
    {
        return $this->animalService->index();
    }

    public function post(AnimalPostRequest $request)
    {
        return $this->animalService->post($request);
    }

    public function show(int $id)
    {
        return $this->animalService->show($id);
    }

    public function patch(AnimalPatchRequest $request, int $id)
    {
        return $this->animalService->patch($request, $id);
    }

    public function put(AnimalPutRequest $request, int $id)
    {
        return $this->animalService->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->animalService->delete($id);
    }
}
