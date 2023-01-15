<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObtenerDatos;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::get('/articulos',"App\Http\Controllers\ObtenerDatos@create");

Route::get('/indicadores',"App\Http\Controllers\ObtenerDatos@store");

Route::get('/uf','App\Http\Controllers\IndicadoresController@unidadesFomento');

Route::post('/editarRegistro','App\Http\Controllers\IndicadoresController@editarRegistro');

Route::post('/borrarRegistro','App\Http\Controllers\IndicadoresController@borrarRegistro');

Route::post('/crearRegistro','App\Http\Controllers\IndicadoresController@crearRegistro');

Route::post('/filtroFecha','App\Http\Controllers\IndicadoresController@fechasGrafico');

