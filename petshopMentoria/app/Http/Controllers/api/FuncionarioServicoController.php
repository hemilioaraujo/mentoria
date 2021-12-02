<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FuncionarioServico\FuncionarioServicoPostRequest;
use App\Http\Requests\FuncionarioServico\FuncionarioServicoPatchRequest;
use App\Services\FuncionarioServicoService;
use Illuminate\Http\Request;

class FuncionarioServicoController extends Controller
{
    private FuncionarioServicoService $funcionarioServicoService;

    public function __construct(FuncionarioServicoService $funcionarioServicoService)
    {
        $this->funcionarioServicoService = $funcionarioServicoService;
    }

    public function index()
    {
        return $this->funcionarioServicoService->index();
    }

    public function post(FuncionarioServicoPostRequest $request)
    {
        return $this->funcionarioServicoService->post($request);
    }

    public function show(int $id)
    {
        return $this->funcionarioServicoService->show($id);
    }

    public function patch(FuncionarioServicoPatchRequest $request, int $id)
    {
        return $this->funcionarioServicoService->patch($request, $id);
    }

    public function put(FuncionarioServicoPostRequest $request, int $id)
    {
        return $this->funcionarioServicoService->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->funcionarioServicoService->delete($id);
    }
}
