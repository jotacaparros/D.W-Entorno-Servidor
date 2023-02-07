<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;

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
    return view('auth.login');
});

// Route::get('/clientes', function () {
//     return view('clientes.index');
// });

// Route::get('/clientes/create', function () {
//     return view('clientes.create');
// });

// Route::get('/clientes/edit', function () {
//     return view('clientes.edit');
// });

// Route::get('/clientes',[ClientesController::class, 'index']);
// Route::get('/clientes',[ClientesController::class, 'create']);
// Route::get('/clientes',[ClientesController::class, 'edit']);

Route::resource('clientes', ClientesController::class)->middleware('auth');
Route::resource('facturas', FacturasController::class)->middleware('auth');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
