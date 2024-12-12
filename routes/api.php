<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BasicController;
use App\Http\Controllers\SisuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AnimalController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\SponsorController;

use App\Http\Middleware\isAdminLoging;
use App\Http\Middleware\isClientLoging;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('sponsors', SponsorController::class);

// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/detail/{id}', [ProductController::class, 'show']);
    Route::get('/filter', [ProductController::class, 'filterProducts']);
    Route::get('/filter/{id}', [ProductController::class, 'productsByCatalog']);
});

// Animal routes
Route::prefix('animals')->group(function () {
    Route::get('/', [AnimalController::class, 'index']);
    Route::get('{id}', [AnimalController::class, 'show']);
});

Route::prefix('auth')->group(function () {
    Route::prefix('client')->group(function () {
        Route::post('/login', [SisuController::class, 'clientLogin']);
        Route::post('/logout', [SisuController::class, 'clientLogout']);
        Route::post('/register', [SisuController::class, 'clientRegister']);
        Route::post('/config', [SisuController::class, 'clientConfig'])->middleware(isClientLoging::class);;
        Route::post('/changePassword', [SisuController::class, 'clientChangePassword'])->middleware(isClientLoging::class);;
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

Route::prefix('admin')->middleware(isAdminLoging::class)->group(function () {
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
    Route::get('animals/', [BasicController::class, 'showAnimal']);
    Route::get('users/', [BasicController::class, 'showUsers']);
    Route::get('product/', [BasicController::class, 'showProduct']);
    Route::get('animals/', [BasicController::class, 'showAnimal']);
    Route::get('users/', [BasicController::class, 'showUsers']);
    Route::get('stories/', [BasicController::class, 'showStories']);
    Route::get('sponsors/', [BasicController::class, 'showSponsor']);
    Route::get('storyCatalog/', [BasicController::class, 'showStoryCatalog']);
    Route::get('animalCatalog/', [BasicController::class, 'showAnimalcatalog']);
    Route::get('productCatalog/', [BasicController::class, 'showProductCatalog']);
});