<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//route dengan mode resources
Route::resource('/products', ProductController::class);
Route::resource('/category', CategoryController::class);

Route::get('/', function () {
    return view('home');
})->name('home');

// Admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
