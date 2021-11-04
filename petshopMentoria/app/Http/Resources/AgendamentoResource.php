<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'inicio' => $this->inicio,
            'fim' => $this->fim,
            'funcionario' => [
                'id' => $this->funcionario->id,
                'nome' => $this->funcionario->nome
            ],
            'animal' => [
                'id' => $this->animal->id,
                'nome' => $this->animal->nome,
                'tipo' => $this->animal->tipo,
                'raca' => $this->animal->raca,
            ],
            'tutor' => [
                'id' => $this->animal->tutor->id,
                'nome' => $this->animal->tutor->nome,
                'telefone' => $this->animal->tutor->telefone,
            ],
            'servico' => [
                'id' => $this->servico->id,
                'descricao' => $this->servico->descricao,
                'valor' => $this->servico->valor,
            ],

        ];
    }
}
