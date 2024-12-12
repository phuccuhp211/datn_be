<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\SisuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AnimalController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\SponsorController;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('sponsors', SponsorController::class);

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

Route::prefix('auth')->group(function () {
    Route::prefix('client')->group(function () {
        Route::post('/login', [SisuController::class, 'clientLogin']);
        Route::post('/logout', [SisuController::class, 'clientLogout']);
        Route::post('/register', [SisuController::class, 'clientRegister']);
        Route::post('/config', [SisuController::class, 'clientConfig']);
        Route::put('/changePassword', [SisuController::class, 'clientChangePassword']);
        Route::post('/forgotPassword', [SisuController::class, 'clientForgotPassword']);
        Route::post('/resetPassword', [SisuController::class, 'clientResetPassword'])->name('password.reset');
        Route::post('/check-unique', [SisuController::class, 'checkUnique']);
    });
    Route::prefix('admin')->group(function () {
        Route::post('/login', [SisuController::class, 'adminLogin']);
        Route::post('/logout', [SisuController::class, 'adminLogout']);
    });
});

Route::prefix('cart')->group(function () {
    Route::post('/get', [CartController::class, 'getCart']);
    Route::post('/delete', [CartController::class, 'delete']);
    Route::post('/deleteAll', [CartController::class, 'deleteAllCart']);
    Route::post('/insertOrUpdate', [CartController::class, 'insertOrUpdate']);
});

Route::prefix('admin')->group(function () {
    Route::post('/animals/{action}/', [CrudController::class, 'animalManager']);
    Route::post('/animalCatalog/{action}/', [CrudController::class, 'animalCatalogManager']);
    Route::post('/formRequest/{action}/', [CrudController::class, 'formRequestManager']);
    Route::post('/invoices/{action}/', [CrudController::class, 'invoiceManager']);
    Route::post('/products/{action}/', [CrudController::class, 'productManager']);
    Route::post('/productCatalog/{action}/', [CrudController::class, 'productCatalogManager']);
    Route::post('/sponsors/{action}/', [CrudController::class, 'sponsorManager']);
    Route::post('/stories/{action}/', [CrudController::class, 'storyManager']);
    Route::post('/storyCatalog/{action}/', [CrudController::class, 'storyCatalogManager']);
    Route::post('/users/{action}/', [CrudController::class, 'userManager']);
    // get data
    Route::get('animals/', [ApiController::class, 'showAnimal']);
    Route::get('users/', [ApiController::class, 'showUsers']);
    Route::get('product/', [ApiController::class, 'showProduct']);
    Route::get('animals/', [ApiController::class, 'showAnimal']);
    Route::get('users/', [ApiController::class, 'showUsers']);
    Route::get('stories/', [ApiController::class, 'showStories']);
    Route::get('sponsors/', [ApiController::class, 'showSponsor']);
    Route::get('storyCatalog/', [ApiController::class, 'showStoryCatalog']);
    Route::get('animalCatalog/', [ApiController::class, 'showAnimalcatalog']);
    Route::get('productCatalog/', [ApiController::class, 'showProductCatalog']);
});