<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  // Import DB facade for transactions

use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate 
        // dd($request->all());
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        // Begin a transaction
        DB::beginTransaction();

        try {
            // If validation passes -> Register user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Login the user
            Auth::login($user);  // Use the facade correctly

            // Commit the transaction if everything is fine
            DB::commit();

            // Redirect after successful login
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Rollback the transaction if there is an error
            DB::rollBack();

            // Handle errors (optional: for better error handling, you can log the exception)
            return response()->json(['error' => 'An error occurred. Please try again.'], 500);
        }
    }
    public function login(Request $request)
    {
        // dd('here');
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Redirect to the home page
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    
    }
        public function logout(Request $request)
        {
            // Log the user out
            Auth::logout();
    
            // Invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            // Redirect the user to the login page
            return redirect()->route('login');
        }
}