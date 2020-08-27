<?php

namespace App\Http\Controllers\Api\Institucion;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstitucionCollection;
use App\Roles\Institucion;
use App\Http\Resources\Institucion as InstitucionResource;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * Ruta GET ../api/institucions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenemos todas las instituciones
    	$instituciones = Institucion::orderBy('id','asc')->get();
        // Creamos una collección json con el resultado
    	$instituciones_collection = new InstitucionCollection($instituciones);
        // Retornamos la colección como una respuesta json
    	return response()->json($instituciones_collection,200);
    }

    /**
     * Retorna el objeto con el id dado.
     * 
     * Ruta GET ../api/institucions/{id}
     *
     * @param integer Id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion){
        // Creamos una coleccion json de las instituciones
    	$institucion_collection = new InstitucionResource($institucion);
        // Retornamos el resultado en una respuesta json
    	return response()->json(['institucion'=>$institucion_collection]);
    } 
}
