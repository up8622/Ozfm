<?php

namespace App\Http\Controllers;

use App\Models\Pacijent;
use App\Models\Termin;
use App\Models\Terapeut;
use App\Models\Usluga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            
            return redirect('/pacijent/termini')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['login' => 'Invalid username or password'])->onlyInput('username', 'user_type');
    }

    /**
     * Logout pacijent
     */
    public function logout(Request $request)
    {
        session()->forget(['pacijent_id', 'pacijent_name']);
        
        return redirect('/')->with('success', 'Logged out successfully');
    }

    /**
     * Show all termins for pacijent
     */
    public function termini()
    {
        $termins = Termin::with('terapeut', 'usluga')->get()->where('pacijent_id', session('pacijent_id'));
        $terapeuti = Terapeut::all();
        $usluge = Usluga::all();
        
        return view('pacijent.termini', compact('termins', 'terapeuti', 'usluge'));
    }

    /**
     * Store a new termin
     */
    public function storeTermin(Request $request)
    {
        $request->validate([
            'vreme' => 'required|date',
            'terapeut_id' => 'required|exists:terapeut,id',
            'usluga_id' => 'required|exists:usluga,id',
        ]);

        // Get pacijent_id from session
        $pacijentId = session('pacijent_id');

        if (!$pacijentId) {
            return redirect()->route('pacijent.termini')->withErrors('Pacijent not logged in.');
        }

        $vremenskaZona = config('ordinacija.vremenska_zona');
        $vreme = Carbon::parse($request->vreme, $vremenskaZona);

        if ($vreme->lessThanOrEqualTo(now($vremenskaZona))) {
            return redirect()->route('pacijent.termini')
                ->withErrors(['vreme' => 'Termin ne može da se zakaže u prošlosti.'])
                ->withInput();
        }

        $otvara = config('ordinacija.otvara');
        $zatvara = config('ordinacija.zatvara');
        $pocetakUMinutima = $vreme->hour * 60 + $vreme->minute;

        if ($pocetakUMinutima < $otvara * 60 || $pocetakUMinutima + Termin::TRAJANJE_MINUTA > $zatvara * 60) {
            return redirect()->route('pacijent.termini')
                ->withErrors(['vreme' => sprintf(
                    'Ordinacija radi od %02d:00 do %02d:00, a tretman traje 1h. Izaberite početak između %02d:00 i %02d:00.',
                    $otvara,
                    $zatvara,
                    $otvara,
                    $zatvara - 1
                )])
                ->withInput();
        }

        $greska = DB::transaction(function () use ($request, $pacijentId, $vreme) {
            Terapeut::whereKey($request->terapeut_id)->lockForUpdate()->first();
            Pacijent::whereKey($pacijentId)->lockForUpdate()->first();

            if (Termin::where('terapeut_id', $request->terapeut_id)->preklapaSe($vreme)->exists()) {
                return 'Izabrani terapeut već ima zakazan termin u tom periodu. Tretman traje 1h, izaberite drugo vreme.';
            }

            if (Termin::where('pacijent_id', $pacijentId)->preklapaSe($vreme)->exists()) {
                return 'Već imate zakazan termin u tom periodu. Tretman traje 1h, izaberite drugo vreme.';
            }

            Termin::create([
                'vreme' => $vreme,
                'pacijent_id' => $pacijentId,
                'terapeut_id' => $request->terapeut_id,
                'usluga_id' => $request->usluga_id,
            ]);

            return null;
        });

        if ($greska) {
            return redirect()->route('pacijent.termini')->withErrors(['vreme' => $greska])->withInput();
        }

        return redirect()->route('pacijent.termini')->with('success', 'Termin added successfully.');
    }

    /**
     * Delete a termin
     */
    public function destroyTermin(Termin $termin)
    {
        // Check if the termin belongs to the logged-in pacijent
        if ($termin->pacijent_id !== session('pacijent_id')) {
            return redirect()->route('pacijent.termini')->withErrors('You can only delete your own termins.');
        }

        $termin->delete();

        return redirect()->route('pacijent.termini')->with('success', 'Termin deleted successfully.');
    }

    /**
     * Show the pacijent registration form
     */
    public function showRegisterForm()
    {
        return view('pacijent.register');
    }

    /**
     * Register a new pacijent
     */
    public function register(Request $request)
    {
        $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'godina_rodjenja' => 'required|integer|min:1900|max:' . (date('Y') - 18),
            'broj_telefona' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pacijent,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Pacijent::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'godina_rodjenja' => $request->godina_rodjenja,
            'broj_telefona' => $request->broj_telefona,
            'username' => $request->username,
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration successful! Please login.');
    }
}