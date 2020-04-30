@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header {{ 
				$incidente->impacto->nombre == 'Alto' ? 'bg-danger text-white' : (
					$incidente->impacto->nombre == 'Medio' ? 'bg-warning text-dark' :
						'bg-success text-white')}}">
						<div class="d-flex justify-content-between">
							<a class="btn btn-outline-dark font-weight-bold {{ $incidente->incidente_previo ? '' : 'disabled' }}" href="{{ $incidente->incidente_previo ? route('incidente.show',['incidente'=>$incidente->incidente_previo]) : '#' }}">Incidente Anterior</a>
							<h4 class="m-auto">
								Incidente <span class="badge">{{$incidente->impacto->nombre}}</span>
							</h4>
							<a class="btn btn-outline-dark font-weight-bold {{ $incidente->incidente_siguiente ? '' : 'disabled' }}" href="{{ $incidente->incidente_siguiente ? route('incidente.show',['incidente'=>$incidente->incidente_siguiente]) : '#' }}">Incidente Siguiente</a>
						</div>

				
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-12 col-md-4">
						<label for="subcategoria" class="text-md-right col-form-label-sm">
							Tipo de incidente
						</label>
						<input class="form-control" readonly="" value="{{$incidente->catalogo_incidente->clave.' / '.$incidente->catalogo_incidente->nombre}}">
					</div>
					<div class="col-12 col-md-4">
						<label for="estado" class="text-md-right col-form-label-sm">
							Estado
						</label>
						<input class="form-control" readonly="" value="{{$incidente->estado->nombre}}">
					</div>
					<div class="col-12 col-md-4">
						<label for="municipio" class="text-md-right col-form-label-sm">
							Municipio
						</label>
						<input class="form-control" readonly="" value="{{($incidente->municipio ? $incidente->municipio->nombre : 'N/A')}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-12 col-md-6">
						<label for="descripcion" class="text-md-right col-form-label-sm">
							Descripción del Incidente
						</label>
						<textarea class="form-control" readonly="" rows="5">{{$incidente->descripcion}}</textarea>
						<label for="locacion" class="text-md-right col-form-label-sm">
							Dirección
						</label>
						<textarea class="form-control" rows="3" readonly="">{{$incidente->locacion}}</textarea>
						<div class="row">
							<div class="col-6">
								<label for="latitud" class="text-md-right col-form-label-sm">
									Latitud
								</label>
								<input class="form-control" readonly="" value="{{$incidente->lat_especifica}}">
							</div>
							<div class="col-6">
								<label for="longitud" class="text-md-right col-form-label-sm">
									Longitud
								</label>
								<input class="form-control" readonly="" value="{{$incidente->long_especifica}}">
							</div>

							<div class="col-6">
								<label for="localidades_afectadas" class="text-md-right col-form-label-sm">Localidades afectadas</label>
								<ul class="list-group">
									@forelse ($incidente->localidades as $localidad)
										<li class="list-group-item">{{$localidad->nombre}}</li>
									@empty
										<li class="list-group-item">Sin Localidades</li>
									@endforelse
								</ul>
							</div>
							<div class="col-6">
								<label for="lugares afectados" class="text-md-right col-form-label-sm">Lugares afectados</label>
								<textarea class="form-control" readonly="">{{$incidente->lugares_afectados ? $incidente->lugares_afectados : 'N/A'}}</textarea>
							</div>
							<div class="mt-5" id="map"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="fecha" class="text-md-right col-form-label-sm">
									Fecha de Ocurrencia
								</label>
								<input class="form-control" readonly="" value="{{$incidente->fecha_ocurrencia}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="hora" class="text-md-right col-form-label-sm">
									Hora de Ocurrencia
								</label>
								<input class="form-control" readonly="" value="{{$incidente->hora_ocurrencia}}">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-12 col-md-6">
								<label for="afectacion_vial" class="text-md-right col-form-label-sm">
									Afectación Vial
								</label>
								<input class="form-control" value="{{$incidente->afectacion_vial ? $incidente->afectacion_vial : 'N/A'}}" readonly="">
							</div>
							<div class="col-12 col-md-6">
								<label for="personas_afectadas" class="text-md-right col-form-label-sm">
									Personas Afectadas
								</label>
								<input class="form-control" value="{{$incidente->personas_afectadas}}" readonly="">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="infraestructura" class="text-md-right col-form-label-sm">
									Infraestructura Afectada
								</label>
								<input class="form-control" readonly="" value="{{$incidente->afectacion_infraestructural ? $incidente->afectacion_infraestructural : 'N/A'}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="personas_lesionadas" class="text-md-right col-form-label-sm">
									Personas Lesionadas
								</label>
								<input class="form-control" readonly="" value="{{$incidente->personas_lesionadas}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="danos_colaterales" class="text-md-right col-form-label-sm">
									Daños Colaterales
								</label>
								<input class="form-control" readonly="" value="{{$incidente->danio_colateral ? $incidente->danio_colateral : 'N/A'}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="personas_fallecidas" class="text-md-right col-form-label-sm">
									Personas Fallecidas
								</label>
								<input class="form-control" readonly="" value="{{$incidente->personas_fallecidas}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="estatus_incidente" class="text-md-right col-form-label-sm">
									Estatus del Incidente
								</label>
								<input class="form-control" value="{{$incidente->estatus ? 'Activo':'Inactivo'}}" readonly="">
							</div>
							<div class="col-12 col-md-6">
								<label for="personas_desaparecidas" class="text-md-right col-form-label-sm">
									Personas Desaparecidas
								</label>
								<input class="form-control" readonly="" value="{{$incidente->personas_desaparecidas}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="tipo_seguimiento" class="text-md-right col-form-label-sm">
									Tipo de Seguimiento
								</label>
								<input class="form-control" readonly="" value="{{$incidente->seguimiento->nombre}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="personas_evacuadas" class="text-md-right col-form-label-sm">
									Personas Evacuadas
								</label>
								<input class="form-control" readonly="" value="{{$incidente->personas_evacuadas}}">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<label for="nivel_impacto" class="text-md-right col-form-label-sm">
									Nivel de Impacto
								</label>
								<input class="form-control" readonly="" value="{{$incidente->impacto->nombre}}">
								<label for="medida_contro" class="text-md-right col-form-label-sm">
									Medidas de Control
								</label>
								<textarea class="form-control" readonly="" rows="4">{{$incidente->medidas_control}}</textarea>

							</div>
							<div class="col-12 col-md-6">
								<label for="dependencia" class="text-md-right col-form-label-sm">Respuesta Institucional</label>
								<input class="form-control" readonly="" value="{{$incidente->dependencia}}">
								<label for="Nombre" class="text-md-right col-form-label-sm">
									Nombre del empleado
								</label>
								<input class="form-control" readonly="" value="{{$incidente->nombre_empleado}}">
								<label for="cargo" class="text-md-right col-form-label-sm">
									Cargo del empleado
								</label>
								<input class="form-control" readonly="" value="{{$incidente->cargo_empleado}}">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="accordion">
				@if ($dependencia)

					<div class="card">
						<div class="card-header" id="dependencia">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseDependencia" aria-expanded="false" aria-controls="collapseDependencia">
									Dependencia
								</button>
							</h5>
						</div>
						<div class="collapse" id="collapseDependencia" aria-labelledby="dependencia" data-parent="#accordion">
							<div class="card-body">
								<div class="text-muted text-center">
									<h4>Datos de llamada</h4>
								</div>
								<div class="form-group row">
									@if ($dependencia->datos_llamada)
										@forelse ($dependencia->datos_llamada as $key=>$element)

											<div class="col-12 col-md-4 mt-2">
												<label for="subcategoria" class="text-md-right col-form-label-sm">
													{{ucfirst(str_replace('_', ' ', $key))}}
												</label>
												<input class="form-control" readonly="" value="{{is_array($element) ? json_encode($element) : $element}}">
											</div>
										@empty
										    <div class="container text-muted text-center">
												<h4>Sin información</h4>
											</div>
										@endforelse
									@else
										<div class="container text-muted text-center">
											<h5>Sin información</h5>
										</div>
									@endif
								</div>
								<hr>
								<div class="text-muted text-center">
									<h4>Tiempo de llamada</h4>
								</div>
								<div class="form-group row">
									@if ($dependencia->tiempo_llamada)
										@forelse ($dependencia->tiempo_llamada as $key=>$element)
											<div class="col-12 col-md-4">
												<label for="subcategoria" class="text-md-right col-form-label-sm">
													{{ucfirst(str_replace('_', ' ', $key))}}
												</label>
												<input class="form-control" readonly="" value="{{is_array($element) ? json_encode($element) : $element}}">
											</div>
										@empty
											<div class="container text-muted text-center">
												<h4>Sin información</h4>
											</div>
										@endforelse
									@else
										<div class="container text-muted text-center">
											<h5>Sin información</h5>
										</div>
									@endif
								</div>
								<hr>
								<div class="text-muted text-center">
									<h4>Tiempo Atención</h4>
								</div>
								<div class="form-group row">
									@if ($dependencia->tiempo_atencion)
										@forelse ($dependencia->tiempo_atencion as $key=>$element)
											<div class="col-12 col-md-4">
												<label for="subcategoria" class="text-md-right col-form-label-sm">
													{{ucfirst(str_replace('_', ' ', $key))}}
												</label>
												<input class="form-control" readonly="" value="{{is_array($element) ? json_encode($element) : $element}}">
											</div>
										@empty
											<div class="container text-muted text-center">
												<h4>Sin información</h4>
											</div>
										@endforelse
									@else
										<div class="container text-muted text-center">
											<h5>Sin información</h5>
										</div>
									@endif
								</div>
								<hr>
								<div class="text-muted text-center">
									<h4>Descripción de la llamada</h4>
								</div>
								<div class="form-group row">
									@if ($dependencia->descripcion_llamada)
										@forelse ($dependencia->descripcion_llamada as $key=>$element)
											<div class="col-12 col-md-4">
												<label for="subcategoria" class="text-md-right col-form-label-sm">
													{{ucfirst(str_replace('_', ' ', $key))}}
												</label>
												<input class="form-control" readonly="" value="{{is_array($element) ? json_encode($element) : $element}}">
											</div>
										@empty
											<div class="container text-muted text-center">
												<h4>Sin información</h4>
											</div>
										@endforelse
									@else
										<div class="container text-muted text-center">
											<h5>Sin información</h5>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					
				@endif

				@if ($reportes->isNotEmpty())
					<div class="card">
						<div class="card-header" id="reportesDependencia">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseReporteDependencia" aria-expanded="false" aria-controls="collapseReporteDependencia">
									Reportes dependencia
								</button>
							</h5>
						</div>
						<div class="collapse" id="collapseReporteDependencia" aria-labelledby="reportesDependencia" data-parent="#accordion">
							<div class="card-body">
								@foreach ($reportes as $index=>$reporte)
									<div class="text-muted text-center">
										<h5>Reporte {{$index+1}}</h5>
									</div>
									<div class="for-group row">
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												ZP
											</label>
											<input class="form-control" readonly="" value="{{$reporte->zp}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Sector
											</label>
											<input class="form-control" readonly="" value="{{$reporte->sector}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Cuadrante
											</label>
											<input class="form-control" readonly="" value="{{$reporte->cuadrante}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Hora de lectura
											</label>
											<input class="form-control" readonly="" value="{{$reporte->h_lectura}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Motivo
											</label>
											<input class="form-control" readonly="" value="{{$reporte->motivo}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Observaciones
											</label>
											<textarea class="form-control" readonly="">{{$reporte->observacion}}</textarea>
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Fecha de transmisión
											</label>
											<input class="form-control" readonly="" value="{{$reporte->f_transmision}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Atención 
											</label>
											<input class="form-control" readonly="" value="{{$reporte->atencion}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Razonamiento 
											</label>
											<input class="form-control" readonly="" value="{{$reporte->razonamiento}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Fecha de razonamiento 
											</label>
											<input class="form-control" readonly="" value="{{$reporte->f_razonamiento}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Observaciones de no atención 
											</label>
											<textarea class="form-control" readonly="">{{$reporte->razonamiento}}</textarea>
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Encargado 
											</label>
											<input class="form-control" readonly="" value="{{$reporte->nombre_encargado}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Razón de no atención 
											</label>
											<input class="form-control" readonly="" value="{{$reporte->razon_noatencion}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Dependencia
											</label>
											<input class="form-control" readonly="" value="{{$reporte->dependencia}}">
										</div>
										<div class="col-12 col-md-4 mt-2">
											<label class="text-md-right col-form-label-sm">
												Folio
											</label>
											<input class="form-control" readonly="" value="{{$reporte->folio}}">
										</div>
									</div>
									<hr>
								@endforeach
							</div>
						</div>
					</div>
				@endif
					
			</div>
			<div class="card-footer">
				<div class="btn-toolbar justify-content-end">
					<div class="btn-group mr-2">
						<a href="{{ route('incidente.edit',['incidente'=>$incidente]) }}" class="btn btn-block btn-info {{ $incidente->incidente_siguiente || $incidente->seguimiento->nombre == 'Final' || $incidente->seguimiento->nombre == 'único' ? 'disabled' : '' }}">Editar</a>
					</div>
					<div class="btn-group mr-2">
						<a target="_blank" href="{{ route('pdf.incidente.show',['incidente'=>$incidente]) }}" class="btn btn-block btn-warning">Descargar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		var map;
		var marker;
		function initMap() {
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: {{$incidente->lat_especifica}}, lng: {{$incidente->long_especifica}} },
	          zoom: 17,
	          mapTypeId: 'hybrid',
	          heading: 90,
    		  tilt: 45
	        });
	        marker = new google.maps.Marker({position: {lat: {{$incidente->lat_especifica}}, lng: {{$incidente->long_especifica}} }, map:map })

      	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAe5gzNGneaWmWLzmZs6bFKNlwdCTr0Odk&callback=initMap"
    ></script>
@endpush