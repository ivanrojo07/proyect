<?php

namespace App\Http\Controllers\Api\Incidente;

use App\Http\Controllers\Controller;
use App\Incidente\CategoriaIncidente;
use Illuminate\Http\Request;

class CatalogoIncidenteController extends Controller
{
    //
    public function catalogo(Request $request){
    	$tipo_catalogo_user = $request->user()->tipo_catalogo;
    	if ($tipo_catalogo_user == 'proteccion civil') {
    		$catalogo_incidente = CategoriaIncidente::where('nombre','Protección civil')->get();

    	}
    	elseif ($tipo_catalogo_user == 'incidente') {
    		$catalogo_incidente = CategoriaIncidente::where('nombre','<>','Protección civil')->get();
    	}
    	else{
    		$catalogo_incidente = CategoriaIncidente::get();
    	}

    	return response()->json(['catalogo_incidente'=>$catalogo_incidente->load(['subcategorias','subcategorias.catalogos','subcategorias.catalogos.prioridad'])],201);
    }
}
