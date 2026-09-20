<?php

use App\Models\City;
use App\Models\Warehouse;

test('пользователь может успешно выбрать город', function () {
    // Arrange: Создаем город и склад
    $city = City::factory()->create(['name' => 'Москва']);
    Warehouse::factory()->create(['city_id' => $city->id]);
    
    // Act: Делаем POST-запрос
    $response = $this->post(route('city.store'), [
        'city_id' => $city->id,
    ]);
    
    // Assert: Проверяем редирект и сессию
    $response->assertRedirect();
    $response->assertSessionHas('city_id', $city->id);
});

test('нельзя выбрать несуществующий город', function () {
    // Act: Пытаемся отправить ID, которого нет в базе
    $response = $this->post(route('city.store'), [
        'city_id' => 99999,
    ]);
    
    // Assert: Laravel должен вернуть ошибку валидации
    $response->assertSessionHasErrors('city_id');
});