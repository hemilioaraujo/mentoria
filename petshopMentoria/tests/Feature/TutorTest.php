<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tutor;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;

class TutorTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_get_single_tutor_passing_id()
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

    public function test_should_persist_a_tutor()
    {
        $tutor = new stdClass();
        $tutor->nome = 'Joaquim';
        $tutor->telefone = '(32)99999-0000';
        $tutor->cpf = '12345678900';

        $responsePost = $this->postJson(route('tutores.registrar'), [
            'nome' => $tutor->nome,
            'telefone' => $tutor->telefone,
            'cpf' => $tutor->cpf,
        ]);

        $responsePost->assertStatus(StatusCodeInterface::STATUS_CREATED);

        $tutorRegistrado=Tutor::all()->last();
        $responseGet = $this->getJson(route('tutores.exibir', [$tutorRegistrado->id]));
        $responseGet->assertStatus(StatusCodeInterface::STATUS_OK);

        $responseGet->assertJson([
            'nome' => $tutor->nome,
            'telefone' => $tutor->telefone,
            'cpf' => $tutor->cpf,
        ]);
    }

    public function test_should_update_a_tutor_using_put()
    {
        $tutor = Tutor::factory()->createOne([
            'nome' => 'Manuel',
            'telefone' => '(32)99999-8888',
            'cpf' => '11111111111'
        ]);

        $response = $this->putJson(route('tutores.alterar', ['id' => $tutor->id]), [
            'nome' => 'Maria',
            'telefone' => '(31)99999-7777',
            'cpf' => '22222222222',
        ]);

        $response->assertStatus(StatusCodeInterface::STATUS_OK);

        $responseGet = $this->getJson(route('tutores.exibir', [$tutor->id]));
        $responseGet->assertStatus(StatusCodeInterface::STATUS_OK);

        $responseGet->assertJson([
            'nome' => 'Maria',
            'telefone' => '(31)99999-7777',
            'cpf' => '22222222222',
        ]);
    }

    public function test_should_update_a_tutor_using_patch()
    {
        $tutor = Tutor::factory()->createOne([
            'nome' => 'Manuel',
            'telefone' => '(32)99999-8888',
            'cpf' => '11111111111'
        ]);

        $response = $this->patchJson(route('tutores.corrigir', ['id' => $tutor->id]), [
            'nome' => 'Maria',
            'cpf' => '22222222222',
        ]);

        $response->assertStatus(StatusCodeInterface::STATUS_OK);

        $responseGet = $this->getJson(route('tutores.exibir', [$tutor->id]));
        $responseGet->assertStatus(StatusCodeInterface::STATUS_OK);

        $responseGet->assertJson([
            'nome' => 'Maria',
            'telefone' => '(32)99999-8888',
            'cpf' => '22222222222',
        ]);
    }

    public function test_should_delete_a_tutor()
    {
        $tutor = Tutor::factory()->createOne([
            'nome' => 'Joaquim',
            'telefone' => '(32)99999-8888',
            'cpf' => '11111111111'
        ]);

        $responseGet = $this->getJson(route('tutores.exibir', [$tutor->id]));
        $responseGet->assertStatus(StatusCodeInterface::STATUS_OK);
        $responseDelete = $this->deleteJson(route('tutores.remover', ['id' => $tutor->id]));
        $responseDelete->assertStatus(StatusCodeInterface::STATUS_NO_CONTENT);
        $responseGet = $this->getJson(route('tutores.exibir', [$tutor->id]));
        $responseGet->assertStatus(StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
