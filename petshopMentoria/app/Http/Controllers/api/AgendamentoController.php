<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agendamento\AgendamentoPostRequest;
use App\Repositories\Contracts\AgendamentoRepositoryInterface;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;
use Facade\FlareClient\Http\Response;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class AgendamentoController extends Controller
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
        return Response($agenda, StatusCodeInterface::STATUS_OK);
    }

    public function post(AgendamentoPostRequest $request)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if ($funcionario->fazServico($servico)) {
            if ($funcionario->disponivel($request->get('inicio'), $request->get('fim'))) {
                $agendamento = $this->repository->create($request->all());
                return Response($agendamento, StatusCodeInterface::STATUS_CREATED);
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
            return Response($agenda, StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function put(AgendamentoPostRequest $request, int $id)
    {
        $funcionario = $this->funcionario->find($request->get('funcionario_id'));
        $servico = $request->get('servico_id');

        if ($funcionario->fazServico($servico)) {
            if (
                $funcionario->disponivel($request->get('inicio'), $request->get('fim'), $id)) {
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
        return Response($this->repository->find($id));
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
}
