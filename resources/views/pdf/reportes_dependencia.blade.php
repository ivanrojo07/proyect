{{-- CARD PARA MOSTRAR INFORMACIóN DE LOS REPORTES DE LAS DEPENDENCIAS --}}
<div class="card w-100 
	{{ 
				$incidente->impacto->nombre == 'Alto' ? 'border-danger' : (
					$incidente->impacto->nombre == 'Medio' ? 'border-warning' :
						'border-success')
	}}"
>
	<div class="card-header row {{ 
				$incidente->impacto->nombre == 'Alto' ? 'bg-danger text-white' : (
					$incidente->impacto->nombre == 'Medio' ? 'bg-warning text-dark' :
						'bg-success text-white')}}">
		<h3 class="col-10">{{$incidente->catalogo_incidente->clave." ".$incidente->catalogo_incidente->nombre}} / Reportes de las dependencias</h3>
		<span class="col-2 badge badge-pill badge-secondary">{{$incidente->fecha_ocurrencia." ".$incidente->hora_ocurrencia}}</span>
	</div>
	<div class="card-body">
		@foreach ($reportes as $index=>$reporte)
			@if ($index%2 == 0 && $index >0)
				<div class="page"></div>
			@endif
			<div class="text-muted text-center">
				<h5>Reporte {{$index+1}}</h5>
			</div>
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						ZP
					</label>
					<li class="list-group-item">
						{{$reporte->zp}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Sector
					</label>
					<li class="list-group-item">
						{{$reporte->sector}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Cuadrante
					</label>
					<li class="list-group-item">
						{{$reporte->cuadrante}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Hora de lectura
					</label>
					<li class="list-group-item">
						{{$reporte->h_lectura}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Motivo
					</label>
					<li class="list-group-item">
						{{$reporte->motivo}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Observaciones
					</label>
					<li class="list-group-item">
						{{$reporte->observacion}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Fecha de transmisión
					</label>
					<li class="list-group-item">
						{{$reporte->f_transmision}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Atención
					</label>
					<li class="list-group-item">
						{{$reporte->atencion}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Razonamiento
					</label>
					<li class="list-group-item">
						{{$reporte->razonamiento}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Fecha de razonamiento
					</label>
					<li class="list-group-item">
						{{$reporte->f_razonamiento}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Observaciones de no atención
					</label>
					<li class="list-group-item">
						{{$reporte->razonamiento}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Encargado
					</label>
					<li class="list-group-item">
						{{$reporte->nombre_encargado}}
					</li>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Razón de no atención
					</label>
					<li class="list-group-item">
						{{$reporte->razon_noatencion}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-form-label-sm">
						Dependencia
					</label>
					<li class="list-group-item">
						{{$reporte->dependencia}}
					</li>
				</div>
				<div class="col-4">
					<label class="text-right col-from-label-sm">
						Folio
					</label>
					<li class="list-group-item">
						{{$reporte->folio}}
					</li>
				</div>
			</div>
		@endforeach
	</div>
	<div class="card-footer text-muted">
		<div class="d-flex justify-content-between">
			<p>{{Date('Y-m-d')}}</p>
			<p>Claro 360.</p>
			<p>Descargado por: {{Auth::user()->nombre}}</p>
		</div>
	</div>
</div>