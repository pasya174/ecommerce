<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Main\HomeController;
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

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('catalogue', [HomeController::class, 'catalogues'])->name('catalogue');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');


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
});
