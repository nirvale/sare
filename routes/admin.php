<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProgramaController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\DominioController;
use App\Http\Controllers\Admin\DatacenterController;
use App\Http\Controllers\Admin\TipodcController;
use App\Http\Controllers\CatmanController;

//Route::get('/', [HomeController::class, 'index']);
//manejo de usuarios
Route::resource('usuario', UserController::class)->except(['edit']);
Route::get('listausuarios', [UserController::class, 'listausuarios'])->name('usuario.lista');
//CRUD Programas
Route::resource('programashome', ProgramaController::class)->only(['index']);
//CRUD Dependencias
Route::resource('dependenciashome', DependenciaController::class)->only(['index']);
//ruta para datatables usuario
Route::get('usersdt', [UserController::class, 'indexdt'])->name('users.indexdt');
//ruta para datatables dominios
Route::get('dominio', [DominioController::class, 'indexdt'])->name('dominios.indexdt');
//RUTAS CRUD Dominios
Route::resource('dominio', DominioController::class)->only(['update','store','destroy']);
//ruta para datatables tipodc
Route::get('tipodc', [TipodcController::class, 'indexdt'])->name('tipodcs.indexdt');
//RUTAS CRUD Tipodcs
Route::resource('tipodc', TipodcController::class)->only(['update','store','destroy']);
//ruta para datatables datacenters
Route::get('datacenter', [DatacenterController::class, 'indexdt'])->name('datacenters.indexdt');
//RUTAS CRUD Datacenters
Route::resource('datacenter', DatacenterController::class)->only(['update','store','destroy']);
//ruta para CatmanController
Route::group(['middleware' => ['role:Administrador|God','permission:ver_catalogos']], function () {
    Route::post('catman', [CatmanController::class, 'catman'])->name('admin.catman');
});

//livewire assets
Livewire::setScriptRoute(function ($handle) {
    return Route::get('../sare/livewire/livewire.js', $handle);
});
