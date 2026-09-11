@extends('layouts.app')

@section('title', 'Личный кабинет')

@vite(['resources/css/auth/cabinet.css'])

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4">Добро пожаловать, {{ $user->name }}! 👋</h2>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <small class="text-muted">Email</small>
                            <div class="fw-bold">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <small class="text-muted">Дата регистрации</small>
                            <div class="fw-bold">{{ $user->created_at->format('d.m.Y') }}</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5>Мои возможности</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">🛒 <a href="{{ route('products.index') }}">Смотреть каталог</a></li>
                    <li class="mb-2">❤️ Избранные товары (скоро)</li>
                    <li class="mb-2">📦 Мои заказы (скоро)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection