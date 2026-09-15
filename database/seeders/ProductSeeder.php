<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Warehouse;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Получаем все созданные склады
        $warehouses = Warehouse::all();

        if ($warehouses->isEmpty()) {
            $this->command->error('Склады не найдены! Сначала запустите WarehouseSeeder.');
            return;
        }

        // 2. Создаем вспомогательную функцию для привязки случайных складов к любому товару
        $attachRandomWarehouses = function (Product $product) use ($warehouses) {
            $randomWarehouses = $warehouses->random(rand(1, 3)); // от 1 до 3 складов
            
            $attachData = [];
            foreach ($randomWarehouses as $warehouse) {
                $attachData[$warehouse->id] = [
                    'quantity' => rand(5, 150), // Случайный остаток
                ];
            }
            
            $product->warehouses()->attach($attachData);
        };

        // 3. Создаем конкретные (хардкод) товары и сразу привязываем к ним склады
        $specificProducts = [
            [
                'name' => 'Игровой ноутбук ASUS',
                'description' => 'Мощный ноутбук для игр и работы',
                'price' => 15000000,
                'is_active' => true,
            ],
            [
                'name' => 'Механическая клавиатура Keychron',
                'description' => 'Синие свичи, RGB подсветка',
                'price' => 850000,
                'is_active' => true,
            ],
            [
                'name' => 'Игровая мышь Logitech',
                'description' => '25000 DPI, беспроводная',
                'price' => 450000,
                'is_active' => true,
            ],
            [
                'name' => 'Монитор Samsung 27"',
                'description' => '4K, 144Hz, IPS матрица',
                'price' => 4500000,
                'is_active' => true,
            ],
            [
                'name' => 'Наушники Sony WH-1000XM5',
                'description' => 'Шумоподавление, 30 часов работы',
                'price' => 3500000,
                'is_active' => true,
            ],
            [
                'name' => 'Снят с продажи товар',
                'description' => 'Этот товар не должен отображаться',
                'price' => 100000,
                'is_active' => false,
            ],
        ];

        foreach ($specificProducts as $data) {
            $product = Product::create($data);
            $attachRandomWarehouses($product); // Применяем нашу функцию
        }

        // 4. Создаем дополнительные случайные товары через фабрику и тоже привязываем склады
       //Product::factory(20)->create()->each($attachRandomWarehouses);
        
        $this->command->info('Товары и их остатки на складах успешно созданы!');
    }
}