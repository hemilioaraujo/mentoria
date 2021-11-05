<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'nome' => $this->nome,
            'idade' => $this->idade,
            'tipo' => $this->tipo,
            'raca' => $this->raca,
            'tutor' => [
                'id' => $this->tutor->id,
                'nome' => $this->tutor->nome,
                'telefone' => $this->tutor->telefone,
                'cpf' => $this->tutor->cpf,
                'id' => $this->tutor->id,
            ],
        ];
    }
}
