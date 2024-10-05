<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\ProductController;

Route::apiResource('products', ProductController::class);

Route::get('/product-catalogs', [ProductCatalogController::class, 'index']);
Route::get('/product-catalogs/{id}', [ProductCatalogController::class, 'show']);



use App\Http\Controllers\AnimalController;

Route::apiResource('animals', AnimalController::class);