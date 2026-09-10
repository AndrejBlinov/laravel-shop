{{-- Промо-полоска сверху (опционально) --}}
<div class="top-bar bg-dark text-white text-center py-2 small">
    <i class="bi bi-truck"></i> Бесплатная доставка от 3000 ₽ | 
    <i class="bi bi-telephone"></i> +7 (999) 123-45-67
</div>

{{-- Основная шапка --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        {{-- Логотип --}}
        <a class="navbar-brand fw-bold fs-3 text-primary" href="/">
            <i class="bi bi-shop"></i> Мой Магазин
        </a>

        {{-- Кнопка мобильного меню (бургер) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Основное меню --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            {{-- Навигация слева --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold' : '' }}" href="/">
                        Главная
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active fw-bold' : '' }}" 
                       href="{{ route('products.index') }}">
                        Каталог
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active fw-bold' : '' }}" href="/about/">
                        О нас
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('delivery') ? 'active fw-bold' : '' }}" href="/delivery/">
                        Доставка
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contacts') ? 'active fw-bold' : '' }}" href="/contacts/">
                        Контакты
                    </a>
                </li>
            </ul>

            {{-- Поиск --}}
            <form class="d-flex me-3" role="search" action="{{ route('products.index') }}" method="GET">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Поиск товаров..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Иконки справа --}}
            <div class="d-flex align-items-center gap-3">
                {{-- Личный кабинет --}}
                <a href="/account" class="text-dark text-decoration-none" title="Личный кабинет">
                    <i class="bi bi-person fs-5"></i>
                </a>
                
                {{-- Избранное --}}
                <a href="/favorites" class="text-dark text-decoration-none" title="Избранное">
                    <i class="bi bi-heart fs-5"></i>
                </a>
                
                {{-- Корзина --}}
                <a href="/cart" class="text-dark text-decoration-none position-relative" title="Корзина">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                          id="cart-count" style="font-size: 0.65rem;">
                        0
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>