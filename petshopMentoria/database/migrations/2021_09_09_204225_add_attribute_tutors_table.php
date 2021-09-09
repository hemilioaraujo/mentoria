<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->string('cpf', 11)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tutores', 'cpf')) {
            Schema::table('tutores', function (Blueprint $table) {
                $table->dropColumn('cpf');
            });
        }
    }
}
