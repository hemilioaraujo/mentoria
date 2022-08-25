<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TutorFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'telefone' => $this->faker->phoneNumber(),
            'cpf' => $this->faker->numberBetween(10000000000,99999999999),
        ];
    }
}
