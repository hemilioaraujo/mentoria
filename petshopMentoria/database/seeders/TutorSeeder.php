<?php

namespace Database\Seeders;

use App\Models\Tutor;
use Illuminate\Database\Seeder;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tutor::create(
            [
                'nome' => 'Hemílio Melo',
                'telefone' => '(32)99999-8888',
                'cpf' => '12345678900'
            ]
        );

        Tutor::create(
            [
                'nome' => 'Francielle Belchior',
                'telefone' => '(32)88888-9999',
                'cpf' => '00123456789'
            ]
        );

        Tutor::create(
            [
                'nome' => 'Manoel Joaquim',
                'telefone' => '(53)88888-9999',
                'cpf' => '00011122233'
            ]
        );
    }
}
