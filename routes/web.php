<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Auth::routes();

//Route::get('/hola', 'MessageController@index');


Route::get('/hla', function () {
    return view('home');
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/usuarios', [App\Http\Controllers\PruebaController::class, 'index']);
Route::get('/fincas', [App\Http\Controllers\FincaController::class, 'index']);
Route::get('/fincasUsuario/', [App\Http\Controllers\FincaController::class, 'indexfincas']);
Route::post('/enviarfinca', [App\Http\Controllers\FincaController::class, 'crear']);
Route::put('/fincas/{id}', [App\Http\Controllers\FincaController::class, 'update']);
Route::get('/usuariofincas/{id}', [App\Http\Controllers\FincaController::class, 'traerUsuario']);
Route::get('/usuariofinca/{id}', [App\Http\Controllers\FincaController::class, 'traerFinca']);


Route::get('/', function () {
    return view('auth.register');
});
Route::get('/page', function () {
    return view('mapa');
});
