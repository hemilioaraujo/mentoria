<?php

namespace App\Services;

use App\DTO\RespostaDTO;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\AnimalResource;
use Illuminate\Support\Facades\Request;
use Fig\Http\Message\StatusCodeInterface;
use App\Http\Requests\Animal\AnimalPutRequest;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Http\Requests\Animal\AnimalPatchRequest;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AnimalService
{
    private AnimalRepositoryInterface $repository;
    private $redis;

    public function __construct(AnimalRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->redis = Redis::connection();
    }

    public function listarAnimais()
    {
        try {
            $animais = $this->repository->all();
            return new RespostaDTO(StatusCodeInterface::STATUS_OK, $animais);
        } catch (Exception $e) {
            Log::error("Erro ao listar animais.", ['exception' => $e->getMessage()]);
            return new RespostaDTO(StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE, new Collection([]));
        }
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        try {
            $animal = $this->repository->create($request->all());
            return new RespostaDTO(StatusCodeInterface::STATUS_CREATED, $animal);
        } catch (Exception $e) {
            Log::error("Erro ao registrar animal.", ['exception' => $e->getMessage()]);
            return new RespostaDTO(StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE, new Collection([]));
        }
    }

    public function exibirAnimal(int $id)
    {
        try {
            $animal = $this->repository->find($id);
        } catch (Exception $e) {
            Log::error("Erro ao exibir animal.", ['exception' => $e->getMessage()]);
            return new RespostaDTO(StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE, new Collection([]));
        }

        if ($animal) {
            return new RespostaDTO(StatusCodeInterface::STATUS_OK, $animal);
        }

        return new RespostaDTO(StatusCodeInterface::STATUS_NOT_FOUND, $animal);
    }

    public function corrigirAnimal(AnimalPatchRequest $request, int $id)
    {
        try {
            // [FIXME:] QUANDO MANDA CAMPO NÃO EXISTENTE DA ERRO]
            if ($this->repository->update($request->all(), $id)) {
                return [
                    'success' => true,
                    'data' => [],
                    'status_code' => StatusCodeInterface::STATUS_OK
                ];
            }
            return [
                'success' => true,
                'data' => [],
                'status_code' => StatusCodeInterface::STATUS_NOT_FOUND
            ];
        } catch (Exception $e) {
            Log::error(
                "Erro ao corrigir animal.",
                ['exception' => $e->getMessage()]
            );
            return [
                'success' => false,
                'exception' => $e->getMessage(),
                'status_code' => StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE
            ];
        }
    }

    public function alterarAnimal(AnimalPutRequest $request, int $id)
    {
        try {
            if ($this->repository->update($request->all(), $id)) {
                return [
                    'success' => true,
                    'data' => [],
                    'status_code' => StatusCodeInterface::STATUS_OK
                ];
            }
            return [
                'success' => true,
                'data' => [],
                'status_code' => StatusCodeInterface::STATUS_NOT_FOUND
            ];
        } catch (Exception $e) {
            Log::error(
                "Erro ao alterar animal.",
                ['exception' => $e->getMessage()]
            );
            return [
                'success' => false,
                'exception' => $e->getMessage(),
                'status_code' => StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE
            ];
        }
    }

    public function removerAnimal(int $id)
    {
        try {
            if ($this->repository->delete($id)) {
                return [
                    'success' => true,
                    'data' => [],
                    'status_code' => StatusCodeInterface::STATUS_NO_CONTENT
                ];
            }
            return [
                'success' => true,
                'data' => [],
                'status_code' => StatusCodeInterface::STATUS_NOT_FOUND
            ];
        } catch (Exception $e) {
            Log::error(
                "Erro ao excluir animal.",
                ['exception' => $e->getMessage()]
            );
            return [
                'success' => false,
                'data' => [],
                'status_code' => StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE
            ];
        }
    }

    public function racas()
    {
        $racas = $this->getRemoteRacas();
        return Response()->json(
            ["raças" => $racas],
            StatusCodeInterface::STATUS_OK
        );
    }

    private function getRemoteRacas()
    {
        $client = new Client();
        $url = "https://dog.ceo/api/breeds/list/all";
        $response = $client->request('get', $url, ['http_errors' => false]);
        if ($response->getStatusCode() == StatusCodeInterface::STATUS_OK) {
            $body = json_decode($response->getBody(), true);
            $racas = array_keys($body['message']);
            $this->setRacasOnRedis($racas);
            return $racas;
        }
        return $this->getRacasFromRedis();
    }

    private function setRacasOnRedis(array $racas)
    {
        $this->delRacasOnRedis();
        foreach ($racas as $raca) {
            $this->redis->rpush('racas', $raca);
        }
    }

    private function getRacasFromRedis()
    {
        if ($this->redis->exists('racas')) {
            return $this->redis->lrange('racas', 0, -1);
        }
        return [];
    }

    private function delRacasOnRedis()
    {
        if ($this->redis->exists('racas')) {
            return $this->redis->del('racas');
        }
        return false;
    }
}
