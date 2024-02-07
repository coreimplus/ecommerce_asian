<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('sizes')
            ->when($request->size, function ($query) use ($request) {
                $query->whereHas('sizes', function ($query) use ($request) {
                    $query->whereIn('sizes.id', $request->size);
                });
            })->get();
        $sizes = Size::all();
        return view('frontend.product.index', compact('products', 'sizes'));
    }

    public function details(Product $product)
    {
        $relatedProducts = Product::inRandomOrder()->limit(5)->get();
        return view('frontend.product.details', compact('product', 'relatedProducts'));
    }
}
