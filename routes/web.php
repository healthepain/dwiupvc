<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProductProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('project', ProjectController::class);
    // Product dalam Project
    Route::get('/project-products', [ProductProjectController::class, 'products'])
        ->name('product-project.products');

    Route::post('/project/{project}/products', [ProductProjectController::class, 'store'])
        ->name('product-project.store');

    Route::delete('/product-project/{productProject}', [ProductProjectController::class, 'destroy'])
        ->name('product-project.destroy');
});

require __DIR__ . '/auth.php';
