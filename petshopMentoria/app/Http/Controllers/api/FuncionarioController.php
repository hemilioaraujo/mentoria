<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Services\FuncionarioService;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private FuncionarioService $service;

    public function __construct(FuncionarioService $service)
    {
        $this->service = $service;
    }

    public function listarFuncionarios()
    {
        $resposta = $this->service->listarFuncionarios();

        if ($resposta->ok) {
            return Response($resposta->data, $resposta->status_code);
        }

        return Response([], $resposta->status_code);
    }

    public function registrarFuncionario(FuncionarioRequest $request)
    {
        $resposta = $this->service->registrarFuncionario($request);

        if ($resposta->ok) {
            return Response($resposta->data, $resposta->status_code);
        }

        return Response([], $resposta->status_code);
    }

    public function exibirFuncionario(int $id)
    {
        $resposta = $this->service->exibirFuncionario($id);

        if ($resposta->ok) {
            return Response($resposta->data, $resposta->status_code);
        }

        return Response([], $resposta->status_code);
    }

    public function corrigirFuncionario(FuncionarioPatchRequest $request, int $id)
    {
        $resposta = $this->service->corrigirFuncionario($request, $id);

        return Response([], $resposta->status_code);
    }

    public function alterarFuncionario(FuncionarioRequest $request, int $id)
    {
        $resposta = $this->service->alterarFuncionario($request, $id);

        return Response([], $resposta->status_code);
    }

    public function removerFuncionario(int $id)
    {
        $resposta = $this->service->removerFuncionario($id);

        return Response([], $resposta->status_code);
    }

    public function agendamentos(int $id)
    {
        $resposta = $this->service->agendamentos($id);

        if ($resposta->ok) {
            return Response($resposta->data, $resposta->status_code);
        }

        return Response([], $resposta->status_code);
    }
}
