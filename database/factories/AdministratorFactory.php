<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administrator;

class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->firstName(),
            // 'lastname' => $this->faker->lastName(),
            'role_id' => 2,
            'user_id' => $this->faker->numberBetween(1,15),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'department' => $this->faker->companySuffix(),
            'position' =>  $this->faker->title(),
        ];
    }
}
