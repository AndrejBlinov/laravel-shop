<?php

use App\Models\City;
use App\Models\Product;
use App\Models\Warehouse;

test('товар НЕ показывается, если в выбранном городе его остаток равен 0', function () {
    // Arrange: Используем фабрики
    $cityMoscow = City::factory()->create(['name' => 'Москва']);
    $citySpb = City::factory()->create(['name' => 'Санкт-Петербург']);

    $warehouseMsk = Warehouse::factory()->create(['city_id' => $cityMoscow->id, 'name' => 'Склад МСК']);
    $warehouseSpb = Warehouse::factory()->create(['city_id' => $citySpb->id, 'name' => 'Склад СПБ']);

    // Товар с нулевым остатком в Москве
    $productZeroInMsk = Product::factory()->create(['name' => 'Товар с нулевым остатком в МСК']);
    $productZeroInMsk->warehouses()->attach($warehouseMsk->id, ['quantity' => 0]);

    // Товар с остатком 10 в Москве
    $productAvailableInMsk = Product::factory()->create(['name' => 'Товар в наличии в МСК']);
    $productAvailableInMsk->warehouses()->attach($warehouseMsk->id, ['quantity' => 10]);

    // Товар только в СПБ
    $productOnlyInSpb = Product::factory()->create(['name' => 'Товар только в СПБ']);
    $productOnlyInSpb->warehouses()->attach($warehouseSpb->id, ['quantity' => 5]);

    // Act: Запрос с выбранной Москвой
    $response = $this->withSession(['city_id' => $cityMoscow->id])
                     ->get(route('products.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertSee('Товар в наличии в МСК');
    $response->assertDontSee('Товар с нулевым остатком в МСК');
    $response->assertDontSee('Товар только в СПБ');
});

test('товар показывается, если город не выбран, но остаток > 0 где-либо', function () {
    // Arrange
    $city = City::factory()->create(['name' => 'Москва']);
    $warehouse = Warehouse::factory()->create(['city_id' => $city->id]);
    
    $product = Product::factory()->create(['name' => 'Универсальный товар']);
    $product->warehouses()->attach($warehouse->id, ['quantity' => 5]);

    // Act: Запрос БЕЗ city_id
    $response = $this->get(route('products.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertSee('Универсальный товар');
});