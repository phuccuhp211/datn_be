<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCatalogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/product/product-catalogs', [ProductCatalogController::class, 'index']);
Route::get('/product-catalogs/{id}', [ProductCatalogController::class, 'show']);