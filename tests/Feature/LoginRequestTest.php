<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// 1. Тестируем кастомные сообщения из метода messages()
test('валидация требует корректный email', function () {
    $response = $this->post(route('login'), [
        'email' => 'не-почта',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors([
        'email' => 'Некорректный email',
    ]);
});

test('валидация требует наличие email', function () {
    $response = $this->post(route('login'), [
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors([
        'email' => 'Введите email',
    ]);
});

test('валидация требует наличие пароля', function () {
    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
    ]);

    $response->assertSessionHasErrors([
        'password' => 'Введите пароль',
    ]);
});

// 2. Тестируем метод authenticate() (самая важная часть!)
test('неверный пароль вызывает кастомную ошибку из метода authenticate', function () {
    // Создаем пользователя с известным паролем
    User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('correct-password'),
    ]);

    // Пытаемся войти с неправильным паролем
    $response = $this->post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'wrong-password',
    ]);

    // Метод authenticate() должен выбросить ValidationException с этим сообщением
    $response->assertSessionHasErrors([
        'email' => 'Неверный email или пароль',
    ]);
    
    // Убеждаемся, что пользователь НЕ авторизован
    $this->assertGuest();
});

// 3. Тестируем успешный сценарий авторизации
test('успешная авторизация с корректными данными', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('correct-password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'correct-password',
    ]);

    // Проверяем, что пользователя перенаправило (обычно на / или /cabinet)
    // Замени '/' на route('cabinet.index'), если у тебя редирект туда
    $response->assertRedirect('/cabinet'); 
    
    // Проверяем, что пользователь действительно вошел в систему
    $this->assertAuthenticatedAs($user);
});