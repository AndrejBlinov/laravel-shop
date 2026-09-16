@extends('layouts.app')

@section('title', 'Продукты')

@vite(['resources/css/products.css'])

@section('content')
    <h1>🛒 Каталог товаров</h1>

    @if (count($products) > 0)
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', $product['id']) }}" class="text-decoration-none text-dark">
                                {{ $product['name'] }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit($product['description'], 200) }}</p>
                        <p class="product-price">{{ number_format($product['price'], 0, '.', ' ') }} руб.</p>
                        <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary btn-sm">
                            Подробнее
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-products">
            Товары не найдены
        </div>
    @endif
@endsection
