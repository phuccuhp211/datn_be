<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AnimalController;

// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); // Get all products
    Route::get('/detail/{id}', [ProductController::class, 'show']); // Get product details by ID
    Route::post('/', [ProductController::class, 'store']); // Create a new product
    Route::put('{id}', [ProductController::class, 'update']); // Update product information by ID
    Route::delete('{id}', [ProductController::class, 'destroy']); // Delete product by ID

    Route::get('/filter', [ProductController::class, 'filterProducts']); // Filter products based on specified conditions
    Route::get('/filter/{id}', [ProductController::class, 'productsByCatalog']); // Filter products by catalog ID
});

// Animal routes
Route::prefix('animals')->group(function () {
    Route::get('/', [AnimalController::class, 'index']); // Get all animals
    Route::get('{id}', [AnimalController::class, 'show']); // Get animal details by ID
    Route::post('/', [AnimalController::class, 'store']); // Create a new animal
    Route::put('{id}', [AnimalController::class, 'update']); // Update animal information by ID
    Route::delete('{id}', [AnimalController::class, 'destroy']); // Delete animal by ID
});