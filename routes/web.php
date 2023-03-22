<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::post('/cart/add', [CartController::class, 'addProductToCart'])->name('cart.add');

Route::delete('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/carts/index', [CartController::class, 'index'])->name('cart.index');

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');

Route::get('/store', [ProductController::class, 'storeView'])->name('store');

Route::post('products/{product}', [ProductController::class, 'update'])->name('products.update');
