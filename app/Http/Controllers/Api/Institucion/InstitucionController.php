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
    	$instituciones = Institucion::orderBy('id','asc')->get();
    	$instituciones_collection = new InstitucionCollection($instituciones);
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
    	$institucion_collection = new InstitucionResource($institucion);
    	return response()->json(['institucion'=>$institucion_collection]);
    } 
}
