<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
//use App\Http\Controllers\Admin\ProgramaController;
//use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\DominioController;
use App\Http\Controllers\Admin\DatacenterController;
use App\Http\Controllers\Admin\TipodcController;
use App\Http\Controllers\CatmanController;
use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\OsController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\TnicController;
use App\Http\Controllers\Admin\ProgramaController;
use App\Http\Controllers\Admin\OficinaController;
use App\Http\Controllers\Admin\EstadoController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\EstadoesquemaController;
use App\Http\Controllers\Admin\TipoController;


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
//ruta para datatables Ambientes
Route::get('ambiente', [AmbienteController::class, 'indexdt'])->name('ambientes.indexdt');
//RUTAS CRUD Ambientes
Route::resource('ambiente', AmbienteController::class)->only(['update','store','destroy']);
//ruta para datatables sistemas Operativos
Route::get('os', [OsController::class, 'indexdt'])->name('oss.indexdt');
//RUTAS CRUD Sistemas Operativos
Route::resource('os', OsController::class)->only(['store']);
Route::put('os/{os}', [OsController::class,'update'])->name('os.update');
Route::delete('os/{os}', [OsController::class,'destroy'])->name('os.destroy');
//ruta para datatables Dependencias
Route::get('dependencia', [DependenciaController::class, 'indexdt'])->name('dependencias.indexdt');
//RUTAS CRUD Dependencias
Route::resource('dependencia', DependenciaController::class)->only(['store']);
Route::put('dependencia/{dependencia}', [DependenciaController::class,'update'])->name('dependencia.update');
Route::delete('dependencia/{dependencia}', [DependenciaController::class,'destroy'])->name('dependencia.destroy');
//ruta para datatables Tnics
Route::get('tnic', [TnicController::class, 'indexdt'])->name('tnics.indexdt');
//RUTAS CRUD Tnics
Route::resource('tnic', TnicController::class)->only(['update','store','destroy']);
//ruta para datatables Programas
Route::get('programa', [ProgramaController::class, 'indexdt'])->name('programas.indexdt');
//RUTAS CRUD Programas
Route::resource('programa', ProgramaController::class)->only(['update','store','destroy']);
//ruta para datatables Oficinas
Route::get('oficina', [OficinaController::class, 'indexdt'])->name('oficinas.indexdt');
//RUTAS CRUD Oficinas
Route::resource('oficina', OficinaController::class)->only(['update','store','destroy']);
//ruta para datatables Estados
Route::get('estado', [EstadoController::class, 'indexdt'])->name('estados.indexdt');
//RUTAS CRUD Estados
Route::resource('estado', EstadoController::class)->only(['update','store','destroy']);
//ruta para datatables Backups
Route::get('backup', [BackupController::class, 'indexdt'])->name('backups.indexdt');
//RUTAS CRUD Backups
Route::resource('backup', BackupController::class)->only(['update','store','destroy']);
//ruta para datatables Estadoesquemas
Route::get('estadoesquema', [EstadoesquemaController::class, 'indexdt'])->name('estadoesquemas.indexdt');
//RUTAS CRUD Estadoesquemas
Route::resource('estadoesquema', EstadoesquemaController::class)->only(['update','store','destroy']);
//ruta para datatables Tipos
Route::get('tipo', [TipoController::class, 'indexdt'])->name('tipos.indexdt');
//RUTAS CRUD Tipos
Route::resource('tipo', TipoController::class)->only(['update','store','destroy']);

//livewire assets
Livewire::setScriptRoute(function ($handle) {
    return Route::get('../sare/livewire/livewire.js', $handle);
});
