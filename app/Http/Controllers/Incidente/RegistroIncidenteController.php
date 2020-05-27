<?php

namespace App\Http\Controllers\Incidente;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Incidente\RegistroIncidente;
use App\Incidente\SubcategoriaIncidente;
use App\Incidente\TipoImpacto;
use App\Incidente\TipoSeguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
		if ($request->fecha) {
			$validate = Validator::make($request->all(),['fecha'=>'required|date|date_format:Y-m-d']);
			if ($validate->fails()) {
				return redirect()->route('incidente.index');
			}
			else{ 
				$date = Date($request->fecha);
			}
		}
		else{
			$date = Date('Y-m-d');
		}
		$institucion = Auth::user()->institucion;
		if ($institucion) {
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->orderBy('hora_ocurrencia','asc')->get();
					break;

				case "Estatal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('hora_ocurrencia','asc')->get();
					break;
				
				default:
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('hora_ocurrencia','asc')->get();
					break;
			}

		}
		else{
			$registro_incidentes = null;

		}
		return view('registro_incidente.index',['registro_incidentes' => $registro_incidentes,'fecha'=>$date,'institucion' => $institucion]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$user = Auth::user();
		$institucion = $user->institucion;
		$municipios_id = null;
		if ($institucion) {
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$estados = Estado::orderBy('nombre','asc')->get();
					break;

				case "Estatal":
					$estados = $institucion->estados()->orderBy('nombre','asc')->get();
					break;
				
				default:
					$municipios_id = $institucion->municipios()->pluck('regionable_id');
					$estados = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->orderBy('nombre','asc')->get();
					break;
			}
			$subcategorias = SubcategoriaIncidente::whereIn('categoria_id',$institucion->categorias_incidente()->pluck('categoria_incidente_id'))->orderBy('id','asc')->get();
		}
		else{
			return redirect()->route('incidente.index');
		}
		// $subcategorias = SubcategoriaIncidente::get();
		$status = [
			[
				'value'=>1,
				'nombre'=>'Activo'
			],

			[
				'value'=>0,
				'nombre'=>'Inactivo'
			]
		];
		$tipo_impacto = TipoImpacto::get();
		$tipo_seguimiento = TipoSeguimiento::get();
		$date = Date('Y-m-d');
		return view('registro_incidente.create',[
			'estados' => $estados,
			'subcategorias' => $subcategorias,
			'municipios_id' => $municipios_id,
			'estatus' => $status,
			'tipo_impacto' => $tipo_impacto,
			'tipo_seguimiento' => $tipo_seguimiento,
			'institucion' => $institucion,
			'fecha' => $date
		]);
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
			'incidente' => 'numeric|required|exists:catalogo_incidentes,id',
			'estado' => 'numeric|required|exists:estados,id',
			'municipio' =>'numeric|required|exists:municipios,id',
			'descripcion' => 'required|string|max:560',
			'locacion'  => 'required|string|max:250',
			'latitud'   => 'required|numeric',
			'longitud'  => 'required|numeric',
			'lugares_afectados' => 'nullable|string|max:200',
			'localidades_afectadas.*' => 'nullable|numeric|exists:localidads,id',
			'fecha' => 'required|date|date_format:Y-m-d',
			'hora'  => 'required|date_format:H:i',
			'afectacion_vial'    => 'nullable|string|max:200',
			'personas_afectadas'  => 'required|numeric|min:0',
			'infraestructura' => 'nullable|string|max:200',
			'personas_lesionadas' => 'required|numeric|min:0',
			'danos_colaterales' => 'nullable|string|max:200',
			'personas_fallecidas' => 'required|numeric|min:0',
			'estatus_incidente' => 'required|boolean',
			'personas_desaparecidas' => 'required|numeric|min:0',
			'tipo_seguimiento'  => 'required|numeric|exists:tipo_seguimientos,id',
			'personas_evacuadas' => 'required|numeric|min:0',
			'nivel_impacto' => 'required|numeric|exists:tipo_impactos,id',
			'dependencia'   => 'required|string|max:200',
			'nombre' => 'required|string|max:200',
			'cargo' => 'required|string|max:200',
			'medida_control' => 'required|string|max:200',

		];
		$request->validate($rules);
		$registro_incidente = new RegistroIncidente([
			'descripcion' => $request->descripcion,
			'locacion' => $request->locacion,
			'lat_especifica' => $request->latitud,
			'long_especifica' => $request->longitud,
			'lugares_afectados' => $request->lugares_afectados,
			'fecha_ocurrencia' => $request->fecha,
			'hora_ocurrencia' => $request->hora,
			'afectacion_vial' => $request->afectacion_vial,
			'afectacion_infraestructural' => $request->infraestructura,
			'danio_colateral' => $request->danos_colaterales,
			'estatus' => $request->estatus_incidente,
			'medidas_control' => $request->medida_control,
			'personas_afectadas' => $request->personas_afectadas,
			'personas_lesionadas' => $request->personas_lesionadas,
			'personas_fallecidas' => $request->personas_fallecidas,
			'personas_desaparecidas' => $request->personas_desaparecidas,
			'personas_evacuadas' => $request->personas_evacuadas,
			'dependencia' => $request->dependencia,
			'nombre_empleado' => $request->nombre,
			'cargo_empleado' =>$request->cargo
		]);
		$registro_incidente->catalogo_incidente_id = $request->incidente;
		$registro_incidente->estado_id = $request->estado;
		$registro_incidente->municipio_id = $request->municipio;
		$registro_incidente->tipo_seguimiento_id = $request->tipo_seguimiento;
		$registro_incidente->tipo_impacto_id = $request->nivel_impacto;
		$registro_incidente->user_id = Auth::user()->id;
		$registro_incidente->save();
		$registro_incidente->localidades()->attach($request->localidades_afectadas);
		return redirect()->route('incidente.index');
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
		$user = Auth::user();
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
		// var_dump($institucion->tipo_institucion);
		if ($mostrar) {
			$dependencia = $incidente->dependencia_llamada;
			$reportes = $incidente->dependencia_reportes;
			return view('registro_incidente.show',[
				'incidente'=>$incidente,
				'dependencia'=>$dependencia,
				'reportes'=>$reportes,
				'institucion' => $institucion
			]);
		}
		else{
			return redirect()->route('incidente.index');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(RegistroIncidente $incidente)
	{
		//
		$user = Auth::user();
		$institucion = $user->institucion;
		$municipios_id = null;
		if ($institucion) {
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$estados = Estado::orderBy('nombre','asc')->get();
					break;

				case "Estatal":
					$estados = $institucion->estados()->orderBy('nombre','asc')->get();
					break;
				
				default:
					$municipios_id = $institucion->municipios()->pluck('regionable_id');
					$estados = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->orderBy('nombre','asc')->get();
					break;
			}
			$subcategorias = SubcategoriaIncidente::whereIn('categoria_id',$institucion->categorias_incidente()->pluck('categoria_incidente_id'))->orderBy('id','asc')->get();
		}
		else{
			return redirect()->route('incidente.index');
		}
		$status = [
			[
				'value'=>true,
				'nombre'=>'Activo'
			],

			[
				'value'=>false,
				'nombre'=>'Inactivo'
			]
		];
		$tipo_impacto = TipoImpacto::get();
		$tipo_seguimiento = TipoSeguimiento::get();

		return view('registro_incidente.edit',[
			'estados' => $estados,
			'subcategorias' => $subcategorias,
			'municipio_id' => $user->id_mun,
			'estatus' => $status,
			'tipo_impacto' => $tipo_impacto,
			'tipo_seguimiento' => $tipo_seguimiento,
			'incidente' => $incidente,
			'institucion' => $institucion
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,RegistroIncidente $incidente)
	{
		// dd($request->all());
		$rules = [
			'descripcion' => 'required|string|max:560',
			'locacion'  => 'required|string|max:250',
			'latitud'   => 'required|numeric',
			'longitud'  => 'required|numeric',
			'lugares_afectados' => 'nullable|string|max:200',
			'localidades_afectadas.*' => 'nullable|numeric|exists:localidads,id',
			'fecha' => 'required|date|date_format:Y-m-d',
			'hora'  => 'required|date_format:H:i',
			'afectacion_vial'    => 'nullable|string|max:200',
			'personas_afectadas'  => 'required|numeric|min:0',
			'infraestructura' => 'nullable|string|max:200',
			'personas_lesionadas' => 'required|numeric|min:0',
			'danos_colaterales' => 'nullable|string|max:200',
			'personas_fallecidas' => 'required|numeric|min:0',
			'estatus_incidente' => 'required|boolean',
			'personas_desaparecidas' => 'required|numeric|min:0',
			'tipo_seguimiento'  => 'required|numeric|exists:tipo_seguimientos,id',
			'personas_evacuadas' => 'required|numeric|min:0',
			'nivel_impacto' => 'required|numeric|exists:tipo_impactos,id',
			'dependencia'   => 'required|string|max:200',
			'nombre' => 'required|string|max:200',
			'cargo' => 'required|string|max:200',
			'medida_control' => 'required|string|max:200',
		];
		$request->validate($rules);
		$nuevo_incidente = new RegistroIncidente([
			'descripcion' => $request->descripcion,
			'locacion' => $request->locacion,
			'lat_especifica' => $request->latitud,
			'long_especifica' => $request->longitud,
			'lugares_afectados' => $request->lugares_afectados,
			'fecha_ocurrencia' => $request->fecha,
			'hora_ocurrencia' => $request->hora,
			'afectacion_vial' => $request->afectacion_vial,
			'afectacion_infraestructural' => $request->infraestructura,
			'danio_colateral' => $request->danos_colaterales,
			'estatus' => $request->estatus_incidente,
			'medidas_control' => $request->medida_control,
			'personas_afectadas' => $request->personas_afectadas,
			'personas_lesionadas' => $request->personas_lesionadas,
			'personas_fallecidas' => $request->personas_fallecidas,
			'personas_desaparecidas' => $request->personas_desaparecidas,
			'personas_evacuadas' => $request->personas_evacuadas,
			'dependencia' => $request->dependencia,
			'nombre_empleado' => $request->nombre,
			'cargo_empleado' =>$request->cargo
		]);
		$nuevo_incidente->catalogo_incidente_id = $incidente->catalogo_incidente->id;
		$nuevo_incidente->estado_id = $incidente->estado->id;
		$nuevo_incidente->municipio_id = $incidente->municipio->id;
		$nuevo_incidente->tipo_seguimiento_id = $request->tipo_seguimiento;
		$nuevo_incidente->tipo_impacto_id = $request->nivel_impacto;
		$nuevo_incidente->user_id = Auth::user()->id;
		$nuevo_incidente->registro_incidente_id = $incidente->id;
		$nuevo_incidente->save();
		$nuevo_incidente->localidades()->attach($request->localidades_afectadas);
		return redirect()->route('incidente.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy($id)
	// {
	// 	//
	// }
}
