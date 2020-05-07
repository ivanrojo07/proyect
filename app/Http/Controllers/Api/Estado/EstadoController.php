<?php

namespace App\Http\Controllers\Api\Estado;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    //
    public function estados(Request $request){
        $user = $request->user();
        $institucion=$user->institucion;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $estados = Estado::orderBy('nombre','asc')->get();
                    break;

                case "Estatal":
                    $estados = $institucion->estados()->orderBy('nombre','asc')->get();
                    break;
                
                default:
                    $municipios_id = $institucion->municipios()->pluck('regionable_id');
                    $estados = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->orderBy('nombre','asc')->get();
                    break;
            }
        }
    	else{
            $estados = null;
        }
        return response()->json(['estados'=>$estados],200);
    }

    public function municipios(Request $request, Estado $estado){
        $user = $request->user();
        $institucion=$user->institucion;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $municipios = $estado->municipios;
                    break;

                case "Estatal":
                    $mostrar = $institucion->estados()->where('regionable_id',$estado->id)->exists();
                    if ($mostrar) {
                        $municipios = $estado->municipios;
                    }
                    else{
                        $municipios=null;
                    }
                    break;
                
                default:
                    $municipios = $institucion->municipios;
                    break;
            }
            
        }
        else{
            $municipios=null;
        }
        if ($municipios) {
            return response()->json(['municipios'=>[$municipios->load('estado')]],200);
        }
        else{
            return response()->json(['municipios'=>null],200);
        }
    }

    public function localidades(Request $request, Municipio $municipio){
        $user = $request->user();
        $institucion=$user->institucion;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $localidades = $municipio->localidads;
                    break;

                case "Estatal":
                    $mostrar = $institucion->estados()->where('regionable_id',$municipio->estado->id)->exists();
                    if ($mostrar) {
                        $localidades = $municipio->localidads;
                    }
                    else{
                        $localidades=null;
                    }
                    break;
                
                default:
                    $mostrar = $institucion->municipios()->where('regionable_id',$municipio->id)->exists();
                    if ($mostrar) {
                        $localidades = $municipio->localidads;
                    }
                    else{
                        $localidades=null;
                    }
                    break;
            }
            
        }
        else{
            $localidades=null;
        }
    	if ($localidades) {
    		return response()->json(['localidades'=>$localidades->load(['municipio','municipio.estado'])],200);
    	}
    	else{
    		return response()->json(['localidades'=>$localidades],200);
    	}
    }
}
