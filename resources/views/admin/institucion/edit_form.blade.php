@extends('layouts.app')
@section('content')
	<div class="form-group row">
		<div class="col-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>Incidentes</h4>
				</div>
				<div class="card-body">
					<a href="{{ route('admin.institucion.create') }}" class="btn btn-block btn-info">Nueva institución</a>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="card bg-secondary text-white">
				<div class="card-header bg-dark">
					Editar Institución {{$institucion->nombre}}
				</div>
				<form action="{{ route('admin.institucion.update',['institucion'=>$institucion]) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="card-body">
						<div class="text-center text-white">
							<h5>Institución</h5>
						</div>
						<div class="row form-group">
							<div class="col-12 col-md-4">
								<label for="nombre" class="text-md-left col-form-label">Nombre de la institución</label>
								<input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') ? old('nombre') : $institucion->nombre }}">
							</div>
							<div class="col-12 col-md-4">
								<label for="header_1" class="text-md-left col-form-label">Imagen principal</label>
								@if ($institucion->path_imagen_header)
									<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_header) }}">
								@endif
								<input type="file" class="form-control" name="header_1" id="header_1">
							</div>
							<div class="col-12 col-md-4">
								<label for="header_2" class="text-md-left col-form-label">Imagen secundaría</label>
								@if ($institucion->path_imagen_header2)
									<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_header2) }}">
								@endif
								<input type="file" class="form-control" name="header_2" id="header_2">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-12 offset-md-2 col-md-4">
								<label for="favicon" class="text-md-left col-form-label">Imagen favicon</label>
								@if ($institucion->path_imagen_favicon)
									<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_favicon) }}">
								@endif
								<input type="file" class="form-control" name="favicon" id="favicon">
							</div>
							<div class="col-12 col-md-4">
								<label for="footer" class="text-md-left col-form-label">Imagen footer</label>
								@if ($institucion->path_imagen_footer)
									<img class="form-control" src="{{ asset('storage/'.$institucion->path_imagen_footer) }}">
								@endif
								<input type="file" class="form-control" name="footer" id="footer">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="text-center text-white">
									<h5>Estados/Municipios</h5>
								</div>
								<label for="regiones" class="text-md-left col-form-label">
									Seleccione el tipo de institución que será y las regiones correspondientes
								</label>
								<select class="form-control" id="tipo_institucion" name="tipo_institucion" required="">
									<option value="">Seleccione una opción</option>
									<option value="Estatal">Estatal</option>
									<option value="Municipal">Municipal</option>
									<option value="Federal">Federal/SEDENA</option>
								</select>
								<select class="form-control mt-2 d-none" id="estado" name="estado">
									<option value="">Seleccione el estado correspondiente</option>
									@foreach ($estados as $estado)
										<option value="{{$estado->id}}">{{$estado->nombre}}</option>
									@endforeach
								</select>
								<div class="row form-group d-none" id="div_estados">
									<div class="col-12 mt-2">
										<label class="text-md-left col-form-label">
											Seleccione el o los estados donde se activaran los incidentes
										</label>
									</div>
									@foreach ($estados as $estado)
										<div class="col-4 mt-2">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estados[]" value="{{$estado->id}}">
	  											<label class="form-check-label" for="{{$estado->nombre}}">{{$estado->nombre}}</label>
											</div>
										</div>				
									@endforeach
								</div>
								<div id="div_municipios">
									<div class="col-12 mt-2">
										Seleccione el o los municipios donde se activaran los incidentes
									</div>
									<div class="row form-group" id="municipios_query">
										
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="text-center text-white">
									<h5>Categorias del Catalogo Nacional de Incidentes</h5>
								</div>
								<div class="row form-group">
									@foreach ($categorias_incidente  as $categoria)
										<div class="col-4 mt-2">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="{{$categoria->nombre}}" name="categorias[]" value="{{$categoria->id}}">
	  											<label class="form-check-label" for="{{$categoria->nombre}}">{{$categoria->nombre}}</label>
											</div>
											<div id="accordion">
												<div class="card">
													<div class="card-header bg-light" id="heading{{$categoria->id}}">
														<h5 class="mb-0">
															<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$categoria->id}}" aria-expanded="true" aria-controls="collapse{{$categoria->id}}">{{$categoria->nombre}}</button>
														</h5>
													</div>
													<div id="collapse{{$categoria->id}}" class="collapse" aria-labelledby="heading{{$categoria->id}}" data-parent="#accordion">
														<ul class="list-group">
															@foreach ($categoria->catalogo_incidentes as $incidente)
																<li class="list-group-item active text-dark">
																	{{$incidente->clave." / ".$incidente->nombre}}
																</li>
															@endforeach
														</ul>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-white bg-dark d-flex justify-content-around">
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script type="text/javascript">
	$("#tipo_institucion").change(function(){
		var tipo_institucion = $(this).val();
		if (tipo_institucion == "Municipal") {
			$("#estado").removeClass('d-none').addClass('d-block');
			$("#estado").val('');
			$("#div_estados").removeClass('d-flex').addClass('d-none');
			$("input[name='estados[]']").prop('checked',false);
			$("#div_municipios").removeClass("d-none").addClass("d-block");
		} 
		else if( tipo_institucion == "Estatal"){
			$("#estado").removeClass('d-block').addClass('d-none');
			$("#estado").val('');
			$("#div_estados").removeClass('d-none').addClass('d-flex');
			$("input[name='estados[]']").prop('checked',false);
			$("input[name='municipios[]']").val([]);
			$("#div_municipios").removeClass("d-block").addClass("d-none");

		}
		else {
			$("#estado").removeClass('d-block').addClass('d-none');
			$("#estado").val('');
			$("#div_estados").removeClass('d-flex').addClass('d-none');
			$("input[name='municipios[]']").val([]);
			$("input[name='estados[]']").prop('checked',false);
			$("#div_municipios").removeClass("d-blockk").addClass("d-none");
		}
	});

	$("#estado").change(function(){
		var estado_id = $(this).val();
		$("#municipios_query").empty();
		axios.get("{{ url('api/web/estados') }}/"+estado_id+"/municipios").then(res=>{
			var municipios = res.data.municipios;
			if (municipios) {
				municipios.forEach(municipio=>{
					checkbox_html = `
						<div class="col-4 mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="${municipio.nombre}" name="municipios[]" value="${municipio.id}">
									<label class="form-check-label" for="${municipio.nombre}">${municipio.nombre}</label>
							</div>
						</div>
					`;
					$("#municipios_query").append(checkbox_html);

				})
			} else {
				console.log("ERROR API");
			}

		}).catch(err=>{
			console.log(err);
		})

	});
	$(document).ready(function(){
		var tipo_institucion = '{{$institucion->tipo_institucion}}';
		$("#tipo_institucion").val(tipo_institucion);
		if (tipo_institucion == "Municipal") {
			var estado_id = '{{$institucion->municipios[0]->estado->id}}';
			var mis_municipios = {{$institucion->municipios->pluck('id')}};
			$("#estado").removeClass('d-none').addClass('d-block');
			$("#estado").val(estado_id);
			$("#div_estados").removeClass('d-flex').addClass('d-none');
			$("input[name='estados[]']").prop('checked',false);
			$("#div_municipios").removeClass("d-none").addClass("d-block");
			axios.get("{{ url('api/web/estados') }}/"+estado_id+"/municipios").then(res=>{
				var municipios = res.data.municipios;
				if (municipios) {

					municipios.forEach(municipio=>{
						checkbox_html = `
							<div class="col-4 mt-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="${municipio.nombre}" name="municipios[]" ${ mis_municipios.includes(municipio.id) ? 'checked=""' : '' } value="${municipio.id}">
										<label class="form-check-label" for="${municipio.nombre}">${municipio.nombre}</label>
								</div>
							</div>
						`;
						$("#municipios_query").append(checkbox_html);

					})
				} else {
					console.log("ERROR API");
				}

			}).catch(err=>{
				console.log(err);
			})

		} 
		else if( tipo_institucion == "Estatal"){
			$("#estado").removeClass('d-block').addClass('d-none');
			$("#estado").val('');
			$("#div_estados").removeClass('d-none').addClass('d-flex');
			$("input[name='estados[]']").prop('checked',false);
			var mis_estados = {{$institucion->estados->pluck('id')}};
			$("input[name='estados[]']").val(mis_estados);
			$("#div_municipios").removeClass("d-block").addClass("d-none");

		}
		else {
			$("#estado").removeClass('d-block').addClass('d-none');
			$("#estado").val('');
			$("#div_estados").removeClass('d-flex').addClass('d-none');
			$("input[name='estados[]']").prop('checked',false);
			$("#div_municipios").removeClass("d-blockk").addClass("d-none");
		}

		var mis_categorias_incidentes = {{$institucion->categorias_incidente->pluck('id')}};
		$("input[name='categorias[]']").val(mis_categorias_incidentes);
	});
</script>
@endpush