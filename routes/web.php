<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerapeutController;
use App\Http\Controllers\UslugaController;

Route::get('/', function () {
    return view('welcome');
});

// Public therapists listing
Route::get('/terapeuti', [TerapeutController::class, 'index'])->name('terapeuti.index');
Route::post('/terapeuti', [TerapeutController::class, 'store'])->name('terapeuti.store');
Route::put('/terapeuti/{terapeut}', [TerapeutController::class, 'update'])->name('terapeuti.update');
Route::delete('/terapeuti/{terapeut}', [TerapeutController::class, 'destroy'])->name('terapeuti.destroy');

// Public usluga listing
Route::get('/usluga', [UslugaController::class, 'index'])->name('usluga.index');
Route::post('/usluga', [UslugaController::class, 'store'])->name('usluga.store');
Route::put('/usluga/{usluga}', [UslugaController::class, 'update'])->name('usluga.update');
Route::delete('/usluga/{usluga}', [UslugaController::class, 'destroy'])->name('usluga.destroy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
