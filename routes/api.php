<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::middleware('api')->group(function(){
    Route::get('employees',[EmployeeController::class, 'index']);
    Route::post('employees',[EmployeeController::class, 'store']);
    Route::put('employees/{id}',[EmployeeController::class, 'update']);
    Route::delete('employees/{id}',[EmployeeController::class, 'destroy']);
});

Route::middleware('api')->group(function(){
    Route::get('products',[ProductController::class, 'index']);
    Route::post('products',[ProductController::class, 'store']);
    Route::put('products/{id}',[ProductController::class, 'update']);
    Route::delete('products/{id}',[ProductController::class, 'destroy']);
});