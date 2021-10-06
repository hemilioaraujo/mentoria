<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servico\ServicoRequest;
use App\Services\ServicoService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    private $servicoService;
    
    public function __construct(ServicoService $servicoService) {
        $this->servicoService = $servicoService;
    }

    public function index()
    {
        return $this->servicoService->index();
    }

    public function post(ServicoRequest $request)
    {
        return $this->servicoService->post($request);
    }

    public function show(int $id)
    {
        return $this->servicoService->show($id);
    }

    public function patch(ServicoRequest $request, int $id)
    {
        return $this->servicoService->patch($request, $id);
    }

    public function put(ServicoRequest $request, int $id)
    {
        return $this->servicoService->put($request, $id);
    }

    public function delete(int $id)
    {
        return $this->servicoService->delete($id);
    }

}
