<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tutor;
use App\Models\Animal;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalTest extends TestCase
{
    use RefreshDatabase;

    public function test_deve_retornar_todos_animais()
    {
        $tutor = Tutor::factory()->createOne();
        $animais = Animal::factory(3)->create(['tutor_id' => $tutor->id]);
        $response = $this->getJson(route('animais.listar'));
        $response->assertStatus(StatusCodeInterface::STATUS_OK);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use ($animais) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.created_at' => 'string',
                '0.updated_at' => 'string',
                '0.nome' => 'string',
                '0.idade' => 'integer',
                '0.tipo' => 'string',
                '0.raca' => 'string',
            ]);

            $json->hasAll([
                '0.id',
                '0.created_at',
                '0.updated_at',
                '0.nome',
                '0.idade',
                '0.tipo',
                '0.raca',
            ]);

            $animal = $animais->first();

            $json->whereAll([
                '0.id' => $animal->id,
                '0.created_at' => $animal->created_at->toJson(),
                '0.updated_at' => $animal->updated_at->toJson(),
                '0.nome' => $animal->nome,
                '0.idade' => $animal->idade,
                '0.tipo' => $animal->tipo,
                '0.raca' => $animal->raca,
            ]);
        });
    }
}
