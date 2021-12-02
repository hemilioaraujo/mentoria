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

    public function index()
    {
        return $this->service->index();
    }

    public function post(AgendamentoPostRequest $request)
    {
        return $this->service->post($request);
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function put(AgendamentoPostRequest $request, int $id)
    {
        return $this->service->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }

    public function agendamentosPorFuncionario(AgendamentoFiltroDataRequest $request, int $id)
    {
        return $this->service->agendamentosPorFuncionario($request, $id);
    }
}
