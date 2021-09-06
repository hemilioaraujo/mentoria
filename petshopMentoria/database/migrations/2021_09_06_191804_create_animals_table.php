<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // identificador único, nome, idade, se é gato ou cachorro e sua respectiva raça; 
        // Além do nome e telefone para contato de seu dono.
        Schema::create('animais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 25);
            $table->integer('idade');
            $table->set('tipo', ['gato', 'cachorro']);
            $table->string('raca', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animais');
    }
}
