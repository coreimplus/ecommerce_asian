<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{

    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::where('featured', true)->get();
        return view('frontend.index', compact('categories', 'featuredProducts'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
