<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/admin', 'admin.dashboard.index')->middleware(['admin']);
Route::view('/login', 'auth.login')->middleware(['guest']);
Route::view('/register', 'auth.register')->middleware(['guest']);
