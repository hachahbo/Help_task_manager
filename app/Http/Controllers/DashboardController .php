<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all tickets or filter as needed
        $tickets = Ticket::select('id', 'title', 'status', 'priority', 'submitter')->get();

        return Inertia::render('Dashboard', [
            'tickets' => $tickets, // Pass ticket data to the dashboard
        ]);
    }
}
