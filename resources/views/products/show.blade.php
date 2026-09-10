@extends('layouts.app')

@section('title', $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product-show.css') }}">
@endpush

@section('content')
    {{-- Хлебные крошки --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Каталог</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="product-detail">
        <div class="row">
            {{-- Левая колонка: изображение --}}
            <div class="col-lg-6 mb-4">
                <div class="product-gallery">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded shadow-sm">
                    @else
                        <div class="product-placeholder bg-light rounded d-flex align-items-center justify-content-center">
                            <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Правая колонка: информация --}}
            <div class="col-lg-6">
                <h1 class="product-title mb-3">{{ $product->name }}</h1>
                
                {{-- Артикул --}}
                @if($product->sku)
                    <p class="text-muted small mb-3">
                        <i class="bi bi-upc-scan"></i> Артикул: {{ $product->sku }}
                    </p>
                @endif

                {{-- Цена --}}
                <div class="product-price-block mb-4">
                    @if($product->old_price && $product->old_price > $product->price)
                        <span class="old-price text-muted text-decoration-line-through me-2">
                            {{ number_format($product->old_price, 0, '.', ' ') }} ₽
                        </span>
                    @endif
                    <span class="current-price fs-2 fw-bold text-primary">
                        {{ number_format($product->price, 0, '.', ' ') }} ₽
                    </span>
                </div>

                {{-- Краткое описание --}}
                @if($product->short_description)
                    <div class="product-short-desc mb-4">
                        <p class="text-muted">{{ $product->short_description }}</p>
                    </div>
                @endif

                {{-- Кнопки действий --}}
                <div class="product-actions d-flex gap-2 mb-4">
                    <button class="btn btn-primary btn-lg flex-grow-1" id="addToCartBtn">
                        <i class="bi bi-cart-plus"></i> В корзину
                    </button>
                    <button class="btn btn-outline-secondary btn-lg" title="В избранное">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>

                {{-- Характеристики (если есть) --}}
                @if($product->features)
                    <div class="product-features mb-4">
                        <h5 class="mb-3">Особенности</h5>
                        <ul class="list-unstyled">
                            @foreach(explode("\n", $product->features) as $feature)
                                @if(trim($feature))
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        {{ trim($feature) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Наличие --}}
                <div class="product-stock mb-3">
                    @if($product->in_stock)
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> В наличии
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            <i class="bi bi-x-circle"></i> Нет в наличии
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Полное описание (под основным блоком) --}}
        @if($product->description)
            <div class="product-full-desc mt-5">
                <h4 class="mb-3">Описание</h4>
                <div class="bg-light p-4 rounded">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        @endif
    </div>
@endsection