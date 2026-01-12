<?php

namespace App\Http\Controllers;

use App\Models\Usluga;
use Illuminate\Http\Request;

class UslugaController extends Controller
{
    public function index()
    {
        $usluge = Usluga::all();
        return view('usluga.index', compact('usluge'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|max:255|unique:usluga,naziv',
            'cena' => 'required|numeric|min:0',
        ]);

        Usluga::create([
            'naziv' => $request->naziv,
            'cena' => $request->cena,
        ]);

        return redirect()->route('usluga.index')->with('success', 'Usluga added successfully.');
    }

    public function update(Request $request, Usluga $usluga)
    {
        $request->validate([
            'naziv' => 'required|string|max:255|unique:usluga,naziv,' . $usluga->id,
            'cena' => 'required|numeric|min:0',
        ]);

        $usluga->update([
            'naziv' => $request->naziv,
            'cena' => $request->cena,
        ]);

        return redirect()->route('usluga.index')->with('success', 'Usluga updated successfully.');
    }

    public function destroy(Usluga $usluga)
    {
        $usluga->delete();

        return redirect()->route('usluga.index')->with('success', 'Usluga deleted successfully.');
    }
}