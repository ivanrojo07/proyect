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
     * Ruta GET ../api/incidentes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtenemos el usuario que hace la peticion
        $user =$request->user();
        // Obtenemos la institucion del usuario
        $institucion = $user->institucion;
        // Si la institucion existe
        if ($institucion) {
            // Verificamos el tipo de institucion
            switch ($institucion->tipo_institucion) {
                // Si es institucion federal
                case "Federal":
                    // Obtenemos todos los incidentes
                    $incidentes = RegistroIncidente::orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                // Si es una institucion estatal
                case "Estatal":
                    // Obtenemos todos los incidentes que tengan los estados de nuestra institucion
                    $incidentes = RegistroIncidente::whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                // Si la institucion es municipal
                default:
                    // Obtenemos todos los incidentes que tengan los municipios de nuestra insitucion
                    $incidentes = RegistroIncidente::whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
            }
            // Retornamos la respuesta json con los incidentes
            return response()->json(['incidentes'=>$incidentes],200);
        }
        else{
            // Retornamos nulo
            return $response()->json(['incidentes'=>null],200);

        }
    }

    /**
     * Display a listing of the resource created today.
     *
     * Ruta GET ../api/incidentes/today
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesHoy(Request $request){
        // Obtenemos la fecha de hoy
    	$hoy = Date('Y-m-d');
        // Obtenemo el usuario que realizo la peticion
        $user =$request->user();
        // Y su institucion que pertenece
        $institucion = $user->institucion;
        // Si la institucion existe
        if ($institucion) {
            // Verificamos el tipo de institucion
            switch ($institucion->tipo_institucion) {
                // Si es una entidad federal
                case "Federal":
                    // obtenemos todos los incidentes con la fecha de hoy
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                // Si es una entidad estatal
                case "Estatal":
                    // Obtenemos los incidentes de hoy con los estados de la institucion
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
                // Si es una entidad municipal
                default:
                    // Obtenemos los incidentes de hoy que afecte a los municipios de la institucion
                    $incidentes = RegistroIncidente::where('fecha_ocurrencia',$hoy)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                    break;
            }
            // retornamos una respuesta json con los incidentes
            return response()->json(['incidentes'=>$incidentes],200);
        }
        else{
            // retornamos null
            return $response()->json(['incidentes'=>null],200);

        }
    }

    /**
     * Display a listing of the resource created in a date.
     *
     * Ruta GET ../api/incidentes/{fecha}
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesDate($fecha, Request $request){
        // Si son fechas validas
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha) && \DateTime::createFromFormat('Y-m-d', $fecha)->format('Y-m-d') == $fecha ) {
            // Obtenemos el usuario que hace la peticion 
            $user =$request->user();
            // Obtenemos la institucion del usuario
            $institucion = $user->institucion;
            // Si tiene institucion
            if ($institucion) {
                switch ($institucion->tipo_institucion) {
                    case "Federal":
                        // obtenemos los registro de esa fecha
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;

                    case "Estatal":
                        // Obtenemos los incidentes de esa fecha y que afecte a los estados de la institucion
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                    
                    default:
                        // Obtenemos los incidentes que afecten a los municipios de dicha institucion y en la fecha dada
                        $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                }
                // Retornamos una respuesta json con los incidentes
                return response()->json(['incidentes'=>$incidentes],200);
            }
            else{
                // Retornamos una respuesta json nulo
                return $response()->json(['incidentes'=>null],200);

            }
    		// it's a date
        		// $incidentes = RegistroIncidente::where('fecha_ocurrencia',$fecha)->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
        		// return response()->json(['incidentes'=>$incidentes],200);
		  
		}
		else{
            // retornamos un error con el formato incorrecto
			return response()->json(['error'=>'formato de fecha incorrecto'],422);
		}
    }

    /**
     * Display a listing of the resource created in a date.
     *
     *  Ruta GET ../api/incidentes/{fecha1}/{fecha2}
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentesBetween($fecha1,$fecha2,Request $request){
        // Si son fechas validas y es mayor la fecha 2 de la 1
    	if ( \DateTime::createFromFormat('Y-m-d', $fecha1) && \DateTime::createFromFormat('Y-m-d', $fecha1)->format('Y-m-d') == $fecha1  && \DateTime::createFromFormat('Y-m-d', $fecha2) && \DateTime::createFromFormat('Y-m-d', $fecha2)->format('Y-m-d') == $fecha2 & strtotime($fecha1) < strtotime($fecha2) ) {

            $user =$request->user();
            $institucion = $user->institucion;
            if ($institucion) {
                switch ($institucion->tipo_institucion) {
                    case "Federal":
                        // Incidentes entre esas fechas
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;

                    case "Estatal":
                        // Incidentes entre esas fechas y los estados de esta institucion
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                    
                    default:
                        // Incidentes entre esas fechas y los municipios de esta institucion
                        $incidentes = RegistroIncidente::whereBetween('fecha_ocurrencia',[$fecha1,$fecha2])->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('id','DESC')->with(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades'])->get();
                        break;
                }
                // Retornamos la respuesta json con estos incidentes
                return response()->json(['incidentes'=>$incidentes],200);
            }
            else{
                // Retornamos null
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
        // Reglas para validar el request
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
        // Validamos el request
        $validator = $request->validate($rules);
        // Obtenemos el objeto incidente
        $incidente = $request->incidente;
        // Obtenemos el objeto respuesta institucional
        $respuesta_institucional = $request->respuestainstitucional;
        // Obtenemos el objeto dependencia
        $dependencia = $request->dependencia;
        // creamos un nuevo registro de incidente
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
        // Anexamos el incidente, estado, municipio, seguimiento, impacto y el usuario
        $registro_incidente->catalogo_incidente_id = $incidente['id_catalogo_incidente'];
		$registro_incidente->estado_id = $incidente['id_estado'];
		$registro_incidente->municipio_id = $incidente['id_municipio'];
		$registro_incidente->tipo_seguimiento_id = $incidente['tipo_seguimiento'];
		$registro_incidente->tipo_impacto_id = $incidente['nivel_impacto'];
		$registro_incidente->user_id = $request->user()->id;
        // Guardamos
		$registro_incidente->save();
        // Anexamos las relaciones de las localidades afectadas
		$registro_incidente->localidades()->attach($incidente['localidades_afectadas']);
        // Creamos un modelo nuevo de dependencia
		$dependencia = new Dependencia([
			'datos_llamada' => $dependencia['datos_llamada'],
	    	'tiempo_llamada' => $dependencia['tiempo_llamada'],
	    	'tiempo_atencion' => $dependencia['tiempo_atencion'],
	    	'descripcion_llamada' => $dependencia['descripcion_llamada']
		]);
        // Y lo relacionamos al registro
		$registro_incidente->dependencia_llamada()->save($dependencia);

        // Retornamos la respuesta con el incidente
        return response()->json(['incidente'=>$registro_incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','dependencia_llamada'])],201);
    }

    /**
     * Display the specified resource.
     *
     * Ruta GET ../api/incidentes/show/{incidente}
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIncidente(RegistroIncidente $incidente, Request $request)
    {
        //Obtenemos el usuario que realizo la peticion
        $user = $request->user();
        // Obtenemos la institucion del usuario
        $institucion = $user->institucion;
        // variable bandera
        $mostrar = false;
        // Si existe la institucion
        if ($institucion) {
            // Investigamos que tipo de institucion es
            switch ($institucion->tipo_institucion) {
                case "Federal":
                    // Se muestra
                    $mostrar = true;
                    break;

                case "Estatal":
                    $estado_incidente = $incidente->estado;
                    // verificamos que el estado donde se regristro el incidente pertenece a los estados de la institucion
                    $mostrar = $institucion->estados()->where('regionable_id',$estado_incidente->id)->exists();
                    break;
                
                default:
                    $estado_incidente = $incidente->estado;
                    $municipios_id = $institucion->municipios()->pluck('regionable_id');
                    // Verificamos si el estado del municipio corresponde al estado del instituto
                    $mostrar = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->where('id',$estado_incidente->id)->exists();
                    break;
            }
            
        }
        // si la bandera mostrar se activo
        if ($mostrar) {
            // Retornamos la respuesta del incidente con todas sus relaciones
            $incidente_resp = $incidente->load(['catalogo_incidente','catalogo_incidente.prioridad','catalogo_incidente.subcategoria','catalogo_incidente.subcategoria.categoria','estado','municipio','impacto','seguimiento','user','localidades','incidente_siguiente','incidente_previo','dependencia_llamada','dependencia_reportes']);
            // Retornamos un json con la respuesta
            return response()->json(['incidente'=>$incidente_resp],200);
        }
        else{
            // Retornamos un json nulo
            return response()->json(['error'=>['mensaje'=>'No se puede mostrar el incidente porque no corresponde a tu region']],422);
        }
    }

    /**
     * Created a new reporte dependencia for registro_incidente.
     *
     * Ruta POST ../api/incidentes/repote_dependencia
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reporteDependencia(Request $request)
    {
        // Creamos reglas de validacion
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
        // Validamos el request con las reglas que creamos
        $request->validate($rules);
        // obtenemos el id del incidente
        $incidente_id = $request->incidente['id'];
        // Obtenemos el param del repote
        $reporte_params = $request->incidente['reporte_dependencias'];
        // Obtenemos el incidente con el id
        $registro_incidente = RegistroIncidente::find($request->incidente['id']);
        // Creamos un nuevo modelo con el reporte de dependencia
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
        // Y lo guardamos en la relacion con el incidente
        $registro_incidente->dependencia_reportes()->save($reporte_dependencia);
        // Retornamos una respuesta json con el reporte de la dependencia con su incidente
        return response()->json(['reporte_dependencia'=>$reporte_dependencia->load('registro_incidente')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * Ruta POST ../api/incidentes/update/{incidente}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIncidente(Request $request,RegistroIncidente $incidente)
    {
        // creamos las reglas de validacion
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
        // Validamos el request con las reglas de validacion
        $request->validate($rules);
        // obtenemos los parametros del nuevo incidente
        $incidente_param = $request->incidente;
        // obtenemos los parametros de la respuesta institucional
        $respuesta_institucional = $request->respuestainstitucional;
        // Obtenemos los parametros de la dependencia
        $dependencia = $request->dependencia;

        // creamos un nuevo modelo registro de incidente
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
        // agregamos las relaciones con catalgo de incidente, estado, municipio,tipo seguimiento,tipo impacto,user y registro del incidente previo
        $new_incidente->catalogo_incidente_id = $incidente->catalogo_incidente->id;
        $new_incidente->estado_id = $incidente->estado->id;
        $new_incidente->municipio_id = $incidente->municipio->id;
        $new_incidente->tipo_seguimiento_id = $incidente_param['tipo_seguimiento'];
        $new_incidente->tipo_impacto_id = $incidente_param['nivel_impacto'];
        $new_incidente->user_id = $request->user()->id;
        $new_incidente->registro_incidente_id = $incidente->id;
        // Guardamos el nuevo incidente
        $new_incidente->save();
        // relacionamos las localidades afectadas
        $new_incidente->localidades()->attach($incidente_param['localidades_afectadas']);
        // Creamos un nuevo modelo para llamada de la dependencia
        $dependencia = new Dependencia([
            'datos_llamada' => $dependencia['datos_llamada'],
            'tiempo_llamada' => $dependencia['tiempo_llamada'],
            'tiempo_atencion' => $dependencia['tiempo_atencion'],
            'descripcion_llamada' => $dependencia['descripcion_llamada']
        ]);
        // Y guardamos su relacion en el modelo
        $new_incidente->dependencia_llamada()->save($dependencia);
        // Retornamos una respuesta json con el nuevo incidente y sus relaciones
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
