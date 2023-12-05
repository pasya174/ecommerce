<?php

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

Route::get('', function () {
    return view('website.pages.index');
})->name('home');

Route::get('catalogue', function () {
    return view('website.pages.catalogues');
})->name('catalogue');

Route::get('cart', function () {
    return view('website.pages.cart');
})->name('cart');

Route::get('checkout', function () {
    return view('website.pages.checkout');
})->name('checkout');


Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('', function () {
        return view('administator.pages.index');
    });
});
