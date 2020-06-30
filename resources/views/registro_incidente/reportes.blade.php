@if ($reportes->isNotEmpty())
	<div class="card bg-secondary">
		<div class="card-header bg-dark" id="reportesDependencia"  data-toggle="collapse" data-target="#collapseReporteDependencia" aria-expanded="false" aria-controls="collapseReporteDependencia">
			<h5 class="mb-0">
				<button class="btn btn-link text-white collapsed" data-toggle="collapse" data-target="#collapseReporteDependencia" aria-expanded="false" aria-controls="collapseReporteDependencia">
					Reportes dependencia
					<span class="glbl2 glbl glbl-down"></span>
				</button>
			</h5>
		</div>
		<div class="collapse" id="collapseReporteDependencia" aria-labelledby="reportesDependencia" data-parent="#accordion">
			<div class="card-body">
				@foreach ($reportes as $index=>$reporte)
					<div class="text-center mt-5">
						<h3>Reporte {{$index+1}}</h3>
					</div>
					<div class="for-group row">
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								ZP
							</label>
							<p class="info">
								{{$reporte->zp}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Sector
							</label>
							<p class="info">
								{{$reporte->sector}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Cuadrante
							</label>
							<p class="info">
								{{$reporte->cuadrante}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Hora de lectura
							</label>
							<p class="info">
								{{$reporte->h_lectura}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Motivo
							</label>
							<p class="info">
								{{$reporte->motivo}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Observaciones
							</label>
							<p class="info">
								{{$reporte->observacion}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Fecha de transmisión
							</label>
							<p class="info">
								{{$reporte->f_transmision}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Atención 
							</label>
							<p class="info">
								{{$reporte->atencion}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Razonamiento 
							</label>
							<p class="info">
								{{$reporte->razonamiento}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Fecha de razonamiento 
							</label>
							<p class="info">
								{{$reporte->f_razonamiento}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Observaciones de no atención 
							</label>
							<p class="info">
								{{$reporte->razonamiento}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Encargado 
							</label>
							<p class="info">
								{{$reporte->nombre_encargado}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Razón de no atención 
							</label>
							<p class="info">
								{{$reporte->razon_noatencion}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Dependencia
							</label>
							<p class="info">
								{{$reporte->dependencia}}
							</p>
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label class="label">
								Folio
							</label>
							<p class="info">
								{{$reporte->folio}}
							</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif