<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TblInventarioDetalleController;
use App\Http\Controllers\TblInventarioEncabezadoController;
use App\Http\Controllers\TblLaboratorioController;
use App\Http\Controllers\TblTipoActivoController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::resource('detalles', TblInventarioDetalleController::class)
->middleware('auth');
Route::resource('encabezados', TblInventarioEncabezadoController::class)
->middleware('auth');
Route::resource('laboratorios', TblLaboratorioController::class)
->middleware('auth');
Route::resource('tipo_activos', TblTipoActivoController::class)
->middleware('auth');

Route::get('/list_inv', [TblInventarioDetalleController::class, 'list_inv'])->name('detalles.list_inv');
Route::get('detalles/depr_m/{interes}/{vida_util}/{importe}/{equipo}', [TblInventarioDetalleController::class, 'depr_m'])->name('detalles.depr_m');

// Seguridad
Route::resource('auth', AuthController::class)
->middleware('auth');

//Login
Route::get('/login', [AuthController::class, 'login'])
->middleware('guest')
->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])
->middleware('auth')
->name('auth.logout');