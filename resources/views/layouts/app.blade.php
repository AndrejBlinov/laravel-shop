<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>

    <!-- Подключаем CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite([
        'resources/css/app.css',
        'resources/css/header.css',
        'resources/css/footer.css'
    ])
    <!-- Дополнительные стили для конкретной страницы -->
    @stack('styles')

</head>

<body>
    <!-- Шапка -->
    @include('partials.header')

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Основной контент -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Подвал -->
    @include('partials.footer')

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Дополнительные скрипты для конкретной страницы -->
    @stack('scripts')
</body>

</html>