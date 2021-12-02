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

    public function listarFuncionarioServicos()
    {
        return $this->funcionarioServicoService->listarFuncionarioServicos();
    }

    public function registrarFuncionarioServico(FuncionarioServicoPostRequest $request)
    {
        return $this->funcionarioServicoService->registrarFuncionarioServico($request);
    }

    public function exibirFuncionarioServico(int $id)
    {
        return $this->funcionarioServicoService->exibirFuncionarioServico($id);
    }

    public function corrigirFuncionarioServico(FuncionarioServicoPatchRequest $request, int $id)
    {
        return $this->funcionarioServicoService->corrigirFuncionarioServico($request, $id);
    }

    public function alterarFuncionarioServico(FuncionarioServicoPostRequest $request, int $id)
    {
        return $this->funcionarioServicoService->alterarFuncionarioServico($request, $id);
    }

    public function removerFuncionarioServico(int $id)
    {
        return $this->funcionarioServicoService->removerFuncionarioServico($id);
    }
}
