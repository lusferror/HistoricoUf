<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query;
use App\Models\Articulos;
use Illuminate\Database\Schema\IndexDefinition;

class ObtenerDatos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $obj=new stdClass();
        $token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJQb3N0dWxhY2lvbmVzSldUU2VydmljZUFjY2Vzc1Rva2VuIiwianRpIjoiMGJiZjcyOTUtZTI2Yi00M2VmLWI0ZGUtZGU0ZGYxODM4YTgzIiwiaWF0IjoiMS8xMi8yMDIzIDY6NDM6MTQgUE0iLCJVc2VySWQiOiJJZCIsIkRpc3BsYXlOYW1lIjoiUG9zdHVsYW50ZSAyMDIzMDEiLCJVc2VyTmFtZSI6Imx1aXNhbGZyZWRvcm9ibGVzMDlAZ21haWwuY29tIiwiRW1haWwiOiJsdWlzYWxmcmVkb3JvYmxlczA5QGdtYWlsLmNvbSIsImV4cCI6MTY3MzU2MzY5NCwiaXNzIjoiaHR0cHM6Ly9zb2x1dG9yaWEuY2wvIiwiYXVkIjoiSldUU2VydmljZVBvc3R1bGFudGUifQ.ExsWv3rogU-SsbxM3CHDFV0nc63WZe4hrKhdXlYJ0aY";
        $indicadores= HTTP::asJson()->post('http://postulaciones.solutoria.cl/api/indicadores',['headers'=>['Authorization'=>('Bearer '.$token)]]);
        
        // $personasArray=$personas->json();
        // // $personas="SOMOS PERSONAS";
        // return view('datos',compact('personasArray'));

        // $personas= HTTP::asJson()->post('http://192.168.0.6:3100/prueba',
        // ['prueba'=>'ok']);

        // $articulos=Articulos::all();
        // $personas="SOMOS PERSONAS";
        // return view('datos',compact('articulos'));
        return view('/datos',compact('indicadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $articulos=Articulos::all();
        return response()->json($articulos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        //
        $token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJQb3N0dWxhY2lvbmVzSldUU2VydmljZUFjY2Vzc1Rva2VuIiwianRpIjoiZmY1MmE0MjQtYjNkMi00MTEzLThiZmEtOWI2NzE0MDIyZGY4IiwiaWF0IjoiMS8xMi8yMDIzIDk6MTg6MjUgUE0iLCJVc2VySWQiOiJJZCIsIkRpc3BsYXlOYW1lIjoiUG9zdHVsYW50ZSAyMDIzMDEiLCJVc2VyTmFtZSI6Imx1aXNhbGZyZWRvcm9ibGVzMDlAZ21haWwuY29tIiwiRW1haWwiOiJsdWlzYWxmcmVkb3JvYmxlczA5QGdtYWlsLmNvbSIsImV4cCI6MTY3MzU3MzAwNSwiaXNzIjoiaHR0cHM6Ly9zb2x1dG9yaWEuY2wvIiwiYXVkIjoiSldUU2VydmljZVBvc3R1bGFudGUifQ.OeMUNtT_zrKqXVl-mx684NQySN6YizbYZj8mYncRaYk";
        $indicadores= HTTP::get('http://postulaciones.solutoria.cl/api/indicadores',['headers'=>['Authorization'=>'Bearer '.$token,'Accept'=>'application/json']]);
        
        return json_decode($indicadores);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
