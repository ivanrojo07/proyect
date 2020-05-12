@extends('layouts.app')
@section('content')
	<div class="container-fluid d-md-flex d-block">
		<div class="col-12 col-md-3 text-white">
			@include('admin.institucion.menu',['institucion'=>Auth::user()->institucion,'fecha'=>Date('Y-m-d')])
		</div>
		<div class="col-12 col-md-9">
			<div class="card bg-secondary text-white mt-3 mb-5">
				<div class="card-header bg-dark">
					{{$institucion->nombre}}
				</div>
				<div class="card-body">
					<div class="text-center text-white">
						<h5>Institución</h5>
					</div>
					<div class="row form-group">
						<div class="col-12 col-md-4">
							<label for="nombre" class="text-md-left col-form-label">Nombre de la institución</label>
							<input readonly="" class="form-control" value="{{ $institucion->nombre }}">
						</div>
						<div class="col-12 col-md-4">
							<label for="header_1" class="text-md-left col-form-label">Imagen principal</label>
							<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_header) }}">
						</div>
						<div class="col-12 col-md-4">
							<label for="header_2" class="text-md-left col-form-label">Imagen secundaría</label>
							<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_header2) }}">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-12 offset-md-2 col-md-4">
							<label for="favicon" class="text-md-left col-form-label">Imagen favicon</label>
							<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_favicon) }}">
						</div>
						<div class="col-12 col-md-4">
							<label for="footer" class="text-md-left col-form-label">Imagen footer</label>
							<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_footer) }}">
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="text-center text-white">
								<h5>Estados/Municipios</h5>
							</div>
							<label for="regiones" class="text-md-left col-form-label">
								Tipo de institución que será y las regiones correspondientes
							</label>
							<input type="text" class="form-control" readonly="" value="{{$institucion->tipo_institucion}}">
					    	<label for="regiones" class="text-md-left col-form-label">
								Regiones correspondientes
							</label>
							@switch($institucion->tipo_institucion)
							    @case("Federal")
							        <div class="row form-group">
							        	@foreach ($institucion->estados as $estado)
								        	<div class="col-12 col-lg-4 mt-2">
	  											<label for="{{$estado->nombre}}">{{$estado->nombre}}</label>
											</div>
							        	@endforeach
							        </div>
						        @break

						        @case("Estatal")
							        <div class="row form-group">
							        	@foreach ($institucion->estados as $estado)
								        	<div class="col-12 col-lg-4 mt-2">
	  											<label for="{{$estado->nombre}}">{{$estado->nombre}}</label>
											</div>
							        	@endforeach
							        </div>
						        @break

						        @case("Municipal")
							        <div class="row form-group">
							        	@foreach ($institucion->municipios as $municipio)
								        	<div class="col-12 col-lg-4 mt-2">
	  											<label for="{{$municipio->nombre}}">{{$municipio->nombre." (".$municipio->estado->nombre.")"}}</label>
											</div>
							        	@endforeach
							        </div>
						        @break
							
							@endswitch
						</div>
						<div class="col-12">
							<div class="text-center text-white">
								<h5>Categorias del Catalogo Nacional de Incidentes</h5>
							</div>
							<div class="row form-group">
									@foreach ($institucion->categorias_incidente as $categoria)
									<div class="col-12 col-lg-4">
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
														@foreach ($subcategoria->catalogos as $incidente)
															<li>
																{{$incidente->nombre}}
															</li>
														@endforeach
													</ul>
												@endforeach
											</ul>
										</ul>
									</div>
									@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					<a href="{{ route('admin.institucion.edit',['institucion'=>$institucion]) }}" class="btn btn-warning">Editar</a>
					<form method="POST" action="{{ route('admin.institucion.destroy',['institucion'=>$institucion]) }}">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection