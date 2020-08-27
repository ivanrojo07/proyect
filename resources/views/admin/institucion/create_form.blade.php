@extends('layouts.layoutBase')

{{-- TODO realizar vista para peru y modificar listado --}}

{{-- Menu lateral izquierdo, con botones de navegación --}}
@include('admin.institucion.menu', ['titulo' => 'Nueva Institución'])

{{-- Contenido de la vista --}}
@section('contenido')
	<form action="{{ route('admin.institucion.store') }}" method="POST" id="create_form" enctype="multipart/form-data">
		@csrf
		<div class="panel-content">
			<div class="col-12 d-flex justify-content-between">
				<label style="margin-top:1%;margin-left: 1%;">
					<h4 style="font-size: 20px; font-weight: bold;">
						Nueva institución
					</h4>
				</label>
				<div class="align-self-center">
					<a href="{{ route('admin.institucion.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<button type="button" data-toggle="modal" data-target="#confirmSubmit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Registrar</button>
				</div>
			</div>
			<ul class="nav nav-tabs">
				<li ><a  href="{{ route('admin.institucion.index') }}" style="color: white;"  class="activo">Instituciones</a></li>
			</ul>
		</div>
		<div class="panel-body pb-4">
      		<ul class="errorMessages"></ul>
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		    <div class="row from-group">
		    	<div class="col-12 col-md-4">
					<label for="nombre" class="label">Nombre de la institución</label>
					<input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required="">
				</div>
				<div class="col-12 col-md-4">
					<label for="header_1" class="label">Imagen principal</label>
					<input type="file" accept="image/*" class="form-control" name="header_1" id="header_1" required="">
				</div>
				<div class="col-12 col-md-4">
					<label for="header_2" class="label">Imagen secundaría</label>
					<input type="file" accept="image/*" class="form-control" name="header_2" id="header_2">
				</div>
		    </div>
		    <div class="row form-group mt-3">
		    	<div class="col-12 offset-md-2 col-md-4">
					<label for="favicon" class="label">Imagen favicon</label>
					<input type="file" accept="image/*" class="form-control" name="favicon" id="favicon">
				</div>
				<div class="col-12 col-md-4">
					<label for="footer" class="label">Imagen footer</label>
					<input type="file" accept="image/*" class="form-control" name="footer" id="footer">
				</div>
		    </div>
		    <div class="row form-group">
				<div class="col-12 col-md-6">

		    		<div class="text-center label m-3">
		    			<h5>Pais</h5>
		    		</div>
		    		<label for="pais" class="text-md-left col-form-label">
		    			Selecciona el pais de la institución
		    		</label>
		    		<select class="form-control" id="pais" name="pais" required="">
		    			<option value="">Seleccione una opción</option>
		    			<option value="mexico">México</option>
		    			<option value="peru">Perú</option>
		    		</select>

		    		<div class="col-12 d-none" id="div_mexico">
		    			<div class="text-center label m-3">
		    				<h5>Estados/Municipios</h5>
		    			</div>
		    			<div id="tipo_institucion_mexico"></div>
		    			<div id="estadosMexico"></div>
		    		</div>
		    		<div class="col-12 d-none" id="div_peru">
		    			<div class="text-center label m-3">
		    				<h5>Departamentos/Provincias</h5>
		    			</div>
		    			<div id="tipo_institucion_peru"></div>
		    			<div id="estadosPeru"></div>
		    		</div>
					{{-- <div class="text-center label m-3">
						<h5>Estados/Municipios</h5>
					</div>
					<label for="regiones" class="text-md-left col-form-label">
						Seleccione el tipo de institución que será y las regiones correspondientes
					</label>
					<select class="form-control" id="tipo_institucion" name="tipo_institucion" required="">
						<option value="">Seleccione una opción</option>
						<option value="Estatal-Mexico">Estatal(México)</option>
						<option value="Municipal-Mexico">Municipal(México)</option>
						<option value="Federal-Mexico">Federal/SEDENA(México)</option>
						<option value="Estatal-Peru">Estatal(Perú)</option>
						<option value="Municipal-Peru">Municipal(Perú)</option>
						<option value="Federal-Peru">Federal/SEDENA(Perú)</option>
					</select>
					<select class="form-control mt-2 d-none" id="estadoMexico" name="estadoMexico">
						<option value="">Seleccione el estado correspondiente</option>
						@foreach ($estados_mexico as $estado)
							<option value="{{$estado->id}}">{{$estado->nombre}}</option>
						@endforeach
					</select>
					<select class="form-control mt-2 d-none" id="estadoPeru" name="estadoPeru">
						<option value="">Seleccione el estado correspondiente</option>
						@foreach ($estados_peru as $estado)
							<option value="{{$estado->id}}">{{$estado->nombre}}</option>
						@endforeach
					</select>
					<div class="row form-group d-none" id="div_estadosMexico">
						<div class="col-12 mt-2">
							<label class="text-md-left col-form-label">
								Seleccione el o los estados donde se activaran los incidentes
							</label>
						</div>
						@foreach ($estados_mexico as $estado)
							<div class="col-12 col-md-6 col-lg-4 mt-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estadosMexico[]" value="{{$estado->id}}">
										<label class="form-check-label" for="{{$estado->nombre}}">{{$estado->nombre}}</label>
								</div>
							</div>				
						@endforeach
					</div>

					<div class="row form-group d-none" id="div_estadosPeru">
						<div class="col-12 mt-2">
							<label class="text-md-left col-form-label">
								Seleccione el o los estados donde se activaran los incidentes
							</label>
						</div>
						@foreach ($estados_peru as $estado)
							<div class="col-12 col-md-6 col-lg-4 mt-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estadosPeru[]" value="{{$estado->id}}">
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
					</div> --}}
				</div>
				<div class="col-12 col-md-6">
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
	</form>
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
	            <button type="button" id="submit" class="btn btn-danger">Guardar</button>
	          </div>
	        </div>
	      </div>
	    </div>
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
	<script type="text/javascript">
		// $(document).ready(function(){
	        $("#submit").click(function(){
	          if ($("#create_form").valid() == false) {
	            var errorList = $( "ul.errorMessages")
	            errorList.empty();
	            errorList.addClass("alert alert-danger")
	            $("#confirmSubmit").modal("hide");
	            $("#create_form").find( ":invalid" ).each(function( index, node ) {
	                  console.log(node);
	                  // Find the field's corresponding label
	                  var label = $( "label[for=" + node.id + "] "),
	                      // Opera incorrectly does not fill the validationMessage property.
	                      message = node.validationMessage || 'No es valor valido.';

	                  errorList
	                      .show()
	                      .append( "<li><span>En el campo '" + label.html() + "':</span> " + message + "</li>" );
	              });

	          }
	          else{
	            $("#create_form").submit();
	          }

	        
	        });
	    // });
		function displayDivMexico(){
			$("#div_mexico").removeClass('d-none').addClass('d-block');
			$("#div_peru").removeClass('d-block').addClass('d-none');
			createOptionInstitucion('mexico');
		}
		function displayDivPeru(){
			$("#div_peru").removeClass('d-none').addClass('d-block');
			$("#div_mexico").removeClass('d-block').addClass('d-none');
			createOptionInstitucion('peru');
		}

		function createOptionInstitucion(pais){
			if (pais === "mexico") {
				$("#tipo_institucion_mexico").html(`
					<label for="tipo_institucion" class="text-md-left col-form-label">
						Seleccione el tipo de institución que será y las regiones correspondientes
					</label>
					<select class="form-control tipo_institucion" name="tipo_institucion" id="tipo_institucion" required="">
						<option value="">Seleccione una opción</option>
						<option value="Estatal">Estatal</option>
						<option value="Municipal">Municipal</option>
						<option value="Federal">Federal/SEDENA</option>
					</select>
					`);
				$("#tipo_institucion_peru").empty();
			}
			else if (pais === "peru"){
				$("#tipo_institucion_peru").html(`
					<label for="tipo_institucion" class="text-md-left col-form-label">
						Seleccione el tipo de institución que será y las regiones correspondientes
					</label>
					<select class="form-control tipo_institucion" id="tipo_institucion" name="tipo_institucion" required="">
						<option value="">Seleccione una opción</option>
						<option value="Estatal">Estatal</option>
						<option value="Municipal">Municipal</option>
						<option value="Federal">Federal</option>
					</select>
					`);
				$("#tipo_institucion_mexico").empty();
			}
			else{
				$("#tipo_institucion_mexico").empty();
				$("#tipo_institucion_peru").empty();

			}
		}

		function showEstados(pais){
			if (pais === 'mexico') {
				var html = `
				<div class="row form-group">
					<div class="col-12 mt-2">
						<label class="text-md-left col-form-label" for="estados">
							Seleccione el o los estados donde se activaran los incidentes
						</label>
					</div>
					@foreach ($estados_mexico as $estado)
						<div class="col-12 col-md-6 col-lg-4 mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estados[]" value="{{$estado->id}}" required="">
									<label class="form-check-label" for="{{$estado->nombre}}">{{$estado->nombre}}</label>
							</div>
						</div>				
					@endforeach
				</div>
				`;
				$("#estadosMexico").html(html);
				$("#estadosPeru").empty();

			}
			else if(pais === 'peru'){
				var html = `
				<div class="row form-group">
					<div class="col-12 mt-2">
						<label class="text-md-left col-form-label" for="estados">
							Seleccione el o las provincias donde se activaran los incidentes
						</label>
					</div>
					@foreach ($estados_peru as $estado)
						<div class="col-12 col-md-6 col-lg-4 mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estados[]" value="{{$estado->id}}" required>
									<label class="form-check-label" for="{{$estado->nombre}}">{{$estado->nombre}}</label>
							</div>
						</div>				
					@endforeach
				</div>
				`;
				$("#estadosPeru").html(html);
				$("#estadosMexico").empty();
			}
			else{
				$("#estadosMexico").empty();
				$("#estadosPeru").empty();
			}
		}
		function showEstado(pais){
			if(pais === 'mexico'){
				var html = `

				<select class="form-control mt-2" id="estado" name="estado" required="">
					<option value="">Seleccione el estado correspondiente</option>
					@foreach ($estados_mexico as $estado)
						<option value="{{$estado->id}}">{{$estado->nombre}}</option>
					@endforeach
				</select>
				<div id="div_municipios">
					<div class="col-12 mt-2">
						Seleccione el o los municipios donde se activaran los incidentes
					</div>
					<div class="row form-group" id="municipios_query">
						
					</div>
				</div>
				`;
				$("#estadosMexico").html(html);
				$("#estadosPeru").empty();
			}
			else if (pais === 'peru'){
				var html = `
				<select class="form-control mt-2" id="estado" name="estado">
					<option value="">Seleccione el estado correspondiente</option>
					@foreach ($estados_peru as $estado)
						<option value="{{$estado->id}}">{{$estado->nombre}}</option>
					@endforeach
				</select>
				<div id="div_municipios">
					<div class="col-12 mt-2">
						Seleccione el o los municipios donde se activaran los incidentes
					</div>
					<div class="row form-group" id="municipios_query">
						
					</div>
				</div>
				`;
				$("#estadosPeru").html(html);
				$("#estadosMexico").empty();
			}
			else{
				$("#estadosMexico").empty();
				$("#estadosPeru").empty();
			}
		}
		$("#pais").change(function(){
			var pais = $(this).val();
			if (pais === "mexico") {
				displayDivMexico();
			}
			else if (pais === "peru") {
				displayDivPeru();
			}
			else{
			$("#div_peru").removeClass('d-block').addClass('d-none');
			$("#div_mexico").removeClass('d-block').addClass('d-none');
			createOptionInstitucion("");
			}
		});
		$(document).on('change','.tipo_institucion',function(){
			var tipo_institucion = $(this).val();
			var pais = $("#pais").val();
			switch(tipo_institucion){
				case "Municipal":
					showEstado(pais);
					break;
				case "Estatal":
					showEstados(pais);
					break;
				case "Federal":
					$("#estadosMexico").empty();
					$("#estadosPeru").empty();
					break;
				default:
					$("#estadosMexico").empty();
					$("#estadosPeru").empty();
					break;
			}
		});

		$(document).on('change','#estado',function(){
			var estado_id = $(this).val();
			$("#municipios_query").empty();
			axios.get("{{ url('api/web/estados') }}/"+estado_id+"/municipios").then(res=>{
				var municipios = res.data.municipios;
				if (municipios) {
					municipios.forEach(municipio=>{
						checkbox_html = `
							<div class="col-12 col-md-6 col-lg-4 mt-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="${municipio.nombre}" name="municipios[]" value="${municipio.id}" required>
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