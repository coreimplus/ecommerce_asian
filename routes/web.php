<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}/details', [ProductController::class, 'details'])->name('products.details');


//---------------------------------------- User Routes ----------------------------------------//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
//---------------------------------------- User Routes ----------------------------------------//


//---------------------------------------- Admin Routes ----------------------------------------//
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/products', [BackendProductController::class, 'index'])->name('admin.products');
Route::get('/admin/products/create', [BackendProductController::class, 'create'])->name('admin.products.create');
Route::get('/admin/products/{product}/edit', [BackendProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/admin/products/{product}/update', [BackendProductController::class, 'update'])->name('admin.products.update');
Route::post('/admin/products/store', [BackendProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/destroy', [BackendProductController::class, 'destroy'])->name('admin.products.destroy');

Route::group(['prefix' => 'admin/', 'as' => 'admin.'], function () {
    Route::resource('category', CategoryController::class);
});
//---------------------------------------- Admin Routes ----------------------------------------//
