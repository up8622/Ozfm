<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerapeutController;
use App\Http\Controllers\UslugaController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\Controller;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin_view');
});

// Public therapists listing
Route::get('/admin/terapeuti', [TerapeutController::class, 'index'])->name('terapeuti.index');
Route::post('/admin/terapeuti', [TerapeutController::class, 'store'])->name('terapeuti.store');
Route::put('/admin/terapeuti/{terapeut}', [TerapeutController::class, 'update'])->name('terapeuti.update');
Route::delete('/admin/terapeuti/{terapeut}', [TerapeutController::class, 'destroy'])->name('terapeuti.destroy');

// Public usluga listing
Route::get('/admin/usluga', [UslugaController::class, 'index'])->name('usluga.index');
Route::post('/admin/usluga', [UslugaController::class, 'store'])->name('usluga.store');
Route::put('/admin/usluga/{usluga}', [UslugaController::class, 'update'])->name('usluga.update');
Route::delete('/admin/usluga/{usluga}', [UslugaController::class, 'destroy'])->name('usluga.destroy');

// Administrator login
Route::post('/login', [Controller::class, 'handle_multiple_login'])->name('admin.login');
Route::get('/admin/logout', [AdministratorController::class, 'logout'])->name('admin.logout');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
