<?php
namespace App\Http\Controllers;


use App\Models\Ticket;
use App\Models\Comment;
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
            if (Auth::user()->role === 'technicien') {
                // Get tickets that match the technician's category
                $tickets = Ticket::where('category', Auth::user()->techgategory)->get();
            } else {
                // Admin sees all tickets
                $tickets = Ticket::all();
            }
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
        return back()->with('toast', 'Ticket deleted successfully');
    }

    public function show(Ticket $ticket)
    {
        $ticket = Ticket::with('comments.user')->findOrFail($ticket->id);
        // dd($ticket);
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
        return back()->with('toast', 'Ticket status updated successfully.');
    }
    // comment on tickets 

    public function getComments($ticketId)
    {
        $comments = Comment::with('user')->where('ticket_id', $ticket->id)->get();
        return response()->json($comments);
    }

     public function addComment(Request $request, $ticketId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        
        // // Find the ticket
        $ticket = Ticket::findOrFail($ticketId);
        
        // // Create the comment
        $comment = new Comment();
        $comment->ticket_id = $ticket->id;
        $comment->user_id = auth()->id();  // Authenticated user
        $comment->comment = $request->content;
        $comment->save();

        // // // Optionally, return the comment back or just success
        return redirect()->route('tickets.show', $ticket->id)->with('toast', 'Comment added');
    }

}
