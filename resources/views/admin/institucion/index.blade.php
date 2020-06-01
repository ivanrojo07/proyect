@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo, con botones de navegación --}}
@include('admin.institucion.menu', ['titulo' => "Instituciones"])

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;"><h4 style="font-size: 15px;font-weight: bold;">{{ date('d-F-Y') }}</h4></label>
		</div>
		<ul class="nav nav-tabs"  >
			<li ><a  href="{{ route('admin.institucion.index') }}" style="color: white;"  class="activo">Instituciones</a></li>
		  	<li ><a   href="#"  style="color: white;" class="ocultar" >Información de la institución </a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div style="overflow: auto;">
			<div class="tab-content">
				<div class="col-12">
					<table class="text-center" id="tablaPaginado" cellspacing="0" width="100%">
						<thead id="tablaEncabezadoIncidentes">
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
						<tbody id="tablaListaIncidentes">
							@forelse ($instituciones as $institucion)
								<tr>
									<th scope="row">
										<a class="text-white" href="{{ route('admin.institucion.show',['institucion'=>$institucion])}}">
											{{$institucion->nombre}}
										</a>
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
												<div class="card-header bg-dark p-0" id="heading_{{$institucion->id}}">
													<h2 class="mb-0">
														<button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapse{{$institucion->id}}" aria-expanded="true" aria-controls="collapse{{$institucion->id}}">
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
											<div class="card">
												<div class="card-header bg-dark p-0" id="heading2_{{$institucion->id}}">
													<h2 class="mb-0">
														<button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapse2{{$institucion->id}}" aria-expanded="true" aria-controls="collapse2{{$institucion->id}}">
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
								</tr>
							@empty
								<div class="alert alert-info" role="alert">
									No hay instituciones creadas.
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
@endsection