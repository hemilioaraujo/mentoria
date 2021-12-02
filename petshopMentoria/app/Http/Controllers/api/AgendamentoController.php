<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agendamento\AgendamentoFiltroDataRequest;
use App\Http\Requests\Agendamento\AgendamentoPostRequest;
use App\Services\AgendamentoService;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class AgendamentoController extends Controller
{
    private AgendamentoService $service;

    public function __construct(AgendamentoService $service)
    {
        $this->service = $service;
    }

    public function listarAgendamentos()
    {
        return $this->service->listarAgendamentos();
    }

    public function registrarAgendamento(AgendamentoPostRequest $request)
    {
        return $this->service->registrarAgendamento($request);
    }

    public function exibirAgendamento(int $id)
    {
        return $this->service->exibirAgendamento($id);
    }

    public function alterarAgendamento(AgendamentoPostRequest $request, int $id)
    {
        return $this->service->alterarAgendamento($request, $id);
    }

    public function removerAgendamento(int $id)
    {
        return $this->service->removerAgendamento($id);
    }

    public function listarAgendamentosPorFuncionario(AgendamentoFiltroDataRequest $request, int $id)
    {
        return $this->service->listarAgendamentosPorFuncionario($request, $id);
    }
}
