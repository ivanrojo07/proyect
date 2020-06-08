<?php

namespace App\Http\Controllers\Api\Web;
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																					
use App\Http\Controllers\Controller;
use App\Incidente\SubcategoriaIncidente;
use Illuminate\Http\Request;

class IncidentesController extends Controller
{
    // Ruta GET ../api/web/incidentes/{categoria}
    public function getIncidentes(SubcategoriaIncidente $categoria)
    {
    	// Obtenemos el catalogo de incidente para esa categoria
    	$incidentes = $categoria->catalogos()->orderBy('nombre','asc')->get();
    	// Retornamos un json con el resultado
    	return response()->json(['incidentes'=>$incidentes],200);
    }
}
