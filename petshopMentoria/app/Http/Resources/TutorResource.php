<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
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
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'animais' => $this->animaisToArray(),
        ];
    }

    public function animaisToArray()
    {
        $colecao = [];

        foreach ($this->animais as $animal) {
            $colecao[] = [
                'id' => $animal->id,
                'nome' => $animal->nome,
                'idade' => $animal->idade,
                'tipo' => $animal->tipo,
            ];
        }
        return $colecao;
    }
}
