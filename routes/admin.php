<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;

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
});