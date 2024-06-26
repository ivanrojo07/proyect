@extends('layouts.layoutBase2')

@section('titulo')
	Registro a la plataforma
@endsection

@section('botonera')
@endsection

@section('titulopanel')
	 <h5 style="color: black;">Vincular cuenta 
    </h5>
@endsection

@section('panellateral')
	{{-- expr --}}
@endsection

@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;"><h4 style="font-size: 15px;font-weight: bold;">Registro de cuenta</h4></label>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="#" style="color: white;"  class="activo m-2">Incidentes</a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div class="tab-content">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="row">
						<div class="col-12 m-4">
							<h4>Cree una nueva institución</h4>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-12 col-md-6 mt-1 mb-1">
							<label for="nombre" class="label">Nombre de la institución</label>
							<input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
						</div>
						<div class="col-12 col-md-6 mt-1 mb-1">
							<label for="header_1" class="label">Imagen principal</label>
							<input type="file" accept="image/*" class="form-control" name="header_1" id="header_1">
						</div>
						<div class="col-12 col-md-6 mt-1 mb-1">
							<label for="header_2" class="label">Imagen secundaría</label>
							<input type="file" accept="image/*" class="form-control" name="header_2" id="header_2">
						</div>
						<div class="col-12 col-md-6 mt-1 mb-1">
							<label for="favicon" class="label">Imagen favicon</label>
							<input type="file" accept="image/*" class="form-control" name="favicon" id="favicon">
						</div>
						<div class="col-12 col-md-6 mt-1 mb-1">
							<label for="footer" class="label">Imagen footer</label>
							<input type="file" accept="image/*" class="form-control" name="footer" id="footer">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-12">
							<div class="text-center label">
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
									<div class="col-12 col-md-6 col-lg-4 mt-2">
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
					</div>
					<div class="row form-group">
						<div class="col-12">
							<div class="text-center text-white">
								<h5>Categorias del Catalogo Nacional de Incidentes</h5>
							</div>
							<div class="row form-group">
								@foreach ($categorias_incidente  as $categoria)
									<div class="col-12 col-md-6 col-lg-4 mt-2">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="{{$categoria->nombre}}" name="categorias[]" value="{{$categoria->id}}">
												<label class="form-check-label" for="{{$categoria->nombre}}">{{$categoria->nombre}}</label>
										</div>
										<div id="accordion">
											<div class="card">
												<div class="card-header bg-dark" id="heading{{$categoria->id}}">
													<h5 class="mb-0">
														<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$categoria->id}}" aria-expanded="true" aria-controls="collapse{{$categoria->id}}">{{$categoria->nombre}}</button>
													</h5>
												</div>
												<div id="collapse{{$categoria->id}}" class="collapse" aria-labelledby="heading{{$categoria->id}}" data-parent="#accordion">
													<ul class="list-group">
														@foreach ($categoria->catalogo_incidentes as $incidente)
															<li class="list-group-item bg-secondary active">
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
				<div class="col-12 col-md-6">
					<div class="row">
						<div class="col-12 m-4">
							<h4>O seleccione la institución a la que pertenece</h4>
						</div>
					</div>
					@foreach ($instituciones as $institucion)
						{{-- expr --}}
					@endforeach

						<div class="card">
  <div class="card-header">
    <label class="form-check-label m-3">
    <input type="checkbox" class="form-check-input" value="">Option 1
  </label>
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

				</div>
			</div>
		</div>
	</div>
@endsection

{{-- Scripts --}}
@section('scripts')
{{-- modal confirmar incidente --}}
	    <!-- Modal -->
	    <div class="modal fade" id="confirmSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	          <div class="modal-header bg-dark">
	            <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body bg-secondary">
	            ¿Estás seguro que deseas guardar estos cambios?
	          </div>
	          <div class="modal-footer bg-secondary">
	            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
	            <button type="button" onclick="event.preventDefault(); document.getElementById('create_form').submit();" class="btn btn-danger">Guardar</button>
	          </div>
	        </div>
	      </div>
	    </div>
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
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
				$("#div_municipios").removeClass("d-block").addClass("d-none");

			}
			else {
				$("#estado").removeClass('d-block').addClass('d-none');
				$("#estado").val('');
				$("#div_estados").removeClass('d-flex').addClass('d-none');
				$("input[name='estados[]']").prop('checked',false);
				$("#div_municipios").removeClass("d-block").addClass("d-none");
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
							<div class="col-12 col-md-6 col-lg-4 mt-2">
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
	</script>
@endsection