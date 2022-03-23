<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::view('/', 'admin.dashboard.index')->name('admin.dashboard');

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('admin.settings.index');
        Route::post('/settings', 'update')->name('admin.settings.update');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('admin.categories.index');
        Route::get('/categories/create', 'create')->name('admin.categories.create');
        Route::post('/categories/store', 'store')->name('admin.categories.store');
        Route::get('/categories/{category:slug}/edit', 'edit')->name('admin.categories.edit');
        Route::put('/categories/{category}/update', 'update')->name('admin.categories.update');
        Route::delete('/categories/{category}/delete', 'destroy')->name('admin.categories.delete');
    });

    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attributes', 'index')->name('admin.attributes.index');
        Route::get('/attributes/create', 'create')->name('admin.attributes.create');
        Route::post('/attributes/create', 'store')->name('admin.attributes.store');
        Route::get('/attributes/{attribute:slug}/edit', 'edit')->name('admin.attributes.edit');
        Route::put('/attributes/{attribute}/update', 'update')->name('admin.attributes.update');
        Route::delete('/attributes/{attribute}/delete', 'destroy')->name('admin.attributes.delete');
    });

    Route::controller(AttributeValueController::class)->group(function () {
        Route::get('/attributes/{attribute}/get-values', 'getValues')->name('admin.attributesValues.index');
        Route::post('/attributes/{attribute}/add-value', 'addValue')->name('admin.attributesValues.store');
        Route::put('/attributes/{attribute}/update-value', 'updateValue')->name('admin.attributesValues.update');
        Route::post('/attributes/{attribute}/delete-value', 'deleteValue')->name('admin.attributesValues.delete');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index')->name('admin.brands.index');
        Route::get('/brands/create', 'create')->name('admin.brands.create');
        Route::post('/brands/create', 'store')->name('admin.brands.store');
        Route::get('/brands/{brand:slug}/edit', 'edit')->name('admin.brands.edit');
        Route::put('/brands/{brand}/update', 'update')->name('admin.brands.update');
        Route::delete('/brands/{brand}/delete', 'destroy')->name('admin.brands.delete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products.index');
        Route::get('/products/create', 'create')->name('admin.products.create');
        Route::post('/products/create', 'store')->name('admin.products.store');
        Route::get('/products/{product:slug}/edit', 'edit')->name('admin.products.edit');
        Route::put('/products/{product}/update', 'update')->name('admin.products.update');
        Route::delete('/products/{product}/delete', 'destroy')->name('admin.products.delete');
    });

    Route::controller(ProductImageController::class)->group(function () {
        Route::post('/products/images/upload', 'upload')->name('admin.products.images.upload');
        Route::get('/products/images/{id}/delete', 'delete')->name('admin.products.images.delete');
    });

    Route::controller(ProductAttributeController::class)->group(function () {
        // Load attributes on the page load
        Route::get('/products/attributes/load', 'loadAttributes');
        // Load product attributes on the page load
        Route::post('/products/attributes', 'productAttributes');
        // Load option values for a attribute
        Route::post('/products/attribute/values', 'loadAttributeValues');
        // Add product attribute to the current product
        Route::post('/products/attribute/addProductAttribute', 'addProductAttribute');
        // Delete product attribute from the current product
        Route::post('/products/attribute/deleteProductAttribute', 'deleteProductAttribute');
    });
});