@if ($dependencia)
	<div class="card bg-secondary">
		<div class="card-header bg-dark" id="dependencia">
			<h5 class="mb-0">
				<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseDependencia" aria-expanded="false" aria-controls="collapseDependencia">
					Dependencia
				</button>
			</h5>
		</div>
		<div class="collapse" id="collapseDependencia" aria-labelledby="dependencia" data-parent="#accordion">
			<div class="card-body">
				<div class="text-center">
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
						    <div class="container text-center">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center">
							<h5>Sin información</h5>
						</div>
					@endif
				</div>
				<hr>
				<div class="text-center">
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
							<div class="container text-center">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center">
							<h5>Sin información</h5>
						</div>
					@endif
				</div>
				<hr>
				<div class="text-center">
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
							<div class="container text-center">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center">
							<h5>Sin información</h5>
						</div>
					@endif
				</div>
				<hr>
				<div class="text-center">
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
							<div class="container text-center">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center">
							<h5>Sin información</h5>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endif