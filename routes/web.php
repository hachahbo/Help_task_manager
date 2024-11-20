<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Models\User;

// not authorised

Route::inertia('/', 'Home')->name('home');


Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('register', [AuthController::class, 'register']);


Route::inertia('/login', 'Auth/Login')->name('login');
Route::post('login', [AuthController::class, 'login']);
// ---------

// authorised

Route::get('/dashboard', function (Request $request) {
    return Inertia::render('Dashboard', [
        'users' => User::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->paginate(8)->withQueryString(),
        'searchTerm' =>$request->search,

        'can' => [
        'delete_user' => Auth::user() 
            ? Auth::user()->can('delete', User::class) 
            : null,
        ],
    ]);
})->name('dashboard');

Route::inertia('/settings', 'Settings')->name('settings');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
// 