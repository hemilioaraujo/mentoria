<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servico\ServicoRequest;
use App\Http\Requests\Servico\ServicoPatchRequest;
use App\Services\ServicoService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    private ServicoService $servicoService;

    public function __construct(ServicoService $servicoService)
    {
        $this->servicoService = $servicoService;
    }

    public function listarServicos()
    {
        return $this->servicoService->listarServicos();
    }

    public function registrarServico(ServicoRequest $request)
    {
        return $this->servicoService->registrarServico($request);
    }

    public function exibirServico(int $id)
    {
        return $this->servicoService->exibirServico($id);
    }

    public function corrigirServico(ServicoPatchRequest $request, int $id)
    {
        return $this->servicoService->corrigirServico($request, $id);
    }

    public function alterarServico(ServicoRequest $request, int $id)
    {
        return $this->servicoService->alterarServico($request, $id);
    }

    public function removerServico(int $id)
    {
        return $this->servicoService->removerServico($id);
    }
}
