<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Показать форму регистрации
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Обработка регистрации
     * Автоматически валидирует через StoreUserRequest
     */
    public function register(StoreUserRequest $request): RedirectResponse
    {
        // Создаём пользователя (пароль хешируем!)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => 2
        ]);

        // Автоматически логиним после регистрации
        Auth::login($user);

        return redirect()->route('cabinet.index');
    }

    /**
     * Показать форму логина
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Обработка логина
     * Автоматически валидирует через LoginRequest
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Вызываем кастомный метод authenticate() из LoginRequest
        $request->authenticate();

        // Регенерация сессии — защита от Session Fixation
        $request->session()->regenerate();

        // intended() — редиректит туда, куда пользователь пытался попасть до логина
        return redirect()->intended(route('cabinet.index'));
    }

    /**
     * Выход из системы
     */
    public function logout(LoginRequest $request): RedirectResponse
    {
        Auth::logout();

        // Инвалидируем сессию
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}