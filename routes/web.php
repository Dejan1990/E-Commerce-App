<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('index');
});

Route::view('/admin', 'admin.dashboard.index')->name('admin.dashboard')->middleware(['admin']);
Route::view('/login', 'auth.login')->middleware(['guest']);
Route::view('/register', 'auth.register')->middleware(['guest']);

Route::get('/admin/settings', [SettingController::class, 'index'])->name('settings.index');

Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');
