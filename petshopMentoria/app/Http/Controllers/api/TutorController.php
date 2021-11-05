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
use App\Services\TutorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
 
class TutorController extends Controller
{
    private $tutorService;

    public function __construct(TutorService $tutorService)
    {
        $this->tutorService = $tutorService;
    }

    public function index()
    {
        return $this->tutorService->index();
    }

    public function post(TutorPostRequest $request)
    {
        return $this->tutorService->post($request);
    }

    public function show(int $id)
    {
        return $this->tutorService->show($id);
    }

    public function patch(TutorPatchRequest $request, int $id)
    {
        return $this->tutorService->patch($request, $id);
    }

    public function put(TutorPutRequest $request, int $id)
    {
        return $this->tutorService->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->tutorService->delete($id);
    }

    public function animais(int $id)
    {
        return $this->tutorService->animais($id);
    }

    public function animaisId(int $id_tutor, int $id_animal)
    {
        return $this->tutorService->animaisId($id_tutor, $id_animal);
    }
}
