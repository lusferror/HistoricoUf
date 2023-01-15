<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Request as GuzzRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Client;
use App\Models\Indicadores;
use Exception;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class IndicadoresController extends Controller
{
    //
    public function importarDatosApi(){ 
        $indicadores=Indicadores::all();
        $indicadoresRegistrados=count($indicadores);
        if($indicadoresRegistrados>0){
            return view('indicadores');
        }
        else{
            $client= new GuzzleHttpClient();
            $headers=['Content-Type'=>'application/json'];
            $body='{
                "userName":"luisalfredorobles09@gmail.com ",
                "flagJson":true
            }';
            $request= new GuzzRequest('POST','https://postulaciones.solutoria.cl/api/acceso',$headers,$body);
            $response= $client->sendAsync($request)->wait();
            $token=json_decode($response->getBody())->token;
            // se sustituyen las mismas variables para almacenar los indicadores
            $client= new GuzzleHttpClient();
            $headers=['Content-Type'=>'application/json','Authorization'=>'Bearer '.$token];
            $request= new GuzzRequest('GET','https://postulaciones.solutoria.cl/api/indicadores',$headers);
            $response= $client->sendAsync($request)->wait();
            $arrayIndicadores=json_decode($response->getBody());
            foreach($arrayIndicadores as $indicador){
                Indicadores::create([
                    'nombreIndicador'=>$indicador->nombreIndicador,
                    'codigoIndicador'=>$indicador->codigoIndicador,
                    'unidadMedidaIndicador'=>strtotime($indicador->unidadMedidaIndicador),
                    'valorIndicador'=>$indicador->valorIndicador,
                    'fechaIndicador'=>strtotime($indicador->fechaIndicador)
                ]);
            }
        }
        return view('indicadores');
    }

    public function unidadesFomento(){
        $uf=Indicadores::where('nombreIndicador','UNIDAD DE FOMENTO (UF)')->orderByDesc('id')->paginate(25);
        return response()->json($uf);
    }

    public function editarRegistro(Request $request){
            $id=$request->id;
            $indicador=Indicadores::find($id);
            $indicador->nombreIndicador=$request->nombreIndicador;
            $indicador->codigoIndicador=$request->codigoIndicador;
            $indicador->unidadMedidaIndicador=$request->unidadMedidaIndicador;
            $indicador->valorIndicador=$request->valorIndicador;
            $indicador->fechaIndicador=$request->fechaIndicador;
            $indicador->save();
            return response()->json(["msg"=>"ok","resutl"=>$indicador]);
    }

    public function borrarRegistro(Request $request){
        $id=$request->id;
        $indicador=Indicadores::where('id',$id)->delete();
        $borrado=Indicadores::find($id);
        if(gettype($borrado)=="NULL"){
            return response()->json(["msg"=>"borrado"]);
        }
        else{
            return response()->json(["msg"=>"error"]);
        }
    }

    public function crearRegistro(Request $indicador){
        Indicadores::create([
            'nombreIndicador'=>$indicador->nombreIndicador,
            'codigoIndicador'=>$indicador->codigoIndicador,
            'unidadMedidaIndicador'=>$indicador->unidadMedidaIndicador,
            'valorIndicador'=>$indicador->valorIndicador,
            'fechaIndicador'=>$indicador->fechaIndicador
        ]);
        return response()->json(["msg"=>"ok"]);
    }

    public function fechasGrafico(Request $request){
        $indicadores=DB::table('indicadores')->select('valorIndicador','fechaIndicador')->where('fechaIndicador','>=',$request->desde)
        ->where('fechaIndicador','<=',$request->hasta)->where('codigoIndicador','=','UF')->orderBy('fechaIndicador')->get();
        return response()->json($indicadores);
    }
}
