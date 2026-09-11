@extends('layouts.app')

@section('title', 'Регистрация')

@vite(['resources/css/auth/cabinet.css'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Регистрация</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Имя --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Пароль --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Минимум 8 символов</div>
                    </div>

                    {{-- Подтверждение пароля --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Зарегистрироваться
                    </button>
                </form>

                <div class="text-center mt-3">
                    Уже есть аккаунт? 
                    <a href="{{ route('login') }}">Войти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection