<?php
namespace Database\Factories;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Склад',
            'city_id' => City::factory(),
            'address' => $this->faker->address(),
        ];
    }
}