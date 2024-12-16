<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Redirect root URL to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Article routes
Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class);
});

// Category routes
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
});

// Tag routes
Route::middleware('auth')->group(function () {
    Route::resource('tags', TagController::class);
});

// Authentication routes
require __DIR__.'/auth.php';
