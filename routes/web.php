<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReturnedController;
use App\Http\Controllers\RentalController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk login (GET)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk proses login (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Rute untuk logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Rute untuk Admin Dashboard
    Route::get('/admin/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            // Admin Dashboard
            return view('cars.index');
        }
        return redirect('/user/dashboard');
    })->name('admin.dashboard');

    // Rute untuk User Dashboard
    Route::get('/user/dashboard', function () {
        if (Auth::user()->role === 'user') {
            // User Dashboard
            return view('user.dashboard');
        }
        return redirect('/admin/dashboard');
    })->name('user.dashboard');
});
// Category Routes
Route::prefix('/category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

// Cars Routes
Route::prefix('/cars')->name('cars.')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/', [CarController::class, 'store'])->name('store');
    Route::get('/{id}', [CarController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [CarController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CarController::class, 'update'])->name('update');
    Route::delete('/{id}', [CarController::class, 'destroy'])->name('destroy');
    Route::patch('/confirm/{id}', [CarController::class, 'confirm'])->name('confirm');
    Route::patch('/reject/{id}', [CarController::class, 'reject'])->name('reject');
});

// Returned Routes
Route::prefix('/returned')->name('returned.')->group(function () {
    Route::get('/', [ReturnedController::class, 'index'])->name('index');
    Route::get('/create', [ReturnedController::class, 'create'])->name('create');
    Route::post('/', [ReturnedController::class, 'store'])->name('store');
});

// Rent Routes
Route::prefix('/rent')->name('rent.')->group(function () {
    Route::get('/', [RentalController::class, 'index'])->name('index');
    Route::get('/create', [RentalController::class, 'create'])->name('create');
    Route::post('/', [RentalController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RentalController::class, 'edit'])->name('edit');
    Route::put('/{id}', [RentalController::class, 'update'])->name('update');
    Route::delete('/{id}', [RentalController::class, 'destroy'])->name('destroy');
});
