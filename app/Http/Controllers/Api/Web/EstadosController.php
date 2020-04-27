<?php

namespace App\Http\Controllers\Api\Web;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadosController extends Controller
{
    //Obtener datos de estados y municipio de los diferentes tablas (Problemas con registros en formato json)
    public function getEstados(){
    	$estados = Estado::get();
    	return response()->json(["estados"=>$estados],201);
    }

    // Obtener los municipios del estado obtenido
    public function getMunicipios($estado_id)
    {
    	
    		// Obtenemos el estado por id
    		$estado = Estado::find($estado_id);
    		// Verificamos si existe el registro
    		if (!empty($estado)) {
    			// Creamos una tabla con los diferentes municipios de este estado
    			$municipios = $estado->municipios;
    			// Retornamos la list
    			return response()->json(['municipios'=>$municipios],201);

    		}
    		else{
    			return response()->json(['message'=>"Estado no encontrado"],404);
    		}    		

    }

    public function showMunicipios($estado_id){
    	// Obtenemos el estado por id
		$estado = Estado::find($estado_id);
		// Verificamos si existe el registro
		if (!empty($estado)) {
    		// Creamos una tabla con los diferentes municipios de este estado
			$municipios = $estado->municipios;
			// Retornamos la list
			return response()->json(["municipios"=>$municipios],201);
		}
		else{
			return response()->json(['message'=>"Estado no encontrado"],404);
		}    
    }

    public function getLocalidades(Municipio $municipio){
        $localidades = $municipio->localidads;
        return response()->json(['localidades'=>$localidades],201);
    }

}
