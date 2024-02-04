<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

// Route shop 
Route::get('/shop', [ShopController::class, 'viewShop'])->name('viewShop');
Route::get('/shop-category', [ShopController::class, 'viewShopCategory'])->name('viewShopCategory');

// Route product
Route::get('/detail-product', [ProductController::class, 'show'])->name('DetailProduct');