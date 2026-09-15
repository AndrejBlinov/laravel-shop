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

            <div class="city-selector">
                <form method="POST" action="{{ route('city.store') }}" class="d-inline">
                    @csrf
                    <select name="city_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Выберите город --</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" 
                                {{ $currentCity && $currentCity->id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                
                @if($currentCity)
                    <small class="text-muted ms-2">
                        Выбран: <strong>{{ $currentCity->name }}</strong>
                    </small>
                @endif
            </div>

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
                @auth
                    {{-- Если пользователь авторизован --}}
                    <a href="{{ route('cabinet.index') }}"
                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark text-decoration-none p-0" title="Выход">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </button>
                    </form>
                    
                @else
                    {{-- Если гость --}}
                    <a href="{{ route('login') }}" class="text-dark text-decoration-none">
                        <i class="bi bi-person fs-5"></i>
                        <span class="d-none d-md-inline">Войти</span>
                    </a>
                @endauth

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
