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
use App\Http\Controllers\InboxController;


Route::middleware('guest')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/users', function (Request $request) {
        return Inertia::render('users', [
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
        $user = Auth::user();
    
        // Filter tickets based on the user's role
        $ticketsQuery = Ticket::query();
        if ($user->role === 'user') {
            $ticketsQuery->where('submitter_id', $user->id);
        }
    
        // Apply search filter
        $tickets = $ticketsQuery->when($request->search, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        })->paginate(8)->withQueryString();
    
        $ticketCounts = [
            'pending' => Ticket::where('status', 'pending')->when($user->role === 'user', function ($query) use ($user) {
                $query->where('submitter_id', $user->id);
            })->count(),
            
            'in_progress' => Ticket::where('status', 'in_progress')->when($user->role === 'user', function ($query) use ($user) {
                $query->where('submitter_id', $user->id);
            })->count(),
            
            'solved' => Ticket::where('status', 'solved')->when($user->role === 'user', function ($query) use ($user) {
                $query->where('submitter_id', $user->id);
            })->count(),
        ];
    
        // Return the data to the Inertia view
        return Inertia::render('Dashboard', [
            'ticketCounts' => $ticketCounts,
            'tickets' => $tickets, // Pass tickets to the view
        ]);
    })->name('dashboard');

    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');

    
    Route::get('/settings', function (Request $request) {
        return Inertia::render('users', [
            'users' => User::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->where('role', 'technicien')->paginate(8)->withQueryString(),
            'searchTerm' => $request->search,
            'can' => [
                'delete_user' => Auth::user() 
                    ? Auth::user()->can('delete', User::class) 
                    : null,
            ],
        ]);
    })->name('settings');    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    // Route to handle form submission
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::put('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('tickets.updateStatus');
    // 

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/test', function () {
        return redirect()->back()->with('toast', 'Toast endpoint!');
    });

    //admin routes 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/users/{id}/update-role', [AdminController::class, 'updateRole']);
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

    // comments
    Route::get('/tickets/{ticketId}/comments', [TicketController::class, 'getComments']);
    Route::put('/tickets/{ticket}/comments', [TicketController::class, 'addComment'])->name('tickets.addComment');
    Route::get('/inbox', [InboxController::class, 'inbox'])->name('inbox');


});

