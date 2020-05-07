<?php

namespace App\Http\Controllers\Api\Incidente;

use App\Http\Controllers\Controller;
use App\Incidente\CategoriaIncidente;
use App\Incidente\TipoImpacto;
use App\Incidente\TipoSeguimiento;
use Illuminate\Http\Request;

class CatalogoIncidenteController extends Controller
{
    //
    public function catalogo(Request $request){
    	$user = $request->user();
        $institucion = $user->institucion;
    	if ($institucion) {
            $catalogo_incidente = $institucion->categorias_incidente;
    	   return response()->json(['catalogo_incidente'=>$catalogo_incidente->load(['subcategorias','subcategorias.catalogos','subcategorias.catalogos.prioridad'])],200);
        }
        else{
            return response()->json(['catalogo_incidente' => null],200);
        }

    }

    public function tipoSeguimiento(Request $request)
    {
    	$seguimientos = TipoSeguimiento::orderBy('id','asc')->get();
    	return response()->json(['tipo_seguimientos'=>$seguimientos],200);
    }

    public function nivelImpacto(Request $request){
    	$nivel_impacto = TipoImpacto::orderBy('id','asc')->get();
    	return response()->json(['nivel_impacto'=>$nivel_impacto],200);
    }
}
