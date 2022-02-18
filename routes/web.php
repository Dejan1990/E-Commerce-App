<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/admin', 'admin.dashboard.index')->name('admin.dashboard')->middleware(['admin']);
Route::view('/login', 'auth.login')->middleware(['guest']);
Route::view('/register', 'auth.register')->middleware(['guest']);

Route::get('/admin/settings', [SettingController::class, 'index'])->name('settings.index');
