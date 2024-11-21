<?php
namespace App\Http\Controllers;


use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    // Render the ticket creation form
    public function create()
    {
        return inertia('Tickets/Create'); // Corresponds to a Vue component "Tickets/Create"
    }

    // Handle form submission
    public function store(Request $request)
    {
    // Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Create the ticket with the submitter ID
    Ticket::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'submitter_id' => Auth::id(), // Get the authenticated user ID
    ]);

    return redirect()->route('dashboard')->with('success', 'Ticket created successfully!');
    }
}
