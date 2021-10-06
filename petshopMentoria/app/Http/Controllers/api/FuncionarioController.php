<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Services\FuncionarioService;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private $funcionarioService;

    public function __construct(FuncionarioService $funcionarioService)
    {
        $this->funcionarioService = $funcionarioService;
    }

    public function index()
    {
        return $this->funcionarioService->index();
    }

    public function post(FuncionarioRequest $request)
    {
        return $this->funcionarioService->post($request);
    }

    public function show(int $id)
    {
        return $this->funcionarioService->show($id);
    }

    public function patch(FuncionarioPatchRequest $request, int $id)
    {
        return $this->funcionarioService->patch($request, $id);
    }

    public function put(FuncionarioRequest $request, int $id)
    {
        return $this->funcionarioService->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->funcionarioService->delete($id);
    }
}
