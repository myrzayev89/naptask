<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('/addCart/{id}', [\App\Http\Controllers\IndexController::class, 'addToCart'])->name('add');

Route::group(['namespace' => 'cart', 'prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('update', [\App\Http\Controllers\CartController::class, 'update'])->name('update');
    Route::delete('delete', [\App\Http\Controllers\CartController::class, 'delete'])->name('delete');
    Route::post('checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
});

Route::group(['namespace' => 'order', 'prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/', [\App\Http\Controllers\Order\IndexController::class, 'index'])->name('index');
    Route::get('/items/{id}', [\App\Http\Controllers\Order\IndexController::class, 'items'])->name('items');
    Route::post('check', [\App\Http\Controllers\Order\IndexController::class, 'check'])->name('check');
});

