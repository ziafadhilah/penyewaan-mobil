<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Category
Route::prefix('/category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
});

// Cars
Route::prefix('/cars')->name('cars.')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/', [CarController::class, 'store'])->name('store');
});
