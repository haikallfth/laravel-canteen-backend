<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('home', function () {
    return view('pages.dashboard');
});

// Routing autentikasi dipindahin ke app/profiders/fortifyServiceProfider

// Route::get('/login', function () {
//     return view('pages.auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('pages.auth.register');
// })->name('register');