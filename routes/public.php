<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

  // Route::get('/', function () {
  //     return view('index');
  // });

//Route::get('/', [PublicController::class, 'index'])->name('index.public');

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

// Route::get('password/reset', function () {
//     return view('auth.passwords.email');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/sare/livewire/livewire.js', $handle);
});
