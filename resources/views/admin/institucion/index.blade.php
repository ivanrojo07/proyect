@extends('layouts.app')
@section('content')
	<div class="container-fluid d-md-flex d-block">
		<div class="col-12 col-md-3 text-white">
			@include('admin.institucion.menu',['institucion'=>Auth::user()->institucion,'fecha'=>Date('Y-m-d')])
		</div>
		<div class="col-12 col-md-9">
			<div class="card bg-secondary text-white mt-3 mb-5">
				<div class="card-header text-white bg-dark">
					Instituciones
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-dark table-bordered text-center">
						<thead>
							<tr>
								<th scope="col">
									Institución
								</th>
								<th scope="col">
									Tipo
								</th>
								<th scope="col">
									Header 1
								</th>
								<th scope="col">
									Header 2 
								</th>
								<th scope="col">
									Favicon
								</th>
								<th scope="col">
									Footer
								</th>
								<th scope="col">
									Regiones
								</th>
								<th scope="col">
									Catalogo Nacional de Incidentes
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($instituciones as $institucion)
								<tr>
									<th scope="row">
										{{$institucion->nombre}}
									</th>
									<td>
										{{$institucion->tipo_institucion}}
									</td>
									<td>
										<img src="{{asset('storage/'.$institucion->path_imagen_header)}}" width="80">
									</td>
									<td>
										<img src="{{ asset('storage/'.$institucion->path_imagen_header2) }}" width="80">
									</td>
									<td>
										<img src="{{ asset('storage/'.$institucion->path_imagen_favicon) }}" width="80">
									</td>
									<td>
										<img src="{{ asset('storage/'.$institucion->path_imagen_footer) }}" width="80">
									</td>
									<td>
										<div class="accordion" id="regiones_{{$institucion->id}}">
											<div class="card bg-dark">
												<div class="card-header p-0" id="heading_{{$institucion->id}}">
													<h2 class="mb-0">
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$institucion->id}}" aria-expanded="true" aria-controls="collapse{{$institucion->id}}">
															{{ count($institucion->municipios) > 0 ? count($institucion->municipios)." Municipios" : count($institucion->estados)." Estados" }}
														</button>
													</h2>
												</div>

												<div class="collapse" id="collapse{{$institucion->id}}" aria-labelledby="heading_{{$institucion->id}}" data-parent="#regiones_{{$institucion->id}}">
													<div class="card-body text-left">
														<ul>
															@foreach ($institucion->estados as $estado)
																<li>
																	{{$estado->nombre}}
																</li>
															@endforeach
															@foreach ($institucion->municipios as $municipio)
																<li>
																	{{$municipio->nombre}}
																</li>
															@endforeach
														</ul>
													</div>
												</div>
											</div>
										</div>
									</td>
									<td>
										<div class="accordion" id="cni_{{$institucion->id}}">
											<div class="card bg-dark">
												<div class="card-header p-0" id="heading2_{{$institucion->id}}">
													<h2 class="mb-0">
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse2{{$institucion->id}}" aria-expanded="true" aria-controls="collapse2{{$institucion->id}}">
															{{count($institucion->categorias_incidente)." Categorias"}}
														</button>
													</h2>	
												</div>

												<div class="collapse" id="collapse2{{$institucion->id}}" aria-labelledby="heading2_{{$institucion->id}}" data-parent="#cni_{{$institucion->id}}">
													<div class="card-body text-left">
														<ul>
															@foreach ($institucion->categorias_incidente as $categoria)
																<li>
																	{{$categoria->nombre}}
																</li>
																@foreach ($categoria->catalogo_incidentes as $incidente)
																	<ol>
																		{{$incidente->nombre}}
																	</ol>
																@endforeach
															@endforeach
														</ul>
													</div>
												</div>
											</div>
										</div>
									</td>
									<td>
										<a class="btn btn-info" href="{{ route('admin.institucion.show',['institucion'=>$institucion])}}">
											Ver institución
										</a>
									</td>
								</tr>
							@empty
								<div class="alert alert-info" role="alert">
									No hay instituciones creadas.
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					{{$instituciones->render()}}
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("#fecha").change(function(){
			$("#changeFecha").submit();
		})
	</script>
@endpush