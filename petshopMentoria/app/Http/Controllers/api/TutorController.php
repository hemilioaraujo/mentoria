<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tutor\TutorPatchRequest;
use App\Http\Requests\Tutor\TutorPostRequest;
use App\Http\Requests\Tutor\TutorPutRequest;
use App\Services\TutorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TutorController extends Controller
{
    private TutorService $tutorService;

    public function __construct(TutorService $tutorService)
    {
        $this->tutorService = $tutorService;
    }

    public function listarTutores()
    {
        return $this->tutorService->listarTutores();
    }

    public function registrarTutor(TutorPostRequest $request)
    {
        return $this->tutorService->registrarTutor($request);
    }

    public function exibirTutor(int $id)
    {
        return $this->tutorService->exibirTutor($id);
    }

    public function corrigirTutor(TutorPatchRequest $request, int $id)
    {
        return $this->tutorService->corrigirTutor($request, $id);
    }

    public function alterarTutor(TutorPutRequest $request, int $id)
    {
        return $this->tutorService->alterarTutor($request, $id);
    }

    public function removerTutor(int $id)
    {
        return $this->tutorService->removerTutor($id);
    }

    public function listarAnimaisDoTutor(int $id)
    {
        return $this->tutorService->listarAnimaisDoTutor($id);
    }

    public function listarAnimaisDoTutorPorId(int $id_tutor, int $id_animal)
    {
        return $this->tutorService->listarAnimaisDoTutorPorId($id_tutor, $id_animal);
    }
}
