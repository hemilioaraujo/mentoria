<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationTutorAnimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->UnsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->dropForeign('animais_tutor_id_foreign');
            $table->dropColumn('tutor_id');
        });
    }
}
