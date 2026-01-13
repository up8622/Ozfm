<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerapeutController;
use App\Http\Controllers\UslugaController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PacijentController;

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::post('/login', [Controller::class, 'handle_multiple_login'])->name('admin.login');

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin_view');
    });

    // Admin terapeut management
    Route::get('/admin/terapeuti', [TerapeutController::class, 'index'])->name('terapeuti.index');
    Route::post('/admin/terapeuti', [TerapeutController::class, 'store'])->name('terapeuti.store');
    Route::put('/admin/terapeuti/{terapeut}', [TerapeutController::class, 'update'])->name('terapeuti.update');
    Route::delete('/admin/terapeuti/{terapeut}', [TerapeutController::class, 'destroy'])->name('terapeuti.destroy');

    // Admin usluga management
    Route::get('/admin/usluga', [UslugaController::class, 'index'])->name('usluga.index');
    Route::post('/admin/usluga', [UslugaController::class, 'store'])->name('usluga.store');
    Route::put('/admin/usluga/{usluga}', [UslugaController::class, 'update'])->name('usluga.update');
    Route::delete('/admin/usluga/{usluga}', [UslugaController::class, 'destroy'])->name('usluga.destroy');

    // Admin logout
    Route::get('/admin/logout', [AdministratorController::class, 'logout'])->name('admin.logout');
});

Route::get('/terapeut/logout', [TerapeutController::class, 'logout'])->name('admin.logout');

// Pacijent routes
Route::middleware('pacijent.auth')->group(function () {
    Route::get('/pacijent/termini', [PacijentController::class, 'termini'])->name('pacijent.termini');
    Route::post('/pacijent/termini', [PacijentController::class, 'storeTermin'])->name('pacijent.termini.store');
    Route::delete('/pacijent/termini/{termin}', [PacijentController::class, 'destroyTermin'])->name('pacijent.termini.destroy');

    Route::get('/pacijent/logout', [PacijentController::class, 'logout'])->name('pacijent.logout');
});

// Public pacijent registration routes
Route::get('/pacijent/register', [PacijentController::class, 'showRegisterForm'])->name('pacijent.register');
Route::post('/pacijent/register', [PacijentController::class, 'register'])->name('pacijent.register.store');

// Terapeut routes
Route::middleware('terapeut.auth')->group(function () {
    Route::get('/terapeut/tretmani', [TerapeutController::class, 'tretmani'])->name('terapeut.tretmani');
});

Route::get('/terapeut/logout', [TerapeutController::class, 'logout'])->name('terapeut.logout');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
