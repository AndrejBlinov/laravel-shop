<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Очищаем старые данные (чтобы не было дублей при повторном запуске)
        Product::truncate();

        // Создаём тестовые товары
        Product::create([
            'name' => 'Игровой ноутбук ASUS',
            'description' => 'Мощный ноутбук для игр и работы',
            'price' => 15000000,
            'stock' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Механическая клавиатура Keychron',
            'description' => 'Синие свичи, RGB подсветка',
            'price' => 850000,
            'stock' => 15,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Игровая мышь Logitech',
            'description' => '25000 DPI, беспроводная',
            'price' => 450000,
            'stock' => 20,
            'is_active' => true,
        ]);

        // Добавим ещё несколько товаров для реалистичности
        Product::create([
            'name' => 'Монитор Samsung 27"',
            'description' => '4K, 144Hz, IPS матрица',
            'price' => 4500000,
            'stock' => 8,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Наушники Sony WH-1000XM5',
            'description' => 'Шумоподавление, 30 часов работы',
            'price' => 3500000,
            'stock' => 12,
            'is_active' => true,
        ]);

        // Товар, который не активен (для проверки фильтра)
        Product::create([
            'name' => 'Снят с продажи товар',
            'description' => 'Этот товар не должен отображаться',
            'price' => 100000,
            'stock' => 0,
            'is_active' => false,
        ]);
    }
}