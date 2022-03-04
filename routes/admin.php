<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;

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
});