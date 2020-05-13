<?php

namespace App\Http\Controllers\Api\Estado;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    // Ruta GET .../api/estados/
    public function estados(Request $request){
        // Obtenemos el usuario logueado a traves del request
        $user = $request->user();
        // Obtenemos la institucion del usuario
        $institucion=$user->institucion;
        // si existe la institucion
        if ($institucion) {
            // seleccionamos que tipo de institucion es 
            switch ($institucion->tipo_institucion) {
                // Si es institucion federal
                case "Federal":
                    // Obtenemos todos los estados del usuario
                    $estados = Estado::orderBy('nombre','asc')->get();
                    break;

                // Si es una institucion estatal
                case "Estatal":
                    // Obtenemos los estados que tiene jurisdiccion esta institucion
                    $estados = $institucion->estados()->orderBy('nombre','asc')->get();
                    break;
                
                default:
                    // obtenemos el id de los municipios de esta institucion
                    $municipios_id = $institucion->municipios()->pluck('regionable_id');
                    // Obtenemos todos los estados que correspondan a los estado_id de los municipios
                    $estados = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->orderBy('nombre','asc')->get();
                    break;
            }
        }
    	else{
            $estados = null;
        }
        // Retornamos la respuesta json con todos los estados
        return response()->json(['estados'=>$estados],200);
    }

    // Ruta GET .../api/estados/{estado}/municipios
    public function municipios(Request $request, Estado $estado){
        // Obtenemos el usuario logueado
        $user = $request->user();
        // Obtenemos la institucion del usuario
        $institucion=$user->institucion;
        // Si existe la institucion
        if ($institucion) {
            // Verificamos que tipo de institucion es
            switch ($institucion->tipo_institucion) {
                // Si es una institucion federal
                case "Federal":
                    // Obtenemos los municipios del estado en cuestion
                    $municipios = $estado->municipios;
                    break;
                // Si es una institucion estatal
                case "Estatal":
                    // Verificamos si en la relacion estados de la institucion existe el estado a buscar
                    $mostrar = $institucion->estados()->where('regionable_id',$estado->id)->exists();
                    //  si existe
                    if ($mostrar) {
                        // Mostramos los municipios de este estado
                        $municipios = $estado->municipios;
                    }
                    else{
                        // de lo contrario no mostramos nada
                        $municipios=null;
                    }
                    break;
                
                default:
                    // por defecto mostramos los municipios de la institucion
                    $municipios = $institucion->municipios;
                    break;
            }
            
        }
        else{
            // Si no tiene institucion los municipios estaran nulos
            $municipios=null;
        }
        if ($municipios) {
            // si existe municipios mostramos el json con los municipios y sus estados
            return response()->json(['municipios'=>[$municipios->load('estado')]],200);
        }
        else{
            // De lo contrario mostramos nulo
            return response()->json(['municipios'=>null],200);
        }
    }

    // Ruta GET .../api/estados/{municipio}/localidades
    public function localidades(Request $request, Municipio $municipio){
        // Obtenemos el usuario que hace la peticion
        $user = $request->user();
        // Obtenemos la institucion de este usuario
        $institucion=$user->institucion;
        // Si existe la institucion
        if ($institucion) {
            // verificamos que tipo de institucion es
            switch ($institucion->tipo_institucion) {
                // Si es una institucion federal
                case "Federal":
                    // obtenemos la localidades de este municipio
                    $localidades = $municipio->localidads;
                    break;
                // Si es una institucion estatal
                case "Estatal":
                    // verificamos si el estado del municipio a mostrar pertenezca a los estados de la institucion
                    $mostrar = $institucion->estados()->where('regionable_id',$municipio->estado->id)->exists();
                    if ($mostrar) {
                        // Mostramos las localidades del municipio
                        $localidades = $municipio->localidads;
                    }
                    else{
                        // No mostramos nada
                        $localidades=null;
                    }
                    break;
                // Si es una institucion municipal
                default:
                    // Verificamos si el municipio pertenece a los muncipios del instituto
                    $mostrar = $institucion->municipios()->where('regionable_id',$municipio->id)->exists();
                    if ($mostrar) {
                        // obtenemos las localidades de dicho municipio
                        $localidades = $municipio->localidads;
                    }
                    else{
                        // Retornamos null
                        $localidades=null;
                    }
                    break;
            }
            
        }
        else{
            // No hay institucion, mandamos null
            $localidades=null;
        }
    	if ($localidades) {
            // Si existe localidades, retornamos el las localidades con su municipio y el estado
    		return response()->json(['localidades'=>$localidades->load(['municipio','municipio.estado'])],200);
    	}
    	else{
            // Retornamos un null
    		return response()->json(['localidades'=>$localidades],200);
    	}
    }
}
