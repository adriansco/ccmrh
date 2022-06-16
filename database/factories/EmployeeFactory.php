<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'status' => $this->faker->randomElement(['A', 'B']),
            'payroll' => $this->faker->numberBetween(1,500),
            'hire_date' => $this->faker->date(),
        ];
    }
}
