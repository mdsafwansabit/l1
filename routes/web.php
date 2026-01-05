<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Root to products
Route::get('/', [ProductController::class, 'index']);

// Storefront
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Simple admin (protected by basic auth)
Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
	Route::get('products', [AdminProductController::class, 'index'])->name('products.index');
	Route::get('products/create', [AdminProductController::class, 'create'])->name('products.create');
	Route::post('products', [AdminProductController::class, 'store'])->name('products.store');

	Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
	Route::put('products/{product}', [AdminProductController::class, 'update'])->name('products.update');
	Route::delete('products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

	Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
	Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
});
