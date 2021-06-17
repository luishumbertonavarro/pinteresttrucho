<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableroController;
use App\Http\Controllers\PinController;

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
    return view('/auth/login');
});

Route::get('/tablero', [TableroController::class, 'index'])->name('tablero.index');
Route::get('/tablero/create', [TableroController::class, 'create'])->name('tablero.create');
Route::post('/tablero/', [TableroController::class, 'store'])->name('tablero.store');
Route::put('/tablero/{id}', [TableroController::class, 'update'])->name('tablero.updateput');
Route::get('/tablero/{id}', [TableroController::class, 'edit'])->name('tablero.edit');
Route::delete('/tablero/{id}', [TableroController::class, 'destroy'])->name('tablero.destroy');

Route::resource('/pin', PinController::class);
Route::get('/pin/ver/{id}', [PinController::class, 'ver'])->name('pin.ver');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

