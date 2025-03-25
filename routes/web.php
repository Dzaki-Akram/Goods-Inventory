<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman utama diarahkan ke halaman login sementara
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Routes untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group middleware 'auth' untuk membatasi akses setelah login
Route::middleware('auth')->group(function () {
    // Route untuk Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Employees (hanya bisa diakses setelah login)
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    // Routes untuk Products (hanya bisa diakses setelah login)
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');  
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');  
        Route::post('/', [ProductController::class, 'store'])->name('products.store');  
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');  
        Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');  
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');  
    });
});
