<?php

namespace App\Services;

use App\Http\Requests\Agendamento\AgendamentoPostRequest;
use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Http\Resources\AgendamentoResource;
use App\Models\Agendamento;
use App\Repositories\Contracts\AgendamentoRepositoryInterface;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;

class AgendamentoService
{
    private $repository;
    private $funcionario;

    public function __construct(AgendamentoRepositoryInterface $repository, FuncionarioRepositoryInterface $funcionarioRepository)
    {
        $this->repository = $repository;
        $this->funcionario = $funcionarioRepository;
    }

    public function index()
    {
        $agenda = $this->repository->all();
        return Response(AgendamentoResource::collection($agenda), StatusCodeInterface::STATUS_OK);
    }

    public function post(AgendamentoPostRequest $request)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if ($funcionario->fazServico($servico)) {
            if ($funcionario->disponivel($request->get('inicio'), $request->get('fim'))) {
                $agendamento = $this->repository->create($request->all());
                return Response(new AgendamentoResource($agendamento), StatusCodeInterface::STATUS_CREATED);
            } else {
                return Response(
                    ['erro' => 'Este colaraborador não está disponível para este horário.'],
                    StatusCodeInterface::STATUS_NOT_FOUND
                );
            }
        } else {
            return Response(
                ['erro' => 'Este colaraborador não realiza este tipo de serviço.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }
    }

    public function show(int $id)
    {
        $agenda = $this->repository->find($id);

        if ($agenda) {
            return Response(new AgendamentoResource($agenda), StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(AgendamentoPostRequest $request, int $id)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if ($funcionario->fazServico($servico)) {
            if (
                $funcionario->disponivel($request->get('inicio'), $request->get('fim'), $id)
            ) {
                if ($this->repository->update($request->all(), $id)) {
                    return Response(
                        ['status' => 'Recurso atualizado com sucesso.'],
                        StatusCodeInterface::STATUS_OK
                    );
                }

                return Response(
                    [],
                    StatusCodeInterface::STATUS_NOT_FOUND
                );
            } else {
                return Response(
                    ['erro' => 'Este colaraborador não está disponível para este horário.'],
                    StatusCodeInterface::STATUS_NOT_FOUND
                );
            }
        } else {
            return Response(
                ['erro' => 'Este colaraborador não realiza este tipo de serviço.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }
    }

    public function delete(int $id)
    {
        if ($this->repository->delete($id)) {
            return Response(
                [],
                StatusCodeInterface::STATUS_NO_CONTENT
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function agendamentosPorFuncionario(int $id, $data = null)
    {
        $agendamentos = $this->repository->agendamentosPorFuncionario($id);
        return Response(AgendamentoResource::collection($agendamentos), StatusCodeInterface::STATUS_OK);
    }
}
