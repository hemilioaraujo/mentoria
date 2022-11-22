<?php

namespace App\Services;

use Exception;
use App\DTO\RespostaDTO;
use Illuminate\Support\Facades\Log;
use Facade\FlareClient\Http\Response;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Funcionario\FuncionarioRequest;
use App\Http\Requests\Funcionario\FuncionarioPatchRequest;
use App\Repositories\Contracts\FuncionarioRepositoryInterface;

class FuncionarioService
{
    private FuncionarioRepositoryInterface $repository;

    public function __construct(FuncionarioRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listarFuncionarios()
    {
        try {
            $funcionarios = $this->repository->all();

            return new RespostaDTO(
                StatusCodeInterface::STATUS_OK,
                $funcionarios
            );
        } catch (Exception $e) {
            Log::error("Erro ao listar funcionários.", ['exception' => $e->getMessage()]);

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }
    }

    public function registrarFuncionario(FuncionarioRequest $request)
    {
        try {
            $funcionario = $this->repository->create($request->all());

            return new RespostaDTO(
                StatusCodeInterface::STATUS_CREATED,
                $funcionario
            );
        } catch (Exception $e) {
            Log::error("Erro ao registrar funcionário.", ['exception' => $e->getMessage()]);

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }
    }

    public function exibirFuncionario(int $id)
    {
        try {
            $funcionario = $this->repository->find($id);

            if ($funcionario) {
                return new RespostaDTO(
                    StatusCodeInterface::STATUS_OK,
                    $funcionario
                );
            }
        } catch (Exception $e) {
            Log::error("Erro ao exibir funcionário.", ['exception' => $e->getMessage()]);

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }

        return new RespostaDTO(StatusCodeInterface::STATUS_NOT_FOUND, new Collection([]));
    }

    public function corrigirFuncionario(FuncionarioPatchRequest $request, int $id)
    {
        try {
            if ($this->repository->update($request->all(), $id)) {
                return new RespostaDTO(
                    StatusCodeInterface::STATUS_OK,
                    new Collection([])
                );
            }

            return new RespostaDTO(StatusCodeInterface::STATUS_NOT_FOUND, new Collection([]));
        } catch (Exception $e) {
            Log::error("Erro ao corrigir funcionário.", ['exception' => $e->getMessage()]);

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }
    }

    public function alterarFuncionario(FuncionarioRequest $request, int $id)
    {
        try {
            if ($this->repository->update($request->all(), $id)) {
                return new RespostaDTO(
                    StatusCodeInterface::STATUS_OK,
                    new Collection([])
                );
            }

            return new RespostaDTO(StatusCodeInterface::STATUS_NOT_FOUND, new Collection([]));
        } catch (Exception $e) {
            Log::error("Erro ao alterar funcionário.", ['exception' => $e->getMessage()]);

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }
    }

    public function removerFuncionario(int $id)
    {
        try {
            if ($this->repository->delete($id)) {
                return new RespostaDTO(StatusCodeInterface::STATUS_NO_CONTENT, new Collection([]));
            }

            return new RespostaDTO(StatusCodeInterface::STATUS_NOT_FOUND, new Collection([]));
        } catch (Exception $e) {
            Log::error(
                "Erro ao excluir funcionário.",
                ['exception' => $e->getMessage()]
            );

            return new RespostaDTO(StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE, new Collection([]));
        }
    }

    public function agendamentos(int $id)
    {
        try {
            $funcionario = $this->repository->find($id);
            
            if ($funcionario) {
                return $funcionario->agendamentos->toJson();
                return Response($funcionario->agendamentos, StatusCodeInterface::STATUS_OK);
            }

            return new RespostaDTO(
                StatusCodeInterface::STATUS_NOT_FOUND,
                new Collection([])
            );
        } catch (Exception $e) {
            Log::error(
                "Erro ao listar agendamentos.",
                ['exception' => $e->getMessage()]
            );

            return new RespostaDTO(
                StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE,
                new Collection([])
            );
        }
    }
}
