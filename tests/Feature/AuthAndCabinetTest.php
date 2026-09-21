<?php

use App\Models\User;

test('гость не может получить доступ к кабинету и перенаправляется на страницу входа', function () {
    // Act: Делаем запрос к кабинету без авторизации
    $response = $this->get(route('cabinet.index')); 

    // Assert: Ожидаем редирект на страницу логина
    // Замени 'login' на реальный name твоего маршрута входа, если он другой (например, 'auth.login')
    $response->assertRedirect(route('login'));
});

test('авторизованный пользователь может получить доступ к кабинету', function () {
    // Arrange: Создаем пользователя в тестовой БД
    $user = User::factory()->create([
        'name' => 'Иван Тестовый',
        'email' => 'test@example.com',
    ]);

    // Act: Делаем запрос от имени этого пользователя
    // Магический метод actingAs() автоматически авторизует пользователя в тесте
    $response = $this->actingAs($user)->get(route('cabinet.index'));

    // Assert: Страница должна загрузиться успешно
    $response->assertStatus(200);
    
    // И мы должны видеть имя пользователя на странице (если оно там выводится)
    $response->assertSee('Иван Тестовый');
});

test('пользователь может успешно выйти из системы', function () {
    // Arrange
    $user = User::factory()->create();

    // Act: Делаем POST-запрос на выход от имени пользователя
    $response = $this->actingAs($user)->post(route('logout'));
    
    // И пользователь больше не должен быть аутентифицирован
    $this->assertGuest();
});