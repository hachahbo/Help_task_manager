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

        // Fetch all comments for the user's tickets excluding the user's own comments
        $comments = Comment::with(['ticket:id,title,priority', 'user:id,name,email'])
            ->select('id', 'ticket_id', 'user_id', 'comment', 'created_at') // Select necessary fields
            ->whereIn('ticket_id', $ticketIds)
            ->where('user_id', '!=', $user->id) // Exclude comments by the current user
            ->orderBy('ticket_id') // Order by ticket_id to group comments by ticket
            ->orderBy('created_at', 'desc') // Order by created_at to get the latest comment first
            ->get()
            ->groupBy('ticket_id') // Group comments by ticket_id
            ->map(function ($ticketComments) {
                // For each ticket, get the latest comment (first one after ordering by created_at desc)
                return $ticketComments->first();
            })
            ->values(); // Reset the keys after mapping to get an indexed collection

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
