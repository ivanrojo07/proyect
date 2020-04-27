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
    	if ($request->user()->estado) {
    		return response()->json(['estados'=>[$request->user()->estado]],200);
    	}
    	else{
    		$estados = Estado::orderBy('id','ASC')->get();
    		return response()->json(['estados'=>$estados],200);
    	}
    }

    public function municipios(Request $request, Estado $estado){
    	if ($request->user()->estado) {
    		if ($request->user()->municipio) {
    			$municipio = $request->user()->municipio;
    			return response()->json(['municipios'=>[$municipio->load('estado')]],200);
    		}
    		else{
    			$municipios = $request->user()->estado->municipios;
    			return response()->json(['municipios'=>$municipios->load('estado')],200);
    		}
    	}
    	else{
    		$municipios = $estado->municipios;
    		return response()->json(['municipios'=>$municipios->load('estado')],200);
    	}
    }

    public function localidades(Request $request, Municipio $municipio){
    	if ($request->user()->municipio) {
    		$localidades = $request->user()->municipio->localidads;
    		return response()->json(['localidades'=>$localidades->load(['municipio','municipio.estado'])],200);
    	}
    	else{
    		$localidades = $municipio->localidads;
    		return response()->json(['localidades'=>$localidades->load(['municipio','municipio.estado'])],200);
    	}
    }
}
