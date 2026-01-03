<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

//route dengan mode resources
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/category', CategoryController::class);
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');
Route::put('/checkout/{order}/bukti-pembayaran', [CheckoutController::class,'updatePaymentProof'])->name('checkout.updatePaymentProof');

Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

require __DIR__ . '/auth.php';