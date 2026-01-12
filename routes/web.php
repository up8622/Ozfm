<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerapeutController;

Route::get('/', function () {
    return view('welcome');
});

// Public therapists listing
Route::get('/terapeuti', [TerapeutController::class, 'index'])->name('terapeuti.index');
Route::post('/terapeuti', [TerapeutController::class, 'store'])->name('terapeuti.store');
Route::put('/terapeuti/{terapeut}', [TerapeutController::class, 'update'])->name('terapeuti.update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
