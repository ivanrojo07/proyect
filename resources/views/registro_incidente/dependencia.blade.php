@if ($dependencia)
	<div class="card bg-secondary">
		<div class="card-header bg-dark" id="dependencia" data-toggle="collapse" data-target="#collapseDependencia" aria-expanded="false" aria-controls="collapseDependencia">
			<h5 class="mb-0">
				<button class="btn btn-link text-white collapsed" data-toggle="collapse" data-target="#collapseDependencia" aria-expanded="false" aria-controls="collapseDependencia">
					Dependencia
					<span class="glbl2 glbl glbl-down"></span>
				</button>
			</h5>
		</div>
		<div class="collapse" id="collapseDependencia" aria-labelledby="dependencia" data-parent="#accordion">
			<div class="card-body">
				<div class="text-center">
					<h3>Datos de llamada</h3>
				</div>
				<div class="form-group row">
					@if ($dependencia->datos_llamada)
						@forelse ($dependencia->datos_llamada as $key=>$element)

							<div class="col-12 col-md-4 mt-2">
								<label class="label">
									{{ucfirst(str_replace('_', ' ', $key))}}
								</label>
								<p class="info">
									{{is_array($element) ? json_encode($element) : $element}}
								</p>
							</div>
						@empty
						    <div class="container text-center label">
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
					<h3>Tiempo de llamada</h3>
				</div>
				<div class="form-group row">
					@if ($dependencia->tiempo_llamada)
						@forelse ($dependencia->tiempo_llamada as $key=>$element)
							<div class="col-12 col-md-4">
								<label class="label">
									{{ucfirst(str_replace('_', ' ', $key))}}
								</label>
								<p class="info">
									{{is_array($element) ? json_encode($element) : $element}}
								</p>
							</div>
						@empty
							<div class="container text-center">
								<h5>Sin información</h5>
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
					<h3>Tiempo Atención</h3>
				</div>
				<div class="form-group row">
					@if ($dependencia->tiempo_atencion)
						@forelse ($dependencia->tiempo_atencion as $key=>$element)
							<div class="col-12 col-md-4">
								<label class="label">
									{{ucfirst(str_replace('_', ' ', $key))}}
								</label>
								<p class="info">
									{{is_array($element) ? json_encode($element) : $element}}
								</p>
							</div>
						@empty
							<div class="container text-center label">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center label">
							<h4>Sin información</h4>
						</div>
					@endif
				</div>
				<hr>
				<div class="text-center">
					<h3>Descripción de la llamada</h3>
				</div>
				<div class="form-group row">
					@if ($dependencia->descripcion_llamada)
						@forelse ($dependencia->descripcion_llamada as $key=>$element)
							<div class="col-12 col-md-4">
								<label class="label">
									{{ucfirst(str_replace('_', ' ', $key))}}
								</label>
								<p class="info">
									{{is_array($element) ? json_encode($element) : $element}}
								</p>
							</div>
						@empty
							<div class="container text-center label">
								<h4>Sin información</h4>
							</div>
						@endforelse
					@else
						<div class="container text-center label">
							<h4>Sin información</h4>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endif