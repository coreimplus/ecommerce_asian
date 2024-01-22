<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::get('/product/details', [ProductController::class, 'details'])->name('products.details');
