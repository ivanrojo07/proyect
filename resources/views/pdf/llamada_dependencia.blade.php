{{-- CARD PARA MOSTRAR INFORMACIóN DE LA LLAMADA DEPENDENCIA --}}
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
		<h3 class="col-10">{{$incidente->catalogo_incidente ? $incidente->catalogo_incidente->clave." ".$incidente->catalogo_incidente->nombre : "N/A"}} / Llamada</h3>
		<span class="col-2 badge badge-pill badge-secondary">{{$incidente->fecha_ocurrencia." ".$incidente->hora_ocurrencia}}</span>
	</div>
	<div class="card-body">
		<div class="text-muted text-center">
			<h4>Datos de llamada</h4>
		</div>
		<div class="form-group row">
			@if ($dependencia->datos_llamada)
					@php
						$contador = 0;//Iniciando variable
					@endphp
					@forelse ($dependencia->datos_llamada as $key=>$element)
						{{-- Pintar el json que se guardo --}}
						@php
							$contador+=1
						@endphp
						<div class="col-4">
							<label class="text-right col-form-label-sm">
								{{ucfirst(str_replace('_',' ',$key))}}
							</label>
							<li class="list-group-item">
								{{$element ? $element : 'N/A'}}
							</li>
						</div>
						@if ($contador%3 == 0)
						{{-- cerramos el div con formgroup y abrimos uno nuevo --}}
		</div>
		<div class="form-group row">
						@endif

					@empty
						<div class="container text-muted text-center">
							<h5>Sin información</h5>
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
			<h4>
				Tiempo de llamada
			</h4>
		</div>
		<div class="form-group row">
			@if ($dependencia->tiempo_llamada)
				@php
					$contador = 0;//Iniciando variable
				@endphp
				@forelse ($dependencia->tiempo_llamada as $key=>$element)
					{{-- Pintar el json que se guardo --}}
					@php
						$contador+=1
					@endphp
					<div class="col-4">
						<label class="text-right col-form-label-sm">
							{{ucfirst(str_replace('_',' ',$key))}}
						</label>
						<li class="list-group-item">
							{{$element ? $element : 'N/A'}}
						</li>
					</div>
					@if ($contador%3 == 0)
					{{-- cerramos el div con formgroup y abrimos uno nuevo --}}
		</div>
		<div class="form-group row">
					@endif

				@empty
					<div class="container text-muted text-center">
						<h5>Sin información</h5>
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
			<h4>
				Tiempo Atención
			</h4>
		</div>
		<div class="form-group row">
			@if ($dependencia->tiempo_atencion)
				@php
					$contador = 0;//Iniciando variable
				@endphp
				@forelse ($dependencia->tiempo_atencion as $key=>$element)
					{{-- Pintar el json que se guardo --}}
					@php
						$contador+=1
					@endphp
					<div class="col-4">
						<label class="text-right col-form-label-sm">
							{{ucfirst(str_replace('_',' ',$key))}}
						</label>
						<li class="list-group-item">
							{{$element ? $element : 'N/A'}}
						</li>
					</div>
					@if ($contador%3 == 0)
					{{-- cerramos el div con formgroup y abrimos uno nuevo --}}
		</div>
		<div class="form-group row">
					@endif

				@empty
					<div class="container text-muted text-center">
						<h5>Sin información</h5>
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
			<h4>
				Descripción de la llamada
			</h4>
		</div>
		<div class="form-group row">
			@if ($dependencia->descripcion_llamada)
				@php
					$contador = 0;//Iniciando variable
				@endphp
				@forelse ($dependencia->descripcion_llamada as $key=>$element)
					{{-- Pintar el json que se guardo --}}
					@php
						$contador+=1
					@endphp
					<div class="col-4">
						<label class="text-right col-form-label-sm">
							{{ucfirst(str_replace('_',' ',$key))}}
						</label>
						<li class="list-group-item">
							{{$element ? $element : 'N/A'}}
						</li>
					</div>
					@if ($contador%3 == 0)
					{{-- cerramos el div con formgroup y abrimos uno nuevo --}}
		</div>
		<div class="form-group row">
					@endif

				@empty
					<div class="container text-muted text-center">
						<h5>Sin información</h5>
					</div>
				@endforelse
			@else
				<div class="container text-muted text-center">
					<h5>Sin información</h5>
				</div>
			@endif
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