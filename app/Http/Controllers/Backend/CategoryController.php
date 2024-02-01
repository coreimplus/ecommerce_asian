<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->only(['name']));

        if ($request->has('image')) {
            $image = Storage::put('public/categories', $request->file('image'));
            $imageURL = config('app.url') . Storage::url($image);
            $category->update(['image' => $imageURL]);
        }

        return redirect()->route('admin.category.index')
            ->with('success', 'You have successfully created a new category.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['name']));

        if ($request->has('image')) {
            Storage::delete('public/categories/' . basename($category->image));
            $image = Storage::put('public/categories', $request->file('image'));
            $imageURL = config('app.url') . Storage::url($image);
            $category->update(['image' => $imageURL]);
        }

        return redirect()->route('admin.category.index')
            ->with('success', 'You have successfully updated ' . $category->name . '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/categories/' . basename($category->image));
        $category->delete();
        return redirect()->route('admin.category.index')
            ->with('success', 'You have successfully deleted a category.');
    }
}
