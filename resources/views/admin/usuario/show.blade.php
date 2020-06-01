@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo (Agregar titulo de pestaña) --}}
@include('admin.usuario.menu', ['titulo' => $usuario->full_name." / ".$usuario->institucion->nombre])

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;">
				<h4 style="font-size: 20px;font-weight: bold;">Usuario {{ $usuario->full_name }} | Institución: {{ $usuario->institucion->nombre }}</h4>
				
			</label>
			<div class="align-self-center">
				<form action="{{ route('admin.usuarios.destroy',['usuario'=>$usuario]) }}" method="POST">
					<a href="{{ route('admin.usuarios.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<a href="{{ route('admin.usuarios.edit',['usuario'=>$usuario]) }}" class="btn boton1 m-2" style="background-color: #da291c !important; color: #f5f5f5;">Actualizar</a>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Eliminar</button>
				</form>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="{{ route('admin.usuarios.index') }}" style="color: white;"  class="">Incidentes</a></li>
		  	<li ><a  href="{{ route('admin.usuarios.show',['usuario'=>$usuario]) }}"  style="color: white;" class="activo" >Información del Usuario </a></li>
		</ul>
	</div>
	<div class="panel-body pb-3">
		<div class="row form-group">
			<div class="col-12 col-md-3">
				<p class="label">
					Nombre(s)
				</p>
				<p class="info">
					{{$usuario->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Apellido Paterno
				</p>
				<p class="info">
					{{$usuario->apellido_paterno}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Apellido Materno
				</p>
				<p class="info">
					{{$usuario->apellido_materno}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Email
				</p>
				<p class="info">
					{{$usuario->email}}
				</p>
			</div>
		</div>
		<div id="accordion" class="row form-group">
			@if ($usuario->institucion)
				<div class="col-12 mt-2">
					<h4 class="text-center">
						{{$usuario->institucion->tipo_institucion." / ".$usuario->institucion->nombre}}

					</h4>
				</div>
				@if ($usuario->institucion->municipios->isNotEmpty())
					<div class="col-12 mt-2">
						<h4 class="text-center">
							MUNICIPIOS
						</h4>
					</div>
					@foreach ($usuario->institucion->municipios as $municipio)
						<div class="col-12 col-md-4 mt-2 mb-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_municipio_{{$municipio->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_municipio_{{$municipio->id}}" aria-expanded="true" aria-controls="collapse_municipio_{{$municipio->id}}">
											{{$municipio->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_municipio_{{$municipio->id}}" aria-labelledby="heading_municipio_{{$municipio->id}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											<li>
												{{$municipio->nombre}}
											</li>
											<ul>
												@foreach ($municipio->localidads as $localidad)
													<li>
														{{$localidad->nombre}}
													</li>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="col-12 mt-2">
						<h4 class="text-center">
							ESTADOS
						</h4>
					</div>
					@foreach ($usuario->institucion->estados as $estado)
						<div class="col-12 col-md-3 mt-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_estado_{{$estado->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_estado_{{$estado->id}}" aria-expanded="true" aria-controls="collapse_estado_{{$estado->id}}">
											{{$estado->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_estado_{{$estado->id}}" aria-labelledby="heading_estado_{{$estado->id}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											<li>
												{{$estado->nombre}}
											</li>
											<ul>
												@foreach ($estado->municipios as $municipio)
													<li>
														{{$municipio->nombre}}
													</li>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if ($usuario->institucion->categorias_incidente->isNotEmpty())
					<div class="col-12 mt-2">
						<h4 class="text-center">
							CATALOGO NACIONAL DE INCIDENTES
						</h4>
					</div>
					@foreach ($usuario->institucion->categorias_incidente as $categoria)
						<div class="col-12 col-md-3 mt-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_categoria_{{$categoria->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_categoria_{{$categoria->id}}" aria-expanded="true" aria-controls="collapse_categoria_{{$categoria->id}}">
											{{$categoria->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_categoria_{{$categoria->id}}" aria-labelledby="heading_categoria_{{$categoria->id}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											<li>
												{{$categoria->nombre}}
											</li>
											<ul>
												@foreach ($categoria->subcategorias as $subcategoria)
													<li>
														{{$subcategoria->nombre}}
													</li>
													<ul>
														@foreach ($subcategoria->catalogos as $catalogo)
															<li>
																{{$catalogo->nombre}}
															</li>
														@endforeach
													</ul>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			@endif
		</div>
	</div>
@endsection
