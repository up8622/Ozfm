<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /**
     * Handle administrator login
     */
    public function login(Request $request)
    {
        logger("Usao u login funkciju");
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        logger("Dosao je do ovde");
        $admin = Administrator::where('username', $request->input('username'))->first();
        
        if ($admin && Hash::check($request->input('password'), $admin->hash)) {
            // Store admin info in session
            session(['admin_id' => $admin->id, 'admin_name' => $admin->ime . ' ' . $admin->prezime]);
            
            return redirect('/admin')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['/login' => 'Invalid username or password']);
    }

    /**
     * Logout administrator
     */
    public function logout(Request $request)
    {
        session()->forget(['admin_id', 'admin_name']);
        
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
