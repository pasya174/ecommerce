<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\CataloguesController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\LeaderboardController;
use App\Http\Controllers\TransactionController;
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

Route::redirect('/iki', 'admin/product');

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('catalogue', [CataloguesController::class, 'index'])->name('catalogue');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('cart-store', [TransactionController::class, 'cart_store'])->name('cart.store');
Route::post('add-cart', [TransactionController::class, 'add_cart'])->name('add-cart');
Route::get('add-quantity/{id}/{status}', [TransactionController::class, 'add_quantity'])->name('add-quantity');
Route::get('delete-detail/{id}', [HomeController::class, 'delete_detail_transaction'])->name('delete-detail');
Route::get('leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::group([
    'prefix' => 'checkout'
], function () {
    Route::get('', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('post-login-user', [AuthController::class, 'post_login_user'])->name('post-login.user');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::group([
        'prefix' => 'product',
    ], function () {
        Route::get('', [ProductsController::class, 'index'])->name('product.index');
        Route::post('', [ProductsController::class, 'store'])->name('product.store');
        Route::post('update', [ProductsController::class, 'update'])->name('product.update');
        Route::post('add-detail', [ProductsController::class, 'add_detail'])->name('product.add-detail');
        Route::post('delete', [ProductsController::class, 'delete'])->name('product.delete');
        Route::post('delete-detail', [ProductsController::class, 'delete_detail'])->name('product-detail.delete');
    });

    Route::group([
        'prefix' => 'categories'
    ], function () {
        Route::get('', [CategoriesController::class, 'index'])->name('category.index');
        Route::post('', [CategoriesController::class, 'store'])->name('category.store');
        Route::post('update', [CategoriesController::class, 'update'])->name('category.update');
        Route::post('delete', [CategoriesController::class, 'delete'])->name('category.delete');
    });

    Route::group([
        'prefix' => 'header'
    ], function () {
        Route::get('', [HeaderController::class, 'index'])->name('header.index');
        Route::post('', [HeaderController::class, 'store'])->name('header.store');
        Route::post('update', [HeaderController::class, 'update'])->name('header.update');
        Route::post('delete', [HeaderController::class, 'delete'])->name('header.delete');
    });
});


Route::group([
    'prefix' => 'data'
], function () {
    Route::get('city/{id}', [CheckoutController::class, 'city']);
    Route::get('district/{id}', [CheckoutController::class, 'district']);
    Route::get('village/{id}', [CheckoutController::class, 'village']);
});
