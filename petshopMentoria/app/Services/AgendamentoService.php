<?php

namespace App\Services;

use App\Http\Requests\Agendamento\AgendamentoFiltroDataRequest;
use App\Http\Requests\Agendamento\AgendamentoPostRequest;
use App\Http\Resources\AgendamentoResource;
use App\Repositories\Contracts\AgendamentoRepositoryInterface;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Client\Request;

class AgendamentoService
{
    private AgendamentoRepositoryInterface $repository;
    private FuncionarioRepositoryInterface $funcionario;

    public function __construct(
        AgendamentoRepositoryInterface $repository,
        FuncionarioRepositoryInterface $funcionarioRepository
    ) {
        $this->repository = $repository;
        $this->funcionario = $funcionarioRepository;
    }

    public function listarAgendamentos()
    {
        $agenda = $this->repository->all();
        return Response(AgendamentoResource::collection($agenda), StatusCodeInterface::STATUS_OK);
    }

    public function registrarAgendamento(AgendamentoPostRequest $request)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if (!$funcionario->fazServico($servico)) {
            return Response(
                ['erro' => 'Este colaraborador não realiza este tipo de serviço.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }

        if (!$funcionario->disponivel($request->get('inicio'), $request->get('fim'))) {
            return Response(
                ['erro' => 'Este colaraborador não está disponível para este horário.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }

        $agendamento = $this->repository->create($request->all());
        return Response(new AgendamentoResource($agendamento), StatusCodeInterface::STATUS_CREATED);
    }

    public function exibirAgendamento(int $id)
    {
        $agenda = $this->repository->find($id);

        if ($agenda) {
            return Response(new AgendamentoResource($agenda), StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function alterarAgendamento(AgendamentoPostRequest $request, int $id)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if (!$funcionario->fazServico($servico)) {
            return Response(
                ['erro' => 'Este colaraborador não realiza este tipo de serviço.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }

        if (!$funcionario->disponivel($request->get('inicio'), $request->get('fim'), $id)) {
            return Response(
                ['erro' => 'Este colaraborador não está disponível para este horário.'],
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }

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
    }

    public function removerAgendamento(int $id)
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

    public function listarAgendamentosPorFuncionario(AgendamentoFiltroDataRequest $request, int $id)
    {
        if ($request->has('data')) {
            // return $request->all();
            $agendamentos = $this->repository->agendamentosPorFuncionario($id, $request->input('data'));
            return Response(AgendamentoResource::collection($agendamentos), StatusCodeInterface::STATUS_OK);
        }

        $agendamentos = $this->repository->agendamentosPorFuncionario($id);
        return Response(AgendamentoResource::collection($agendamentos), StatusCodeInterface::STATUS_OK);
    }
}
