<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\IndexingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [IndexingController::class, 'index'])->name('index');

// Route shop 
Route::get('/shop', [ShopController::class, 'viewShop'])->name('viewShop');
Route::get('/shop-category/{category_id}', [ShopController::class, 'viewShopCategory'])->name('shop.category');
Route::get('/shop-single/{product_id}', [ShopController::class, 'shopSingle'])->name('shop.single');

//Checkout 
Route::post('/check-out', [OrderController::class, 'checkOut'])->name('checkout');

// Route product
Route::get('/detail-product', [ProductController::class, 'show'])->name('DetailProduct');

//Cart
Route::prefix('cart')->middleware('isLogin')->group(function () {
    Route::get('/', [CartController::class, 'viewCart'])->name('cart.index');
    Route::get('/add-product/{product_id}', [CartController::class, 'addToCart'])->name('cart.store');
    Route::get('/delete-item/{item_id}', [CartController::class , 'deleteCartItem'])->name('cart.delete');
});


//route Admin
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('', [AuthController::class, 'viewAdmin'])->name('viewAdmin');
    #Order
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('orders/{order_id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('orders/detai/{order_id}', [OrderController::class, 'orderDetail'])->name('orders.detail');
    Route::get('orders/approve-status/{order_id}', [OrderController::class, 'approveOrder'])->name('orders.approve');
    #User
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('user/profile', [UserController::class, 'profile'])->name('users.profile');

    #Category
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('edit/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('update/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    #Brand
    Route::get('brands', [BrandController::class , 'index'])->name('brands.index');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::delete('brand/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::get('edit/brand/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('update/brand/{id}', [BrandController::class, 'update'])->name('brands.update');

    #Product
    Route::get('products', [ProductController::class , 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('edit/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('update/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('delete/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('delete/product-image/{pro_image_id}', [ProductController::class, 'delete_prouct_image'])->name('products.delete.image');
});

//route 
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'customLogin'])->name('auth.login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('store/user', [AuthController::class, 'customRegister'])->name('auth.register');
Route::post('logout', [AuthController::class , 'logout'])->name('logout');
Route::post('/change-password', [UserController::class, 'changePassword'])->name('update-password');