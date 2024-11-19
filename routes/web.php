<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

// not authorised

Route::inertia('/', 'Home')->name('home');


Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('register', [AuthController::class, 'register']);


Route::inertia('/login', 'Auth/Login')->name('login');
Route::post('login', [AuthController::class, 'login']);
// ---------

// authorised

Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
Route::inertia('/settings', 'Settings')->name('settings');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
// 