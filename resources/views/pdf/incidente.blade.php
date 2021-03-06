@extends('layouts.pdf')
@section('content')
{{-- PRIMERA CARTA, DETALLES DEL INCIDENTE --}}
<div class="page">
	<div class="card  w-100 {{ 
				$incidente->impacto->nombre == 'Alto' ? 'border-danger' : (
					$incidente->impacto->nombre == 'Medio' ? 'border-warning' :
						'border-success')}}">
		<div class="card-header row {{ 
				$incidente->impacto->nombre == 'Alto' ? 'bg-danger text-white' : (
					$incidente->impacto->nombre == 'Medio' ? 'bg-warning text-dark' :
						'bg-success text-white')}}">
			<h3 class="col-10">{{$incidente->catalogo_incidente ? $incidente->catalogo_incidente->clave." ".$incidente->catalogo_incidente->nombre : "N/A"}} / Detalles del Incidente</h3>
			<span class="col-2 badge badge-pill badge-secondary">{{$incidente->fecha_ocurrencia." ".$incidente->hora_ocurrencia}}</span>
		</div>
		<div class="card-body">
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Tipo de incidente
					</label>
					<li class="list-group-item">
						{{ $incidente->catalogo_incidente ? $incidente->catalogo_incidente->clave.' / '.$incidente->catalogo_incidente->nombre : "N/A" }}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Estado
					</label>
					<li class="list-group-item">
						{{$incidente->estado->nombre}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Municipio
					</label>
					<li class="list-group-item">
						{{$incidente->municipio ? $incidente->municipio->nombre : 'N/A'}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-12">
					<label class="text-right col-form-label-sm">
						Descripción del incidente
					</label>
					<li class="list-group-item">
						{{$incidente->descripcion}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-12">
					<label class="text-right col-form-label-sm">
						Dirección
					</label>
					<li class="list-group-item">
						{{$incidente->locacion ? $incidente->locacion : "N/A"}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-6">
					<label  class="text-right col-form-label-sm">
						Latitud especifica
					</label>
					<li class="list-group-item">
						{{$incidente->lat_especifica}}
					</li>
				</div>
				<div class="col-6">
					<label  class="text-right col-form-label-sm">
						Longitud especifica
					</label>
					<li class="list-group-item">
						{{$incidente->long_especifica}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-12">
					<label class="text-right col-form-label-sm">
						Localidades afectadas
					</label>
					<ul class="list-group">
						<li class="list-group-item">
							@forelse ($incidente->localidades as $localidad)
								@if ($loop->first)
							        {{$localidad->nombre}}
							    @elseif($loop->last)
							    	y {{$localidad->nombre}}.
							    @else
									, {{$localidad->nombre}}
							    @endif
							@empty
								Sin Localidades
							@endforelse
						</li>
					</ul>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-12">
					<label class="text-right col-form-label-sm">
						Otros lugares afectados
					</label>
					<ul class="list-group">
						
						<li class="list-group-item">
							{{$incidente->lugares_afectados ? $incidente->lugares_afectados : 'N/A'}}
						</li>
						
					</ul>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-6">
					<img alt='static Mapbox map of the San Francisco bay area' src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s-l+000({{$incidente->long_especifica}},{{$incidente->lat_especifica}})/{{$incidente->long_especifica}},{{$incidente->lat_especifica}},14/400x300?access_token=pk.eyJ1IjoiaXZhbnJvam8wNyIsImEiOiJja2Y4dGw5YzAwMDhtMzVwbDA5dXhweXZ4In0.wA_k1F9j5gtYM6fTwA0tnA" >
					{{-- <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$incidente->lat_especifica}},{{$incidente->long_especifica}}&maptype=hybrid&zoom=18&size=350x250&markers=size:large|color:red|{{$incidente->lat_especifica}},{{$incidente->long_especifica}}&key={{env('STATIC_MAPS_KEY')}}"> --}}
				</div>
				<div class="col-6">
					<div class="form-group row">
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Fecha de ocurrencia
							</label>
							<li class="list-group-item">
								{{$incidente->fecha_ocurrencia}}
							</li>
						</div>
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Hora de ocurrencia
							</label>
							<li class="list-group-item">
								{{$incidente->hora_ocurrencia}}
							</li>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Fecha de registro
							</label>
							<li class="list-group-item">
								{{$incidente->fecha_registro}}
							</li>
						</div>
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Hora de registro
							</label>
							<li class="list-group-item">
								{{$incidente->hora_registro}}
							</li>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Afectación vial
							</label>
							<li class="list-group-item">
								{{$incidente->afectacion_vial ? $incidente->afectacion_vial : 'N/A'}}
							</li>
						</div>
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Personas afectadas
							</label>
							<li class="list-group-item">
								{{$incidente->personas_afectadas}}
							</li>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Infraestructura afectada
							</label>
							<li class="list-group-item">
								{{$incidente->afectacion_infraestructural ? $incidente->afectacion_infraestructural : 'N/A'}}
							</li>
						</div>
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Personas lesionadas
							</label>
							<li class="list-group-item">
								{{$incidente->personas_lesionadas}}
							</li>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Daños colaterales
							</label>
							<li class="list-group-item">
								{{$incidente->danio_colateral ? $incidente->danio_colateral : 'N/A'}}
							</li>
						</div>
						<div class="col-6">
							<label class="text-right col-form-label-sm">
								Personas fallecidas
							</label>
							<li class="list-group-item">
								{{$incidente->personas_fallecidas}}
							</li>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Estatus del incidente
					</label>
					<li class="list-group-item">
						{{$incidente->estatus ? 'Activo' : 'Inactivo'}}
					</li>
				</div>
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Personas Desaparecidas
					</label>
					<li class="list-group-item">
						{{$incidente->personas_desaparecidas}}
					</li>
				</div>
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Tipo de seguimiento
					</label>
					<li class="list-group-item">
						{{$incidente->seguimiento->nombre}}
					</li>
				</div>
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Personas evacuadas
					</label>
					<li class="list-group-item">
						{{$incidente->personas_evacuadas}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Nivel de impacto
					</label>
					<li class="list-group-item">
						{{$incidente->impacto->nombre}}
					</li>
				</div>
				<div class="col-3">
					<label class="text-right col-form-label-sm">
						Medidas de control
					</label>
					<li class="list-group-item">
						{{$incidente->medidas_control}}
					</li>
				</div>
				<div class="col-6">
					<h5 class="text-muted text-center">
						Respuesta Institucional
					</h5>
					<label class="text-right mt-2 col-form-label-sm">
						Dependencia encargada
					</label>
					<li class="list-group-item">
						{{$incidente->dependencia}}
					</li>
					<label class="text-right mt-2 col-form-label-sm">
						Nombre del empleado
					</label>
					<li class="list-group-item">
						{{$incidente->nombre_empleado}}
					</li>
					<label class="text-right mt-2 col-form-label-sm">
						Cargo del empleado
					</label>
					<li class="list-group-item">
						{{$incidente->cargo_empleado}}
					</li>
				</div>
			</div>
		</div>
		<div class="card-footer text-muted">
			<div class="d-flex justify-content-between">
				<p>{{Date('Y-m-d')}}</p>
				<p>{{ $institucion ? $institucion->nombre : "Claro 360."}}</p>
				<p>Descargado por: {{Auth::user()->nombre}}</p>
			</div>
		</div>
	</div>
</div>	

{{-- SI EXISTE INFORMACIÓN DE LLAMADA DE DEPENDENCIA --}}
	@if ($dependencia)
		<div class="page">
			@include('pdf.llamada_dependencia', [
				'incidente'=>$incidente,
				'dependencia' => $dependencia
				])	
		</div>
	@endif

{{-- SI EXISTE REPORTES DE LA DEPENDENCIA --}}
	@if ($reportes->isNotEmpty())
		<div class="page">
			@include('pdf.reportes_dependencia', [
				'incidente' => $incidente,
				'reportes' => $reportes
				])
		</div>
	@endif

@endsection