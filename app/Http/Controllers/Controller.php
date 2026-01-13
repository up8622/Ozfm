<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\TerapeutController;
use App\Http\Controllers\PacijentController;


abstract class Controller       
{
    public function handle_multiple_login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'user_type'=> 'required|string|in:admin,terapeut,pacijent',
        ]);

        if ($request->input('user_type') === 'admin') {
            return app(AdministratorController::class)->login($request);

        } elseif ($request->input('user_type') === 'terapeut') {
            return app(TerapeutController::class)->login($request);
        
        } elseif ($request->input('user_type') === 'pacijent') {
            return app(PacijentController::class)->login($request);
        }

        return back()->withErrors(['/login' => 'Invalid username or password']);
    }
}
