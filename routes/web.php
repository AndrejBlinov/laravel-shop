<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/delivery', function () {
    return view('delivery.index');
});

Route::get('/contacts', function () {
    return view('contacts.index');
});

// Каталог
// Список
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Детальная страница 

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Авторизация 
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Защищённые маршруты (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

