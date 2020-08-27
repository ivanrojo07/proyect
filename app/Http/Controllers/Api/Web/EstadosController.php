<?php

namespace App\Http\Controllers\Api\Web;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadosController extends Controller
{
    // Ruta GET ../api/web/estados
    public function getEstados(){
       //Obtener datos de estados y municipio de los diferentes tablas (Problemas con registros en formato json)
    	$estados = Estado::orderBy('nombre','asc')->get();
        // retornamos una respuesta json con los estados de la bd
    	return response()->json(["estados"=>$estados],201);
    }

    // Obtener los municipios del estado obtenido
    // Ruta GET ../api/web/estados/{estado_id}/municipios
    public function getMunicipios($estado_id)
    {
    	
    		// Obtenemos el estado por id
    		$estado = Estado::find($estado_id);
    		// Verificamos si existe el registro
    		if (!empty($estado)) {
    			// Creamos una tabla con los diferentes municipios de este estado
    			$municipios = $estado->municipios()->orderBy('nombre','asc')->get();
    			// Retornamos la list
    			return response()->json(['municipios'=>$municipios],201);

    		}
    		else{
    			return response()->json(['message'=>"Estado no encontrado"],404);
    		}    		

    }

    // Ruta GET ../api/web/show_municipios/{estado_id}
    public function showMunicipios($estado_id){
    	// Obtenemos el estado por id
		$estado = Estado::find($estado_id);
		// Verificamos si existe el registro
		if (!empty($estado)) {
    		// Creamos una tabla con los diferentes municipios de este estado
			$municipios = $estado->municipios()->orderBy('nombre','asc')->get();
			// Retornamos la list
			return response()->json(["municipios"=>$municipios],201);
		}
		else{
            // Retornamos una respuesta 404 not found
			return response()->json(['message'=>"Estado no encontrado"],404);
		}    
    }

    // Rute GET ../api/web/municipios/{municipio}/localidades
    public function getLocalidades(Municipio $municipio){
        // Obtemenos las localidades del municipio
        $localidades = $municipio->localidads()->orderBy('nombre','asc')->get();
        // Retornamos una respuesta json con el resultado
        return response()->json(['localidades'=>$localidades],201);
    }

}
