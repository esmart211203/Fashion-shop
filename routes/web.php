<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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




//route Admin
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('', [AuthController::class, 'viewAdmin'])->name('viewAdmin');
    #User
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
});

//route
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'customLogin'])->name('custom.login');