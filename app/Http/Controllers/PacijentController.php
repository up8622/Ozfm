<?php

namespace App\Http\Controllers;

use App\Models\Pacijent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacijentController extends Controller
{
    /**
     * Handle pacijent login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pacijent = Pacijent::where('username', $request->input('username'))->first();
        
        if ($pacijent && Hash::check($request->input('password'), $pacijent->password_hash)) {
            // Store pacijent info in session
            session(['pacijent_id' => $pacijent->id, 'pacijent_name' => $pacijent->ime . ' ' . $pacijent->prezime]);
            
            return redirect('/admin')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['/login' => 'Invalid username or password']);
    }

    /**
     * Logout pacijent
     */
    public function logout(Request $request)
    {
        session()->forget(['pacijent_id', 'pacijent_name']);
        
        return redirect('/')->with('success', 'Logged out successfully');
    }
}