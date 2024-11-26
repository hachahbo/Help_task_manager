<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Ticket;
use App\Http\Controllers\TicketController;

Route::middleware('guest')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/users', function (Request $request) {
        return Inertia::render('Users', [
            'users' => User::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->paginate(8)->withQueryString(),
            'searchTerm' => $request->search,
            'can' => [
                'delete_user' => Auth::user() 
                    ? Auth::user()->can('delete', User::class) 
                    : null,
            ],
        ]);
    })->name('users');
    // authorised
   
    Route::get('/dashboard', function (Request $request) {
        // Calculate ticket counts
        $ticketCounts = [
            'pending' => Ticket::where('status', 'pending')->count(),
            'in_progress' => Ticket::where('status', 'in_progress')->count(),
            'solved' => Ticket::where('status', 'solved')->count(),
        ];

        $tickets = Ticket::when($request->search, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        })->paginate(8)->withQueryString();

        return Inertia::render('Dashboard', [
            'users' => User::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->paginate(8)->withQueryString(),
            'searchTerm' => $request->search,
            'can' => [
                'delete_user' => Auth::user() 
                    ? Auth::user()->can('delete', User::class) 
                    : null,
            ],
            'ticketCounts' => $ticketCounts,
            'tickets' => $tickets, // Pass tickets to the view
        ]);
    })->name('dashboard');
    
    Route::inertia('/settings', 'Settings')->name('settings');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    // Route to handle form submission
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    // 

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/test', function () {
        return redirect()->back()->with('toast', 'Toast endpoint!');
    });
    //admin routes
    // web.php
        Route::put('/users/{id}/update-role', [AdminController::class, 'updateRole']);

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

});

