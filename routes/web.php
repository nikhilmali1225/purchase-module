<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('accounts.register');
});

Route::post('/register', [UserController::class, 'register'])->name("register");

Route::get('/login', function () {
    return view('accounts.login');
});

Route::post('/login_user', [UserController::class, 'login_user'])->name("login");

Route::get('/vendor', function () {
    return view('dashboard.vendor');
})->name('vendor');

Route::get('/products', function () {
    return view('dashboard.products');
})->name('products');

Route::get('/purchase_order', function () {
    return view('dashboard.purchase_order');
})->name('purchase_order');