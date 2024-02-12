<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/sare/livewire/livewire.js', $handle);
});

// Route::get('/home', function () {
//     return view('home');
// });
//
// Route::get('/cerrars', [PrivateController::class, 'cerrars'])->name('cerrars');
// Route::post('/cerrarsp', [PrivateController::class, 'cerrarsp'])->name('cerrarsp');
