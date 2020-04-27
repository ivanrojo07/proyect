<?php

namespace App\Http\Controllers\Api\Web;
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																					
use App\Http\Controllers\Controller;
use App\Incidente\SubcategoriaIncidente;
use Illuminate\Http\Request;

class IncidentesController extends Controller
{
    //

    public function getIncidentes(SubcategoriaIncidente $categoria)
    {
    	$incidentes = $categoria->catalogos;
    	return response()->json(['incidentes'=>$incidentes]);
    }
}
