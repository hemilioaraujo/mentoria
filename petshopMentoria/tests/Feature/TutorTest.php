<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tutor;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    public function test_base_resource_exists()
    {
        $response = $this->get('api/tutores');

        $response->assertStatus(StatusCodeInterface::STATUS_OK);
    }

    public function test_should_return_all_tutors()
    {
        $tutores = Tutor::factory(3)->create();
        $response = $this->getJson(route('tutores.listar'));
        $response->assertStatus(StatusCodeInterface::STATUS_OK);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json) use ($tutores) {
            $json->whereAllType([
                '0.id' => 'integer',
                '0.created_at' => 'string',
                '0.updated_at' => 'string',
                '0.nome' => 'string',
                '0.telefone' => 'string',
                '0.cpf' => 'string',
            ]);

            $json->hasAll([
                '0.id',
                '0.created_at',
                '0.updated_at',
                '0.nome',
                '0.telefone',
                '0.cpf',
            ]);

            $tutor = $tutores->first();

            $json->whereAll([
                '0.id' => $tutor->id,
                '0.created_at' => $tutor->created_at->toJson(),
                '0.updated_at' => $tutor->updated_at->toJson(),
                '0.nome' => $tutor->nome,
                '0.telefone' => $tutor->telefone,
                '0.cpf' => $tutor->cpf,
            ]);
        });
    }

    public function test_get_single_tutor()
    {
        $tutor = Tutor::factory(1)->createOne();
        $response = $this->getJson(route('tutores.exibir', [$tutor->id]));
        $response->assertStatus(StatusCodeInterface::STATUS_OK);

        $response->assertJson(function (AssertableJson $json) use ($tutor) {
            $json->whereAllType([
                'id' => 'integer',
                'created_at' => 'string',
                'updated_at' => 'string',
                'nome' => 'string',
                'telefone' => 'string',
                'cpf' => 'string',
            ]);

            $json->hasAll([
                'id',
                'created_at',
                'updated_at',
                'nome',
                'telefone',
                'cpf',
            ]);

            $json->whereAll([
                'id' => $tutor->id,
                'created_at' => $tutor->created_at->toJson(),
                'updated_at' => $tutor->updated_at->toJson(),
                'nome' => $tutor->nome,
                'telefone' => $tutor->telefone,
                'cpf' => $tutor->cpf,
            ]);
        });
    }

    public function test_should_return_404()
    {
        $tutor = Tutor::factory(1)->createOne();
        $response = $this->getJson(route('tutores.exibir', [$tutor->id + 1]));
        $response->assertStatus(StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
