<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // список
    public function index()
    {
        $cityId = session('city_id');

        $products = Product::query()
            ->when($cityId, function ($query, $cityId) {
                // Если город выбран — показываем товары, у которых есть остаток на складах этого города
                $query->whereHas('warehouses', function ($q) use ($cityId) {
                    $q->where('city_id', $cityId)
                        ->where('product_warehouse.quantity', '>', 0);
                });
            }, function ($query) {
                // Если город НЕ выбран — показываем товары с остатком > 0 на любом складе
                $query->whereHas('warehouses', function ($q) {
                    $q->where('product_warehouse.quantity', '>', 0);
                });
            })
            ->with(['warehouses.city']) // подгружаем склады и их города
            ->get();

        return view('products.index', compact('products'));
    }

    // Детальная страница товара
    public function show(Product $product)
    {
        // Route Model Binding автоматически найдет товар по ID
        // Если товар не найден — вернет 404

        $cityId = session('city_id');

        // Загружаем все склады с остатками, сгруппированные по городам
        $product->load(['warehouses.city']);

        return view('products.show', compact('product', 'cityId'));
    }
}
