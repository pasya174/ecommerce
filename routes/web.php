<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LaporanContoller;
use App\Http\Controllers\Admin\PerbandinganController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\CataloguesController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\LeaderboardController;
use App\Http\Controllers\Main\OrderController;
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
// cek

Route::redirect('/iki', 'admin/product');
Route::redirect('login', 'auth/login');

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('catalogue', [CataloguesController::class, 'index'])->name('catalogue');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('cart-store', [TransactionController::class, 'cart_store'])->name('cart.store');
Route::post('add-cart', [TransactionController::class, 'add_cart'])->name('add-cart');
Route::get('add-quantity/{id}/{status}', [TransactionController::class, 'add_quantity'])->name('add-quantity');
Route::get('delete-detail/{id}', [HomeController::class, 'delete_detail_transaction'])->name('delete-detail');
Route::get('leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', [LoginController::class, 'index'])->name('auth.login.index');
    Route::post('post-login', [LoginController::class, 'post_login'])->name('auth.login.post-login');
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.login.logout');
});

Route::group([
    'prefix' => 'checkout',
    'middleware' => ['auth'],
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
    'prefix' => 'orders'
], function () {
    Route::get('', [OrderController::class, 'index'])->name('order.index');
    Route::post('give-review', [OrderController::class, 'give_review'])->name('order.review');
    Route::post('re-order', [OrderController::class, 're_order'])->name('order.reorder');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
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
        'prefix' => 'transaction',
    ], function () {
        Route::get('', [AdminTransactionController::class, 'index'])->name('transaction.index');
        Route::post('is-accept', [AdminTransactionController::class, 'isAccept'])->name('transaction.is-accept');
        Route::post('is-reject', [AdminTransactionController::class, 'isReject'])->name('transaction.is-reject');
    });

    Route::group([
        'prefix' => 'laporan',
    ], function () {
        Route::get('', [LaporanContoller::class, 'index'])->name('laporan.index');
        Route::get('detail/{user_id}', [LaporanContoller::class, 'detail'])->name('laporan.detail');
        Route::get('print/{id}', [LaporanContoller::class, 'print'])->name('laporan.print');
    });

    Route::group([
        'prefix' => "history",
    ], function () {
        Route::get('', [HistoryController::class, 'index'])->name('history.index');
        Route::get('{user_id}', [HistoryController::class, 'detail'])->name('history.detail');
    });

    Route::group([
        'prefix' => 'header'
    ], function () {
        Route::get('', [HeaderController::class, 'index'])->name('header.index');
        Route::post('', [HeaderController::class, 'store'])->name('header.store');
        Route::post('update', [HeaderController::class, 'update'])->name('header.update');
        Route::post('delete', [HeaderController::class, 'delete'])->name('header.delete');
    });

    Route::group([
        'prefix' => 'perbandingan'
    ], function () {
        Route::get('', [PerbandinganController::class, 'index'])->name('perbandingan.index');
    });

    Route::group([
        'prefix' => 'revenue',
    ], function () {
        Route::get('', [RevenueController::class, 'index'])->name('revenue.index');
    });
});


Route::group([
    'prefix' => 'data'
], function () {
    Route::get('province', [CheckoutController::class, 'province'])->name('province');
    Route::get('city/{id}', [CheckoutController::class, 'city'])->name('city');
    Route::get('district/{id}', [CheckoutController::class, 'district'])->name('district');
    Route::get('village/{id}', [CheckoutController::class, 'village'])->name('village');
});
