<?php

namespace App\Http\Controllers\Api\Incidente;

use App\Http\Controllers\Controller;
use App\Incidente\CategoriaIncidente;
use App\Incidente\TipoImpacto;
use App\Incidente\TipoSeguimiento;
use Illuminate\Http\Request;

class CatalogoIncidenteController extends Controller
{
    // Ruta GET ../api/incidentes/catalogo_incidente
    public function catalogo(Request $request){
        // obtenemos el usuario que hizo la peticion 
    	$user = $request->user();
        // Si el usuario tiene una institucion la mostramos
        $institucion = $user->institucion;
        // Si existe la institucion
    	if ($institucion) {
            // Obtenemos las categorias de incidentes que tiene acceso esta institucion
            $catalogo_incidente = $institucion->categorias_incidente;
            // retornamos una respuesta json con el categorias, subcategorias y el catalogo de incidentes de ella
    	   return response()->json(['catalogo_incidente'=>$catalogo_incidente->load(['subcategorias','subcategorias.catalogos','subcategorias.catalogos.prioridad'])],200);
        }
        else{
            // Retornamos nulo
            return response()->json(['catalogo_incidente' => null],200);
        }

    }

    // Ruta GET ../api/incidentes/tipo_seguimiento
    public function tipoSeguimiento(Request $request)
    {
        // Obtenemos los tipos de seguimiento de la base de datos
    	$seguimientos = TipoSeguimiento::orderBy('id','asc')->get();
        // Retornamos una respuesta json con los tipo de seguimientos
    	return response()->json(['tipo_seguimientos'=>$seguimientos],200);
    }

    // Ruta GET ../api/incidentes/nivel_impacto
    public function nivelImpacto(Request $request){
        // Obtenemos el nivel de impacto de la base de datos
    	$nivel_impacto = TipoImpacto::orderBy('id','asc')->get();
        // Retornamos una respuesta json con los niveles de impacto de la base de datos
    	return response()->json(['nivel_impacto'=>$nivel_impacto],200);
    }
}
