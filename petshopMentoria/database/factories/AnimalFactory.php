<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'idade' => $this->faker->numberBetween(0, 150),
            'tipo' => $this->faker->randomElement(['gato', 'cachorro']),
            'raca' => $this->faker->firstName(),
        ];
    }
}
