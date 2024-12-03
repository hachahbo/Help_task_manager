<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
   public function inbox()
{
    $user = Auth::user();

    if ($user->role === 'user') {
        // Fetch the IDs of tickets where the user is the submitter
        $ticketIds = Ticket::where('submitter_id', $user->id)->pluck('id');
        
        $comments = Comment::with(['ticket:id,title,priority', 'user:id,name,email'])
            ->select('id', 'ticket_id', 'user_id', 'comment', 'created_at') 
            ->whereIn('ticket_id', $ticketIds)
            ->where('user_id', '!=', $user->id) 
            ->orderBy('ticket_id')
            ->orderBy('created_at', 'desc') 
            ->get()
            ->groupBy('ticket_id') 
            ->map(function ($ticketComments) {
                return $ticketComments->first();
            })
            ->values(); // Reset the keys after mapping to get an indexed collection

            return Inertia::render('Inbox', [
                'comments' => $comments,
            ]);
        }
        if ($user->role === 'technicien') {

            $comments = Comment::with(['ticket:id,title,priority', 'user:id,name,email'])
                ->select('id', 'ticket_id', 'user_id', 'comment', 'created_at')
                ->where('user_id', '!=', $user->id) // Exclude logged-in user's own comments
                ->when($user->role === 'technicien', function ($query) use ($user) {
                    // If the user is a technician, filter by their techgategory
                    $query->whereHas('ticket', function ($ticketQuery) use ($user) {
                        $ticketQuery->where('category', $user->techgategory);
                    });
                })
                ->orderBy('ticket_id') // Group by ticket
                ->orderBy('created_at', 'desc') // Latest comments first
                ->get()
                ->groupBy('ticket_id') // Group comments by ticket_id
                ->map(function ($ticketComments) {
                    // Get the latest comment for each ticket
                    return $ticketComments->first();
                })
                ->values(); // Reset the keys
                return Inertia::render('Inbox', [
                    'comments' => $comments,
                ]);
            }

    // For 'admin' or 'technician' role
    $comments = Comment::with(['ticket:id,title,priority', 'user:id,name,email'])
        ->select('id', 'ticket_id', 'user_id', 'comment', 'created_at')
        ->where('user_id', '!=', $user->id) // Exclude logged-in user's own comments
        ->orderBy('ticket_id') // Group by ticket
        ->orderBy('created_at', 'desc') // Latest comments first
        ->get()
        ->groupBy('ticket_id') // Group comments by ticket_id
        ->map(function ($ticketComments) {
            // Get the latest comment for each ticket
            return $ticketComments->first();
        })
        ->values(); // Reset the keys

    return Inertia::render('Inbox', [
        'comments' => $comments,
    ]);
}

}
