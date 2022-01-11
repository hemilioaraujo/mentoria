<?php

namespace App\Services;

use App\Http\Requests\Animal\AnimalPatchRequest;
use App\Http\Requests\Animal\AnimalPostRequest;
use App\Http\Requests\Animal\AnimalPutRequest;
use App\Http\Resources\AnimalResource;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use Exception;
use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;

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
            return ['success' => true, 'data' => $animais];
        } catch (Exception $e) {
            return ['success' => false, 'exception' => $e->getMessage()];
        }
        // return Response(AnimalResource::collection($animais), StatusCodeInterface::STATUS_OK);
    }

    public function registrarAnimal(AnimalPostRequest $request)
    {
        try {
            $animal = $this->repository->create($request->all());
            return ['success' => true, 'data' => $animal];
        } catch (Exception $e) {
            return ['success' => false, 'exception' => $e->getMessage()];
        }
        // return Response(new AnimalResource($animal), StatusCodeInterface::STATUS_CREATED);
    }

    public function exibirAnimal(int $id)
    {
        $animal = $this->repository->find($id);

        if ($animal) {
            return Response(new AnimalResource($animal), StatusCodeInterface::STATUS_OK);
        }
        return Response([], StatusCodeInterface::STATUS_NOT_FOUND);
    }

    public function corrigirAnimal(AnimalPatchRequest $request, int $id)
    {
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

    public function alterarAnimal(AnimalPutRequest $request, int $id)
    {
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

    public function removerAnimal(int $id)
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
