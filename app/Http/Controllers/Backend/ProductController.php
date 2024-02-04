<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only(['category_id', 'name', 'price', 'short_description', 'description', 'information', 'sizes', 'colors', 'available_quantity']));

        if ($request->has('image_one')) {
            $imageOne = Storage::put('public/products', $request->file('image_one'));
            $imageOneURL = config('app.url') . Storage::url($imageOne);
            $product->update(['image_one' => $imageOneURL]);
        }

        if ($request->has('image_two')) {
            $imageTwo = Storage::put('public/products', $request->file('image_two'));
            $imageTwoURL = config('app.url') . Storage::url($imageTwo);
            $product->update(['image_two' => $imageTwoURL]);
        }

        if ($request->has('image_three')) {
            $imageThree = Storage::put('public/products', $request->file('image_three'));
            $imageThreeURL = config('app.url') . Storage::url($imageThree);
            $product->update(['image_three' => $imageThreeURL]);
        }

        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('backend.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->only(['name', 'price', 'short_description', 'description', 'information', 'sizes', 'colors', 'available_quantity']));

        if ($request->has('image_one')) {
            Storage::delete('public/products/' . basename($product->image_one));
            $imageOne = Storage::put('public/products', $request->file('image_one'));
            $imageOneURL = config('app.url') . Storage::url($imageOne);
            $product->update(['image_one' => $imageOneURL]);
        }

        if ($request->has('image_two')) {
            Storage::delete('public/products/' . basename($product->image_two));
            $imageTwo = Storage::put('public/products', $request->file('image_two'));
            $imageTwoURL = config('app.url') . Storage::url($imageTwo);
            $product->update(['image_two' => $imageTwoURL]);
        }

        if ($request->has('image_three')) {
            Storage::delete('public/products/' . basename($product->image_three));
            $imageThree = Storage::put('public/products', $request->file('image_three'));
            $imageThreeURL = config('app.url') . Storage::url($imageThree);
            $product->update(['image_three' => $imageThreeURL]);
        }

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete('public/products/' . basename($product->image_one));
        Storage::delete('public/products/' . basename($product->image_two));
        Storage::delete('public/products/' . basename($product->image_three));
        $product->delete();
        return redirect()->route('admin.products');
    }
}
