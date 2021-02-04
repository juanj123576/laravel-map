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
Route::post('/enviarfinca', [App\Http\Controllers\FincaController::class, 'crear']);

Route::get('/', function () {
    return view('auth.register');
});
Route::get('/page', function () {
    return view('mapa');
});
