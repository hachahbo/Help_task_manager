<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  // Import DB facade for transactions

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;


class AdminController extends Controller
{
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:admin,user,technicien',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('toast', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Prevent an admin from deleting themselves
        if (Auth::id() == $id) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        return back()->with('toast', 'User deleted successfully.');
    }

}
