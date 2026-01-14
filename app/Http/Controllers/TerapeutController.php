<?php

namespace App\Http\Controllers;

use App\Models\Terapeut;
use App\Models\Termin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TerapeutController extends Controller
{
    public function index()
    {
        $terapeuti = Terapeut::all();
        return view('terapeuti.index', compact('terapeuti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'jmbg' => 'required|string|max:13|unique:terapeut,jmbg',
            'broj_telefona' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:terapeut,username',
            'password' => 'required|string|min:8',
        ]);

        Terapeut::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'jmbg' => $request->jmbg,
            'broj_telefona' => $request->broj_telefona,
            'username' => $request->username,
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect()->route('terapeuti.index')->with('success', 'Terapeut added successfully.');
    }

    public function update(Request $request, Terapeut $terapeut)
    {
        $request->validate([
            'prezime' => 'required|string|max:255',
            'jmbg' => 'required|string|max:13|unique:terapeut,jmbg,' . $terapeut->id,
            'broj_telefona' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:terapeut,username,' . $terapeut->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'jmbg' => $request->jmbg,
            'broj_telefona' => $request->broj_telefona,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password_hash'] = Hash::make($request->password);
        }

        $terapeut->update($data);

        return redirect()->route('terapeuti.index')->with('success', 'Terapeut updated successfully.');
    }

    public function destroy(Terapeut $terapeut)
    {
        $terapeut->delete();

        return redirect()->route('terapeuti.index')->with('success', 'Terapeut deleted successfully.');
    }

    /**
     * Show all tretmani (termins) for the logged-in terapeut
     */
    public function tretmani()
    {
        $terapeutId = session('terapeut_id');
        
        if (!$terapeutId) {
            return redirect('/')->withErrors(['login' => 'Please log in as terapeut to access this page.']);
        }

        $termins = Termin::where('terapeut_id', $terapeutId)
            ->with(['pacijent', 'usluga'])
            ->orderBy('vreme', 'asc')
            ->get();

        return view('terapeut.tretmani', compact('termins'));
    }

    /**
     * Handle terapeut login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $terapeut = Terapeut::where('username', $request->input('username'))->first();
        
        if ($terapeut && Hash::check($request->input('password'), $terapeut->password_hash)) {
            // Store terapeut info in session
            session(['terapeut_id' => $terapeut->id, 'terapeut_name' => $terapeut->ime . ' ' . $terapeut->prezime]);
            
            return redirect('/terapeut/tretmani')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['/login' => 'Invalid username or password']);
    }

    /**
     * Logout terapeut
     */
    public function logout(Request $request)
    {
        session()->forget(['terapeut_id', 'terapeut_name']);
        
        return redirect('/')->with('success', 'Logged out successfully');
    }
}