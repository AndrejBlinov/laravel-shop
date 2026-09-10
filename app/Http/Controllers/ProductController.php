<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // список
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('products.index', compact('products'));
    }

    // Детальная страница товара
    public function show(Product $product)
    {
        // Route Model Binding автоматически найдет товар по ID
        // Если товар не найден — вернет 404
        
        return view('products.show', compact('product'));
    }
}
