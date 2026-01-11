<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public therapists listing
Route::get('/terapeuti', function () {
    $terapeuti = App\Models\Terapeut::all();

    return view('terapeuti.index', compact('terapeuti'));
})->name('terapeuti.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
