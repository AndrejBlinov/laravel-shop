<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            ['name' => 'Склад Москва', 'city_id' => 1, 'address' => 'Москва'],
            ['name' => 'Склад Москва', 'city_id' => 1, 'address' => 'Москва'],
            ['name' => 'Склад Санкт-Петербург', 'city_id' => 2, 'address' => 'Санкт-Петербург'],
            ['name' => 'Склад Санкт-Петербург', 'city_id' => 2, 'address' => 'Санкт-Петербург'],
            ['name' => 'Склад Казань', 'city_id' => 3, 'address' => 'Казань'],
            ['name' => 'Склад Казань', 'city_id' => 3, 'address' => 'Казань'],
            ['name' => 'Склад Екатеринбург', 'city_id' => 4, 'address' => 'Екатеринбург'],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}
