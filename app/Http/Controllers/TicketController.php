<?php
namespace App\Http\Controllers;


use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
            'priority' => 'required|string|in:low,medium,high', 
            'category' => 'required|string|in:bug,feature_request,support',
            ]
        );
        
        // dd(Auth::user()->name);

        // Create the ticket with the submitter ID
        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category' => $request->category,
            'submitter_id' => auth()->id(),
            'submitter' => Auth::user()->name,
            'status' => 'pending',
        ]);
        // Ticket::create($request->all());
        return redirect()->route('tickets.index')->with('toast', 'Ticket created successfully!');
    }

    public function index()
    {
        // Check user role
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'technicien') {
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::where('submitter_id', Auth::id())->get();
        }

        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets,
        ]);
    }
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('toast', 'Ticket deleted successfully');
    }

    public function show(Ticket $ticket)
    {

        return Inertia::render('Tickets/Show', [
            'ticket' => $ticket,
        ]);
    }
    public function updateStatus(Request $request, $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,solved',
        ]);
        
        $ticket = Ticket::findOrFail($ticket);
        // dd($request->status, $ticket->status);
        $ticket->status = $request->status;
        $ticket->save();
        return back()->with('success', 'Ticket status updated successfully.');
    }

}
