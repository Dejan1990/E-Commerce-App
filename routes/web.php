<?php


use Illuminate\Support\Facades\Route;

require 'admin.php';

Route::get('/', function () {
    return view('index');
});


Route::view('/login', 'auth.login')->middleware(['guest']);
Route::view('/register', 'auth.register')->middleware(['guest']);



