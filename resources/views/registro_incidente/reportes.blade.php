@if ($reportes->isNotEmpty())
	<div class="card bg-secondary">
		<div class="card-header bg-dark" id="reportesDependencia">
			<h5 class="mb-0">
				<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseReporteDependencia" aria-expanded="false" aria-controls="collapseReporteDependencia">
					Reportes dependencia
				</button>
			</h5>
		</div>
		<div class="collapse" id="collapseReporteDependencia" aria-labelledby="reportesDependencia" data-parent="#accordion">
			<div class="card-body">
				@foreach ($reportes as $index=>$reporte)
					<div class="text-center mt-5">
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
				@endforeach
			</div>
		</div>
	</div>
@endif