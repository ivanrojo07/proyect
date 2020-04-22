<?php

namespace App\Http\Controllers\Api\Incidente;

use App\Http\Controllers\Controller;
use App\Incidente\RegistroIncidente;
use Illuminate\Http\Request;

class RegistroIncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incidentes = RegistroIncidente::orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
        return response()->json(['incidentes'=>$incidentes],200);
    }

    /**
     * Display a listing of the resource created today.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesHoy(){
    	$hoy = Date('Y-m-d');
    	$incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
    	return response()->json(['incidentes'=>$incidentes],200);
    }

    /**
     * Display a listing of the resource created in a date.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesDate($fecha){
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha) && \DateTime::createFromFormat('Y-m-d', $fecha)->format('Y-m-d') == $fecha ) {
    		// it's a date
    		$incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
    		return response()->json(['incidentes'=>$incidentes],200);
		  
		}
		else{
			return response()->json(['error'=>'formato de fecha incorrecto'],422);
		}
    }

    /**
     * Display a listing of the resource created in a date.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesBetween($fecha1,$fecha2){
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha1) && \DateTime::createFromFormat('Y-m-d', $fecha1)->format('Y-m-d') == $fecha1  && \DateTime::createFromFormat('Y-m-d', $fecha2) && \DateTime::createFromFormat('Y-m-d', $fecha2)->format('Y-m-d') == $fecha2 & strtotime($fecha1) < strtotime($fecha2) ) {

    		// it's a date
    		$incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
    		return response()->json(['incidentes'=>$incidentes],200);
    	}else{
    		return response()->json(['error'=>'formato de fecha incorrecto'],422);
    	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
        	'incidente.id_incidente' => 'numeric|required|exists:catalogo_incidentes,id',
			'incidente.id_estado' => 'numeric|required|exists:estados,id',
			'incidente.id_municipio' =>"numeric|required|exists:municipios,id,estado_id,{$request['incidente.id_estado']}",
			'incidente.descripcion' => 'required|string|max:560',
			'incidente.locacion'  => 'required|string|max:250',
			'incidente.latitud'   => 'required|numeric',
			'incidente.longitud'  => 'required|numeric',
			'incidente.lugares_afectados' => 'nullable|string|max:200',
			'incidente.localidades_afectadas.*' => 'nullable|numeric|exists:localidads,id',
			'incidente.fecha' => 'required|date|date_format:Y-m-d',
			'incidente.hora'  => 'required|date_format:H:i',
			'incidente.afectacion_vial'    => 'nullable|string|max:200',
			'incidente.personas_afectadas'  => 'required|numeric|min:0',
			'incidente.infraestructura' => 'nullable|string|max:200',
			'incidente.personas_lesionadas' => 'required|numeric|min:0',
			'incidente.danos_colaterales' => 'nullable|string|max:200',
			'incidente.personas_fallecidas' => 'required|numeric|min:0',
			'incidente.estatus_incidente' => 'required|boolean',
			'incidente.personas_desaparecidas' => 'required|numeric|min:0',
			'incidente.tipo_seguimiento'  => 'required|numeric|exists:tipo_seguimientos,id',
			'incidente.personas_evacuadas' => 'required|numeric|min:0',
			'incidente.nivel_impacto' => 'required|numeric|exists:tipo_impactos,id',
			'incidente.medida_control' => 'required|string|max:200',
			'respuestainstitucional.dependencia'   => 'required|string|max:200',
			'respuestainstitucional.nombre' => 'required|string|max:200',
			'respuestainstitucional.cargo' => 'required|string|max:200',
			'dependencia.datos_llamada' => 'nullable|json',
			'dependencia.tiempo_llamada' => 'nullable|json',
			'dependencia.tiempo_atencion' => 'nullable|json',
			'dependencia.descripcion_llamada' => 'nullable|json'
        ];
        $validator = $request->validate($rules);
        $incidente = $request->incidente;
        $respuesta_institucional = $request->respuestainstitucional;
        $dependencia = $request->dependencia;

        return response()->json(['response'=>$request->all()],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroIncidente $incidente)
    {
        //
        $incidente_resp = $incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','incidente_siguiente','incidente_previo','dependencia','dependencia_reportes']);
        return response()->json(['incidente'=>$incidente_resp],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
