<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    public function up()
    {
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique();
            $table->timestamps();
            $table->string('nome', 30);
            $table->string('telefone', 15);
        });

        Schema::create('tipos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 25);
            $table->string('observacao', 1500);
        });

        Schema::create('animais', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('tipo_id');
            $table->UnsignedBigInteger('tutor_id');
            $table->timestamps();
            $table->string('nome', 25);
            $table->integer('idade');
            $table->string('raca', 15);

            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
        });

        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('descricao', 30);
            $table->float('valor', 8, 2)->default(0.00);
        });

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 30);
        });

        Schema::create('funcionarios_servicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('servico_id');

            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->foreign('servico_id')->references('id')->on('servicos');
        });

        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('servico_id');
            $table->dateTime('inicio');
            $table->dateTime('fim');

            $table->foreign('animal_id')->references('id')->on('animais');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->foreign('servico_id')->references('id')->on('servicos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendamentos');
        Schema::dropIfExists('funcionarios_servicos');
        Schema::dropIfExists('funcionarios');
        Schema::dropIfExists('servicos');
        Schema::dropIfExists('animais');
        Schema::dropIfExists('tipos');
        Schema::dropIfExists('tutores');
    }
}
