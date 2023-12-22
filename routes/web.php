<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ClienteController;

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
    return view('auth/login');
});

Auth::routes();


Route::group(['middleware'=>'auth'],function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/obtenerFechaActual', [App\Http\Controllers\HomeController::class, 'fecha_hora']);


    // Rutas Grupo
    Route::get('/listarGrupos', [GrupoController::class, 'listarGrupos']);


    // Rutas Cliente
    Route::get('/listarClientes', [ClienteController::class, 'listarClientes']);
    Route::get('/crearCliente', function () {
        return view('registrarCliente');
    })->name('crearCliente');
    Route::post('/crearCliente', [ClienteController::class, 'crearCliente']);
});

