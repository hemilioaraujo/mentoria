<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
