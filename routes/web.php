<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObtenerDatos;
use App\Http\Controllers\IndicadoresController;

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
});

Route::get('/datos', "App\Http\Controllers\ObtenerDatos@index");

Route::get('/indicadores','App\Http\Controllers\IndicadoresController@importarDatosApi');

