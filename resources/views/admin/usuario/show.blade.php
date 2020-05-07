@extends('layouts.app')
@section('content')
	<div class="form-group row">
		<div class="col-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>Usuario</h4>
				</div>
				<div class="card-body">
					<a href="{{ route('admin.usuarios.create') }}" class="btn btn-block btn-info">Nuevo usuario</a>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="card text-white bg-secondary">
				<div class="card-header bg-dark">
					{{$usuario->full_name}}
				</div>
				<div class="card-body table-responsive">
					<div class="row form-group">
						<div class="col-12 col-md-3">
							<label for="nombre" class="text-md-left col-form-label">
								Nombre
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->nombre }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="apellido_paterno" class="text-md-left col-form-label">
								Apellido Paterno
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->apellido_paterno }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="apellido_materno" class="text-md-left col-form-label">
								Apellido Materno
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->apellido_paterno }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="email" class="text-md-left col-form-label">
								Correo electrónico
							</label>
							<input class="form-control" type="email" readonly="" value="{{ $usuario->email }}">
						</div>
					</div>
					<div id="accordion" class="row form-group">
						@if ($usuario->institucion)
							<div class="col-12 mt-2">
								<h4 class="text-center">
									{{$usuario->institucion->tipo_institucion." / ".$usuario->institucion->nombre}}

								</h4>
							</div>
							@if (empty($usuario->institucion->municipios))
								<div class="col-12 mt-2">
									<h4 class="text-center">
										MUNICIPIOS
									</h4>
								</div>
								@foreach ($usuario->institucion->municipios as $municipio)
									<div class="col-12 col-md-4">
										<div class="card">
											<div class="card-header" id="heading_municipio_{{$municipio->id}}">
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
												<div class="card-body text-dark">
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
												<div class="card-body text-dark">
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
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					<a class="btn btn-warning" href="{{ route('admin.usuarios.edit',['usuario'=>$usuario]) }}">Editar</a>
					<form action="{{ route('admin.usuarios.destroy',['usuario'=>$usuario]) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
@endsection