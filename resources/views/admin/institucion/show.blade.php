@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo, con botones de navegación --}}
@include('admin.institucion.menu', ['titulo' => "$institucion->nombre"])

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;">
				<h4 style="font-size: 20px;font-weight: bold;">Institución: {{ $institucion->nombre }}</h4>
				
			</label>
			<div class="align-self-center">
				<form action="{{ route('admin.institucion.destroy',['institucion'=>$institucion]) }}" method="POST">
					<a href="{{ route('admin.institucion.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<a href="{{ route('admin.institucion.edit',['institucion'=>$institucion]) }}" class="btn boton1 m-2" style="background-color: #da291c !important; color: #f5f5f5;">Actualizar</a>
					@csrf
					@method('DELETE')
					<button type="button" data-toggle="modal" data-target="#confirmDelete" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Eliminar</button>
					{{-- modal confirmar guardado/editar usuario --}}
				    <!-- Modal -->
				    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				      <div class="modal-dialog modal-dialog-centered" role="document">
				        <div class="modal-content">
				          <div class="modal-header bg-dark">
				            <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				              <span aria-hidden="true">&times;</span>
				            </button>
				          </div>
				          <div class="modal-body bg-secondary">
				            ¿Estás seguro que deseas eliminar esta institución?
				          </div>
				          <div class="modal-footer bg-secondary">
				            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
				            <button type="submit" class="btn btn-danger">Registrar</button>
				          </div>
				        </div>
				      </div>
				    </div>

				</form>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="{{ route('admin.institucion.index') }}" style="color: white;"  class="">Institución</a></li>
		  	<li ><a  href="{{ route('admin.institucion.show',['institucion'=>$institucion]) }}"  style="color: white;" class="activo" >Información de la Institución </a></li>
		</ul>
	</div>
	<div class="panel-body pb-3">
		<div class="row form-group">
			<div class="col-12 col-md-4">
				<label for="nombre" class="label">Nombre de la institución</label>
				<p class="info">
					{{ $institucion->nombre }}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="header_1" class="label">Imagen principal</label>
				<p>
					<img width="90" src="{{ asset('storage/'.$institucion->path_imagen_header) }}">
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="header_2" class="label">Imagen secundaría</label>
				<p>
					<img width="90" src="{{ asset('storage/'.$institucion->path_imagen_header2) }}">
				</p>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-12 offset-md-2 col-md-4">
				<label for="favicon" class="label">Imagen favicon</label>
				<p>
					<img width="90" src="{{ asset('storage/'.$institucion->path_imagen_favicon) }}">
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="footer" class="label">Imagen footer</label>
				<p>
					<img width="90" src="{{ asset('storage/'.$institucion->path_imagen_footer) }}">
				</p>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-12">
				<div class="text-center label">
					<h3>Estados/Municipios</h3>
				</div>
				<label for="regiones" class="label">
					Tipo de institución que será y las regiones correspondientes
				</label>
				<p class="info">
					{{$institucion->tipo_institucion}}
				</p>
		    	<label for="regiones" class="label">
					Regiones correspondientes
				</label>
				@switch($institucion->tipo_institucion)
				    @case("Federal")
				        <div class="row form-group">
				        	@foreach ($institucion->estados as $estado)
					        	<div class="col-12 col-lg-4 mt-2">
										<p class="info" for="{{$estado->nombre}}">{{$estado->nombre}}</p>
								</div>
				        	@endforeach
				        </div>
			        @break

			        @case("Estatal")
				        <div class="row form-group">
				        	@foreach ($institucion->estados as $estado)
					        	<div class="col-12 col-lg-4 mt-2">
										<p class="info" for="{{$estado->nombre}}">{{$estado->nombre}}</p>
								</div>
				        	@endforeach
				        </div>
			        @break

			        @case("Municipal")
				        <div class="row form-group">
				        	@foreach ($institucion->municipios as $municipio)
					        	<div class="col-12 col-lg-4 mt-2">
										<p class="info" for="{{$municipio->nombre}}">{{$municipio->nombre." (".$municipio->estado->nombre.")"}}</p>
								</div>
				        	@endforeach
				        </div>
			        @break
				
				@endswitch
			</div>
			<div class="col-12">
				<div class="text-center label">
					<h3>Categorias del Catalogo Nacional de Incidentes</h3>
				</div>
				<div class="row form-group">
						@foreach ($institucion->categorias_incidente as $categoria)
						<div class="col-12 col-lg-4">
							<ul>
								<li class="label">
									{{$categoria->nombre}}
								</li>
								<ul>
									@foreach ($categoria->subcategorias as $subcategoria)
										<li class="info">
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
@endsection

{{-- Scripts --}}
@section('scripts')
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