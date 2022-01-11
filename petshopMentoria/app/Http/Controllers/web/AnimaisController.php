<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Services\AnimalService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AnimaisController extends Controller
{
    private AnimalService $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    public function listarAnimais(AnimalRepositoryInterface $model)
    {
        $response = $this->animalService->listarAnimais();
        return view('animais', [
            'animais' => $response['data'],
            'success' => $response['success']
        ]);
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        $response = $this->animalService->registrarAnimal($request);
        return redirect()->route('listarAnimais');
    }
}
