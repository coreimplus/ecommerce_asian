<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.product.index', compact('products'));
    }

    public function details(Product $product)
    {
        $relatedProducts = Product::inRandomOrder()->limit(5)->get();
        return view('frontend.product.details', compact('product', 'relatedProducts'));
    }
}
