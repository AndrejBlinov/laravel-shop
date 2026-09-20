<?php

use App\Models\City;
use App\Models\Product;
use App\Models\Warehouse;

test('детальная страница товара открывается успешно', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create([
        'city_id' => $city->id,
        'name' => 'Склад МСК',
    ]);
    
    $product = Product::factory()->create(['name' => 'Игровой ноутбук']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 15]);

    // Act
    $response = $this->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);
    $response->assertSee('Игровой ноутбук');
    $response->assertSee('Склад МСК');
    $response->assertSee('15');
});

test('на детальной странице склад выбранного города подсвечивается', function () {
    // Arrange
    $cityMoscow = City::factory()->create(['name' => 'Москва']);
    $citySpb = City::factory()->create(['name' => 'Санкт-Петербург']);

    $warehouseMsk = Warehouse::factory()->create([
        'city_id' => $cityMoscow->id,
        'name' => 'Склад МСК',
    ]);
    $warehouseSpb = Warehouse::factory()->create([
        'city_id' => $citySpb->id,
        'name' => 'Склад СПБ',
    ]);

    $product = Product::factory()->create(['name' => 'Телефон']);
    $product->warehouses()->attach($warehouseMsk->id, ['quantity' => 10]);
    $product->warehouses()->attach($warehouseSpb->id, ['quantity' => 5]);

    // Act: Пользователь выбрал Москву
    $response = $this->withSession(['city_id' => $cityMoscow->id])
                     ->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);
   
        // Получаем сырой HTML
    $html = $response->getContent();

    // Проверяем регулярным выражением: ищем data-warehouse-id="1", после которого (через любые пробелы/переносы) идет data-is-current="true"
    $patternMsk = '/data-warehouse-id="' . $warehouseMsk->id . '"\s+data-is-current="true"/';
    $this->assertMatchesRegularExpression($patternMsk, $html);

    $patternSpb = '/data-warehouse-id="' . $warehouseSpb->id . '"\s+data-is-current="false"/';
    $this->assertMatchesRegularExpression($patternSpb, $html);
});

test('если город не выбран, подсветки склада нет', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create([
        'city_id' => $city->id,
        'name' => 'Склад МСК',
    ]);

    $product = Product::factory()->create(['name' => 'Планшет']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 20]);

    // Act: Запрос БЕЗ city_id в сессии
    $response = $this->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);

            // Получаем сырой HTML
    $html = $response->getContent();

    // Проверяем регулярным выражением: ищем data-warehouse-id="1", после которого (через любые пробелы/переносы) идет data-is-current="true"
    $patternMsk = '/data-warehouse-id="' . $warehouse->id . '"\s+data-is-current="false"/';
    $this->assertMatchesRegularExpression($patternMsk, $html);
});

test('несуществующий товар возвращает 404', function () {
    // Act: Запрашиваем товар с несуществующим ID
    $response = $this->get(route('products.show', 99999));

    // Assert
    $response->assertStatus(404);
});

test('товар с нулевым остатком всё равно отображается на детальной странице', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create([
        'city_id' => $city->id,
        'name' => 'Склад МСК',
    ]);

    $product = Product::factory()->create(['name' => 'Редкий товар']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 0]);

    // Act
    $response = $this->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);
    $response->assertSee('Редкий товар');
    $response->assertSee('0'); // Остаток 0 должен отображаться
});

test('если город не выбран, кнопка корзины скрыта и показано уведомление', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create(['city_id' => $city->id]);
    $product = Product::factory()->create(['name' => 'Товар']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 10]); // Товар есть, но город не выбран

    // Act: Запрос БЕЗ city_id
    $response = $this->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);
    // Кнопки быть не должно
    $response->assertDontSee('id="add-to-cart-btn"', false);
    // Уведомление должно быть
    $response->assertSee('Для добавления товара в корзину необходимо выбрать город', false);
});

test('если в выбранном городе остаток 0, кнопка корзины скрыта', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create(['city_id' => $city->id]);
    $product = Product::factory()->create(['name' => 'Товар']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 0]); // Остаток 0

    // Act: Запрос с выбранным городом
    $response = $this->withSession(['city_id' => $city->id])
                     ->get(route('products.show', $product->id));

    $response->assertStatus(200);
    $response->assertDontSee('id="add-to-cart-btn"', false);
    // Уведомления о выборе города тоже быть не должно
    $response->assertDontSee('Для добавления товара в корзину необходимо выбрать город', false);
});

test('если в выбранном городе остаток больше 0, кнопка корзины отображается', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create(['city_id' => $city->id]);
    $product = Product::factory()->create(['name' => 'Товар']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 15]); // Остаток > 0

    // Act
    $response = $this->withSession(['city_id' => $city->id])
                     ->get(route('products.show', $product->id));

    // Assert
    $response->assertStatus(200);
    $response->assertSee('id="add-to-cart-btn"', false);
});