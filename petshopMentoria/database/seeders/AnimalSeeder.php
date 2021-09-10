<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Tutor;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hemilio = Tutor::where('cpf', '12345678900')->get()->first();
        $fran = Tutor::where('cpf', '00123456789')->get()->first();
        $manoel = Tutor::where('cpf', '00011122233')->get()->first();

        Animal::create(
            [
                'nome' => 'Nina',
                'idade' => '6',
                'tipo' => 'cachorro',
                'raca' => 'Podle',
                'tutor_id' => $fran->id
            ]
        );

        Animal::create(
            [
                'nome' => 'Beethoven',
                'idade' => '15',
                'tipo' => 'cachorro',
                'raca' => 'Tomba lata',
                'tutor_id' => $fran->id
            ]
        );

        Animal::create(
            [
                'nome' => 'Teka',
                'idade' => '10',
                'tipo' => 'cachorro',
                'raca' => 'Tomba lata',
                'tutor_id' => $hemilio->id
            ]
        );

        Animal::create(
            [
                'nome' => 'Bixano',
                'idade' => '4',
                'tipo' => 'gato',
                'raca' => 'Siame',
                'tutor_id' => $manoel->id
            ]
        );
    }
}
