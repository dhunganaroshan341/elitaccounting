<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(['Dental', 'General', 'Hospital', 'Suppliers']),
            'estd' => $this->faker->year,
            'vat_no' => $this->faker->unique()->randomNumber(9),
        ];
    }
}
