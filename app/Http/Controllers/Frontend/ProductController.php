<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.product.index');
    }

    public function details()
    {
        return view('frontend.product.details');
    }
}
