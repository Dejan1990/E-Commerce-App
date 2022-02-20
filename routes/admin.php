<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::view('/', 'admin.dashboard.index')->name('admin.dashboard');

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('admin.settings.index');
        Route::post('/settings', 'update')->name('admin.settings.update');
    });
});