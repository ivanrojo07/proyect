<?php

namespace App\Http\Controllers\Api\Incidente;

use App\Dependencia\Dependencia;
use App\Dependencia\ReporteDependencia;
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
    public function index(Request $request)
    {
        //
        $user =$request->user();
        $institucion = $user->institucion;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $incidentes = RegistroIncidente::orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;

                case "Estatal":
                    $incidentes = RegistroIncidente::whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                
                default:
                    $incidentes = RegistroIncidente::whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
            }

            return response()->json(['incidentes'=>$incidentes],200);
        }
        else{
            return $response()->json(['incidentes'=>null],200);

        }
    }

    /**
     * Display a listing of the resource created today.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesHoy(Request $request){
    	$hoy = Date('Y-m-d');
        $user =$request->user();
        $institucion = $user->institucion;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;

                case "Estatal":
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                
                default:
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
            }

            return response()->json(['incidentes'=>$incidentes],200);
        }
        else{
            return $response()->json(['incidentes'=>null],200);

        }
    	// $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
    	// return response()->json(['incidentes'=>$incidentes],200);
    }

    /**
     * Display a listing of the resource created in a date.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesDate($fecha, Request $request){
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha) && \DateTime::createFromFormat('Y-m-d', $fecha)->format('Y-m-d') == $fecha ) {
            $user =$request->user();
            $institucion = $user->institucion;
            if ($institucion) {
                switch ($institucion->tipo_institucion) {
                    case "Federal":
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;

                    case "Estatal":
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                    
                    default:
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                }

                return response()->json(['incidentes'=>$incidentes],200);
            }
            else{
                return $response()->json(['incidentes'=>null],200);

            }
    		// it's a date
        		// $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
        		// return response()->json(['incidentes'=>$incidentes],200);
		  
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
    public function incidentesBetween($fecha1,$fecha2,Request $request){
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha1) && \DateTime::createFromFormat('Y-m-d', $fecha1)->format('Y-m-d') == $fecha1  && \DateTime::createFromFormat('Y-m-d', $fecha2) && \DateTime::createFromFormat('Y-m-d', $fecha2)->format('Y-m-d') == $fecha2 & strtotime($fecha1) < strtotime($fecha2) ) {

            $user =$request->user();
            $institucion = $user->institucion;
            if ($institucion) {
                switch ($institucion->tipo_institucion) {
                    case "Federal":
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;

                    case "Estatal":
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                    
                    default:
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                }

                return response()->json(['incidentes'=>$incidentes],200);
            }
            else{
                return $response()->json(['incidentes'=>null],200);

            }
    		// it's a date
    		// $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
    		// return response()->json(['incidentes'=>$incidentes],200);
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
    public function storeIncidente(Request $request)
    {
        //
        $rules = [
        	'incidente.id_catalogo_incidente' => 'numeric|required|exists:catalogo_incidentes,id',
			'incidente.id_estado' => 'numeric|required|exists:estados,id',
			'incidente.id_municipio' =>"numeric|required|exists:municipios,id,estado_id,{$request['incidente.id_estado']}",
			'incidente.descripcion' => 'required|string|max:560',
			'incidente.locacion'  => 'required|string|max:250',
			'incidente.latitud'   => 'required|numeric',
			'incidente.longitud'  => 'required|numeric',
			'incidente.lugares_afectados' => 'nullable|string|max:200',
			'incidente.localidades_afectadas.*' => "nullable|numeric|exists:localidads,id,municipio_id,{$request['incidente.id_municipio']}",
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
			'dependencia.datos_llamada' => 'nullable|array',
			'dependencia.tiempo_llamada' => 'nullable|array',
			'dependencia.tiempo_atencion' => 'nullable|array',
			'dependencia.descripcion_llamada' => 'nullable|array'
        ];
        $validator = $request->validate($rules);
        $incidente = $request->incidente;
        $respuesta_institucional = $request->respuestainstitucional;
        $dependencia = $request->dependencia;
        $registro_incidente = new RegistroIncidente([
        	'descripcion' => $incidente['descripcion'],
			'locacion' => $incidente['locacion'],
			'lat_especifica' => $incidente['latitud'],
			'long_especifica' => $incidente['longitud'],
			'lugares_afectados' => $incidente['lugares_afectados'],
			'fecha_ocurrencia' => $incidente['fecha'],
			'hora_ocurrencia' => $incidente['hora'],
			'afectacion_vial' => $incidente['afectacion_vial'],
			'afectacion_infraestructural' => $incidente['infraestructura'],
			'danio_colateral' => $incidente['danos_colaterales'],
			'estatus' => $incidente['estatus_incidente'],
			'medidas_control' => $incidente['medida_control'],
			'personas_afectadas' => $incidente['personas_afectadas'],
			'personas_lesionadas' => $incidente['personas_lesionadas'],
			'personas_fallecidas' => $incidente['personas_fallecidas'],
			'personas_desaparecidas' => $incidente['personas_desaparecidas'],
			'personas_evacuadas' => $incidente['personas_evacuadas'],
			'dependencia' => $respuesta_institucional['dependencia'],
			'nombre_empleado' => $respuesta_institucional['nombre'],
			'cargo_empleado' =>$respuesta_institucional['cargo']
        ]);
        $registro_incidente->catalogo_incidente_id = $incidente['id_catalogo_incidente'];
		$registro_incidente->estado_id = $incidente['id_estado'];
		$registro_incidente->municipio_id = $incidente['id_municipio'];
		$registro_incidente->tipo_seguimiento_id = $incidente['tipo_seguimiento'];
		$registro_incidente->tipo_impacto_id = $incidente['nivel_impacto'];
		$registro_incidente->user_id = $request->user()->id;
		$registro_incidente->save();
		$registro_incidente->localidades()->attach($incidente['localidades_afectadas']);
		$dependencia = new Dependencia([
			'datos_llamada' => $dependencia['datos_llamada'],
	    	'tiempo_llamada' => $dependencia['tiempo_llamada'],
	    	'tiempo_atencion' => $dependencia['tiempo_atencion'],
	    	'descripcion_llamada' => $dependencia['descripcion_llamada']
		]);
		$registro_incidente->dependencia_llamada()->save($dependencia);


        return response()->json(['incidente'=>$registro_incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','dependencia_llamada'])],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIncidente(RegistroIncidente $incidente, Request $request)
    {
        //
        $user = $request->user();
        $institucion = $user->institucion;
        $mostrar = false;
        if ($institucion) {
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    $mostrar = true;
                    break;

                case "Estatal":
                    $estado_incidente = $incidente->estado;
                    $mostrar = $institucion->estados()->where('regionable_id',$estado_incidente->id)->exists();
                    break;
                
                default:
                    $estado_incidente = $incidente->estado;
                    $municipios_id = $institucion->municipios()->pluck('regionable_id');
                    $mostrar = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->where('id',$estado_incidente->id)->exists();
                    break;
            }
            
        }
        if ($mostrar) {
            $incidente_resp = $incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','incidente_siguiente','incidente_previo','dependencia_llamada','dependencia_reportes']);
            
            return response()->json(['incidente'=>$incidente_resp],200);
        }
        else{
            return response()->json(['error'=>['mensaje'=>'No se puede mostrar el incidente porque no corresponde a tu region']],422);
        }
    }

    /**
     * Created a new reporte dependencia for registro_incidente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reporteDependencia(Request $request)
    {
        //
        $rules=[
        	'incidente.id'=>'required|numeric|exists:registro_incidentes,id',
			'incidente.reporte_dependencias.dependencia'=>'nullable|string|max:150',
			'incidente.reporte_dependencias.nombre_encargado'=>'nullable|string|max:150',
			'incidente.reporte_dependencias.atencion'=>'nullable|string|max:150',
			'incidente.reporte_dependencias.f_transmision' => 'nullable|date|date_format:d-m-Y H:i:s',
			'incidente.reporte_dependencias.h_lectura' => 'nullable|date_format:H:i:s',
			'incidente.reporte_dependencias.f_razonamiento' => 'nullable|date|date_format:d-m-Y H:i:s',
			'incidente.reporte_dependencias.razonamiento' => 'nullable|string|max:150',
			'incidente.reporte_dependencias.razon_noatencion'=>'nullable|string|max:150',
			'incidente.reporte_dependencias.obs_noatencion' => 'nullable|string|max:250',
			'incidente.reporte_dependencias.motivo' => 'required|string|max:150',
			'incidente.reporte_dependencias.folio' => 'nullable|string|max:150',
        	'incidente.reporte_dependencias.zp' => 'nullable|string|max:150',
			'incidente.reporte_dependencias.cuadrante' => 'nullable|string|max:150',
			'incidente.reporte_dependencias.sector' => 'nullable|string|max:150',
			'incidente.reporte_dependencias.observacion' => 'nullable|string|max:250'
        ];
        $request->validate($rules);
        $incidente_id = $request->incidente['id'];
        $reporte_params = $request->incidente['reporte_dependencias'];
        $registro_incidente = RegistroIncidente::find($request->incidente['id']);
        $reporte_dependencia = new ReporteDependencia([
        	'zp' => $reporte_params['zp'],
			'sector' => $reporte_params['sector'],
			'cuadrante' => $reporte_params['cuadrante'],
			'h_lectura' => $reporte_params['h_lectura'],
			'motivo' => $reporte_params['motivo'],
			'observacion' => $reporte_params['observacion'],
			'f_transmision' => $reporte_params['f_transmision'],
			'atencion' => $reporte_params['atencion'],
			'razonamiento' => $reporte_params['razonamiento'],
			'f_razonamiento' => $reporte_params['f_razonamiento'],
			'obs_noatencion' => $reporte_params['obs_noatencion'],
			'nombre_encargado' => $reporte_params['nombre_encargado'],
			'razon_noatencion' => $reporte_params['razon_noatencion'],
			'dependencia' => $reporte_params['dependencia'],
			'folio' => $reporte_params['folio']
        ]);
        $registro_incidente->dependencia_reportes()->save($reporte_dependencia);
        return response()->json(['reporte_dependencia'=>$reporte_dependencia->load('registro_incidente')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIncidente(Request $request,RegistroIncidente $incidente)
    {
        //
        $rules=[
			'incidente.descripcion' => 'required|string|max:560',
			'incidente.locacion'  => 'required|string|max:250',
			'incidente.latitud'   => 'required|numeric',
			'incidente.longitud'  => 'required|numeric',
			'incidente.lugares_afectados' => 'nullable|string|max:200',
			'incidente.localidades_afectadas.*' => "nullable|numeric|exists:localidads,id,municipio_id,{$incidente->municipio_id}",
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
			'dependencia.datos_llamada' => 'nullable|array',
			'dependencia.tiempo_llamada' => 'nullable|array',
			'dependencia.tiempo_atencion' => 'nullable|array',
			'dependencia.descripcion_llamada' => 'nullable|array'
        ];
        $request->validate($rules);
        $incidente_param = $request->incidente;
        $respuesta_institucional = $request->respuestainstitucional;
        $dependencia = $request->dependencia;

        $new_incidente = new RegistroIncidente([
            'descripcion' => $incidente_param['descripcion'],
            'locacion' => $incidente_param['locacion'],
            'lat_especifica' => $incidente_param['latitud'],
            'long_especifica' => $incidente_param['longitud'],
            'lugares_afectados' => $incidente_param['lugares_afectados'],
            'fecha_ocurrencia' => $incidente_param['fecha'],
            'hora_ocurrencia' => $incidente_param['hora'],
            'afectacion_vial' => $incidente_param['afectacion_vial'],
            'afectacion_infraestructural' => $incidente_param['infraestructura'],
            'danio_colateral' => $incidente_param['danos_colaterales'],
            'estatus' => $incidente_param['estatus_incidente'],
            'medidas_control' => $incidente_param['medida_control'],
            'personas_afectadas' => $incidente_param['personas_afectadas'],
            'personas_lesionadas' => $incidente_param['personas_lesionadas'],
            'personas_fallecidas' => $incidente_param['personas_fallecidas'],
            'personas_desaparecidas' => $incidente_param['personas_desaparecidas'],
            'personas_evacuadas' => $incidente_param['personas_evacuadas'],
            'dependencia' => $respuesta_institucional['dependencia'],
            'nombre_empleado' => $respuesta_institucional['nombre'],
            'cargo_empleado' =>$respuesta_institucional['cargo']
        ]);
        $new_incidente->catalogo_incidente_id = $incidente->catalogo_incidente->id;
        $new_incidente->estado_id = $incidente->estado->id;
        $new_incidente->municipio_id = $incidente->municipio->id;
        $new_incidente->tipo_seguimiento_id = $incidente_param['tipo_seguimiento'];
        $new_incidente->tipo_impacto_id = $incidente_param['nivel_impacto'];
        $new_incidente->user_id = $request->user()->id;
        $new_incidente->registro_incidente_id = $incidente->id;
        $new_incidente->save();
        $new_incidente->localidades()->attach($incidente_param['localidades_afectadas']);
        $dependencia = new Dependencia([
            'datos_llamada' => $dependencia['datos_llamada'],
            'tiempo_llamada' => $dependencia['tiempo_llamada'],
            'tiempo_atencion' => $dependencia['tiempo_atencion'],
            'descripcion_llamada' => $dependencia['descripcion_llamada']
        ]);
        $new_incidente->dependencia_llamada()->save($dependencia);
        return response()->json(['incidente'=>$new_incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','dependencia_llamada','incidente_previo'])],201);

    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
