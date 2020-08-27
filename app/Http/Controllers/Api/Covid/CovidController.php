<?php

namespace App\Http\Controllers\Api\Covid;

use App\Covid\Covid;
use App\Http\Controllers\Controller;
use App\Http\Resources\CovidCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CovidController extends Controller
{
    /****************************************************
     *                                                  *
     *  Selecciona los incidentes sucedidos en un rango *
     *                      de fechas                   *
     *                                                  *
     ****************************************************/

    public function select($fechas, Request $request){
        // Separamos las fechas de incidentes en un array 
        $req_fechas = explode("_",$fechas);
        // Obtener las dos fechas del array
        $fecha1 = $req_fechas[0];
        $fecha2 = $req_fechas[1];
        // Si las fechas tienen un formato valido y son mayor o igual la segunda que la primera
        if (\DateTime::createFromFormat('Y-m-d', $fecha1) && \DateTime::createFromFormat('Y-m-d', $fecha1)->format('Y-m-d') == $fecha1  && \DateTime::createFromFormat('Y-m-d', $fecha2) && \DateTime::createFromFormat('Y-m-d', $fecha2)->format('Y-m-d') == $fecha2 & strtotime($fecha1) < strtotime($fecha2)) {
            // Realizamos la busqueda entre fechas, convirtiendo el campo fecha en formato date
            $tests = Covid::whereBetween(DB::raw('DATE(fecha)'),[$fecha1,$fecha2])->orderBy('id','DESC')->get();
            // Y agregamos en una collección json 
            $test_collection = new CovidCollection($tests);
            // Retornamos en una respuesta json
            return response()->json(['data'=>$test_collection],200);
        }
        // De lo contrario, retornamos un error con status 422
        else{
            return response()->json(['error'=>'formato de fechas incorrecto'],422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //reglas de validación
        $rules = [
            'lat' => "required|numeric",
            'lng' => "required|numeric",
            'idUsuario' => "required|numeric",
            'edad' => "required|numeric|min:0",
            'genero' => "required|string",
            'cp' => "required|string|regex:/[0-9]{5}/",
            'fecha' => "required|date|date_format:Y-m-d H:i:s",
            'hora' => "required|date_format:H:i:s",
            'convivir_enfermo' => "required|boolean",
            'fiebre' => 'required|boolean',
            'dolor_cabeza' => "required|boolean",
            'tos' => "required|boolean",
            'dolor_pecho' => "required|boolean",
            'dolor_garganta' => "required|boolean",
            'dificultad_respirar' => "required|boolean",
            'escurrimiento_nasal' => "required|boolean",
            'dolor_cuerpo' => "required|boolean",
            'conjuntivitis' => "required|boolean",
            'dias_sintomas' => "nullable|numeric|min:0",
            'condiciones_medicas' => "required|string",
            'embarazada' => "nullable|boolean",
            'meses_embarazo' => "nullable|numeric|min:0",
            'dolor_respirar' => "nullable|boolean",
            'falta_aire' => "nullable|boolean",
            'coloracion_azul' => "nullable|boolean",
            'score' => 'required|numeric',


        ];
        // Validamos el formulario
        $request->validate($rules);
        // Creamos un objeto
        $test = new Covid([
            'convivir_enfermo' => $request->convivir_enfermo,
            'fiebre' => $request->fiebre,
            'dolor_cabeza' => $request->dolor_cabeza,
            'tos' => $request->tos,
            'dolor_pecho' => $request->dolor_pecho,
            'dolor_garganta' => $request->dolor_garganta,
            'dificultad_respirar' => $request->dificultad_respirar,
            'escurrimiento_nasal' => $request->escurrimiento_nasal,
            'dolor_cuerpo' => $request->dolor_cuerpo,
            'conjuntivitis' => $request->conjuntivitis,
            'condiciones_medicas' => $request->condiciones_medicas,
            'embarazada' => (isset($request->embarazada) ? $request->embarazada : -1 ),
            'meses_embarazo' => (isset($request->meses_embarazo) ? $request->meses_embarazo : -1),
            'dias_sintomas' => (isset($request->dias_sintomas) ? $request->dias_sintomas : -1),
            'dolor_respirar' => (isset($request->dolor_respirar) ? $request->dolor_respirar : -1),
            'falta_aire' => (isset($request->falta_aire) ? $request->falta_aire : -1),
            'coloracion_azul' => (isset($request->coloracion_azul) ? $request->coloracion_azul : -1),
            'lat' => $request->lat,
            'lng' => $request->lng,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'origen' => "movil",
            'id_usuario' => $request->idUsuario,
            'edad' => $request->edad,
            'genero' => $request->genero,
            'cp' => $request->cp,
            'score' => $request->score
        ]);
        // Lo relacionamos por el que creo el registro
        $test->user_id = $request->user()->id;
        // salvamos
        $test->save();
        // retornamos el registro en formato json
        return response()->json(['registro'=>$test],201);
    }

}
