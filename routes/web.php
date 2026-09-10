<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

