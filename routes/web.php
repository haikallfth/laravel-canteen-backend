<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('home', function () {
    return view('pages.dashboard');
});

// klo CRUD make-nya resource, nama 'user' ini juga berelasi dengan user yg di sidebar.blade.php, Usercontroller::class ini juga indexnya yg ada di sidebar.blade.php
Route::resource('user', UserController::class);

// Routing autentikasi dipindahin ke app/profiders/fortifyServiceProfider

// Route::get('/login', function () {
//     return view('pages.auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('pages.auth.register');
// })->name('register');