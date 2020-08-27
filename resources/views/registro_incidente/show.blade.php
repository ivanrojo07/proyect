@extends('layouts.layoutBase')

{{-- Menu de navegacion lateral izquierda, con navegación y calendario (se necesita titulo de la pestaña y fecha a donde redirigir) --}}
@include('registro_incidente.menu', ['titulo' => "Incidente #$incidente->id", 'fecha'=>Date('Y-m-d')])

@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;">
				<h4 style="font-size: 20px;font-weight: bold;">Incidente #{{ $incidente->serie_id }} | <span class="span-{{$incidente->impacto->nombre}}"></span> Prioridad: {{ $incidente->impacto->nombre }}</h4>
				<h6 style="font-size: 15px;">{{ $incidente->catalogo_incidente ? 
					$incidente->catalogo_incidente->subcategoria->categoria->nombre
					." | ".
					$incidente->catalogo_incidente->subcategoria->nombre
					." | ".
					$incidente->catalogo_incidente->clave
					." | ".
					 $incidente->catalogo_incidente->nombre
					 : 'N/A'
				}}</h6>
			</label>
			<div class="align-self-center">
				<a href="{{ url('/incidente')}}?fecha={{ $incidente->fecha_ocurrencia }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
				<a href="{{ route('incidente.edit',['incidente'=>$incidente]) }}" class="btn boton1 m-2 {{ $incidente->seguimiento->nombre == 'Final' || $incidente->seguimiento->nombre == 'único' ? 'disabled' : '' }}" style="background-color: #da291c !important; color: #f5f5f5;">Actualizar</a>
			</div>
		</div>
		<ul class="nav nav-tabs"  >
			<li ><a  href="{{ url('/incidente')}}?fecha={{ $incidente->fecha_ocurrencia }}" style="color: white;"  class="">Incidentes</a></li>
		  	<li ><a  href="{{ route('incidente.show',['incidente'=>$incidente]) }}"  style="color: white;" class="activo" >Información del Incidente </a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-12 col-md-6 col-xl-6">
				<h4 style="font-size: 20px;font-weight: bold; margin: 25px">
					Actualización del {{$incidente->fecha_ocurrencia." ".$incidente->hora_ocurrencia}} 
				</h4>
			</div>
			<div class="col-12 col-md-3 col-xl-3">
				<p class="label">
					Fecha de Ocurrencia
				</p>
				<p class="info">
					{{$incidente->fecha_ocurrencia}}
				</p>
				<p class="label">
					Fecha de Registro
				</p>
				<p class="info">
					{{$incidente->fecha_registro}}
				</p>
			</div>
			<div class="col-12 col-md-3 col-xl-3">
				<p class="label">
					Hora de Ocurrencia
				</p>
				<p class="info">
					{{$incidente->hora_ocurrencia}}
				</p>
				<p class="label">
					Hora de Registro
				</p>
				<p class="info">
					{{$incidente->hora_registro}}
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Descripción del incidente
				</p>
				<p class="info">
					{{$incidente->descripcion}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Categoria del Catalogo Nacional de Incidente
				</p>
				<p class="info">
					{{$incidente->catalogo_incidente ? $incidente->catalogo_incidente->subcategoria->categoria->nombre : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Subcategoria del Catalogo Nacional de Incidente
				</p>
				<p class="info">
					{{$incidente->catalogo_incidente ? $incidente->catalogo_incidente->subcategoria->nombre : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Incidente
				</p>
				<p class="info">
					{{$incidente->catalogo_incidente ? $incidente->catalogo_incidente->nombre : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Afectación Vial
				</p>
				<p class="info">
					{{$incidente->afectacion_vial ? $incidente->afectacion_vial : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Infraestructuras Afectadas
				</p>
				<p class="info">
					{{$incidente->afectacion_infraestructural ? $incidente->afectacion_infraestructural : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Daños Colaterales
				</p>
				<p class="info">
					{{ $incidente->danio_colateral ? $incidente->danio_colateral : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Estatus
				</p>
				<p class="info">
					{{ $incidente->estatus }}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Tipo de Impacto
				</p>
				<p class="info">
					{{$incidente->impacto->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Tipo de Seguimiento
				</p>
				<p class="info">
					{{$incidente->seguimiento->nombre}}
				</p>
			</div>
			<div class="col-12 offset-md-1 col-md-2 mt-3">
				<p class="label">
					Personas Afectadas
				</p>
				<p class="info">
					{{$incidente->personas_afectadas}}
				</p>
			</div>
			<div class="col-12 col-md-2 mt-3">
				<p class="label">
					Personas Lesionadas
				</p>
				<p class="info">
					{{$incidente->personas_lesionadas}}
				</p>
			</div>
			<div class="col-12 col-md-2 mt-3">
				<p class="label">
					Personas Fallecidas
				</p>
				<p class="info">
					{{$incidente->personas_fallecidas}}
				</p>
			</div>
			<div class="col-12 col-md-2 mt-3">
				<p class="label">
					Personas Desaparecidas
				</p>
				<p class="info">
					{{$incidente->personas_desaparecidas}}
				</p>
			</div>
			<div class="col-12 col-md-2 mt-3">
				<p class="label">
					Personas Evacuadas
				</p>
				<p class="info">
					{{$incidente->personas_evacuadas}}
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Estado
				</p>
				<p class="info">
					{{$incidente->estado->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Municipio
				</p>
				<p class="info">
					{{$incidente->municipio ? $incidente->municipio->nombre : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Dirección
				</p>
				<p class="info">
					{{$incidente->locacion ? $incidente->locacion : "N/A"}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Latitud
				</p>
				<p class="info">
					{{$incidente->lat_especifica}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Longitud
				</p>
				<p class="info">
					{{$incidente->long_especifica}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Localidades Afectadas
				</p>
				<p class="info">
					<ul>
						@forelse ($incidente->localidades as $localidad)
							<li>
								{{$localidad->nombre}}
							</li>
						@empty
							N/A
						@endforelse
					</ul>
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Otros Lugares Afectados
				</p>
				<p class="info">
					{{$incidente->lugares_afectados ? $incidente->lugares_afectados : "N/A"}}
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12 col-md-6">
				{{-- MAPA --}}
				<div class="mt-5 mb-5" id="map" style="height: 400px;"></div>
			</div>
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6 mt-3">
						<p class="label">
							Medidas de control
						</p>
						<p class="info">
							{{$incidente->medidas_control ? $incidente->medidas_control : 'N/A' }}
						</p>
					</div>
					<div class="col-12 col-md-6 mt-3">
						<div class="card">
							<div class="card-header bg-dark text-white">
								Respuesta Institucional
							</div>
							<div class="card-body bg-secondary">
								<div class="col-12">
									<p class="label">
										Dependencia
									</p>
									<p class="info">
										{{$incidente->dependencia ? $incidente->dependencia : "N/A"}}
									</p>
								</div>
								<div class="col-12">
									<p class="label">
										Nombre
									</p>
									<p class="info">
										{{$incidente->nombre_empleado ? $incidente->nombre_empleado : "N/A"}}
									</p>
								</div>
								<div class="col-12">
									<p class="label">
										Cargo
									</p>
									<p class="info">
										{{$incidente->cargo_empleado ? $incidente->cargo_empleado : "N/A"}}
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-around mt-3">
					<button type="button" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;" data-toggle="modal" data-target="#pdfIncidente">PDF</button>
					<div class="card">
						<div class="card-header bg-dark text-white">
							Historial de incidentes
						</div>
						<div class="card-body bg-secondary">
							<li class="list-group">
								@foreach ($incidente->serie->registro_incidentes as $registro)
									{{-- <ul class="list-group-item"> --}}
										<a class="{{ $registro->id == $incidente->id ? 'list-group-item disabled' : 'list-group-item' }}" href="{{ route('incidente.show',['incidente'=>$registro]) }}">{{"Folio #$registro->serie_id $registro->id"}}</a>
									{{-- </ul> --}}
								@endforeach
							</li>
						</div>
					</div>
				</div>
			</div>
				<div class="col-12 mt-3 mb-3">
					<div id="accordion">
						@include('registro_incidente.dependencia',['dependencia'=>$dependencia])

						@include('registro_incidente.reportes',['reportes'=>$reportes])
							
					</div>
				</div>
		</div>
	</div>

	
@endsection

{{-- Scripts --}}
@section('scripts')
{{-- MODAL PDF --}}
	 <!-- Modal -->
	<div class="modal fade" id="pdfIncidente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 65%">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title" id="exampleModalLongTitle">PDF Incidentes del {{$incidente->fecha_ocurrencia}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body bg-secondary">
					<iframe class="w-100" style="height: 80vh;" src="{{ route('pdf.incidente.show',['incidente'=>$incidente]) }}" title="Incidentes PDF">
					</iframe>      
				</div>
				<div class="modal-footer bg-secondary">
					<button type="button" class="btn boton1" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
	<script>
	

        $("#datepicker").datepicker({
          onSelect: function(e) {
	    var diafecha=e;
            var fechaarray=diafecha.split('-');
            var fechainvertir=fechaarray.reverse();
            var nuevafecha=fechainvertir.join('-');
            console.log(nuevafecha);

           window.location = "{{ url('/incidente')}}"+"?fecha="+nuevafecha;
         },
         maxDate: 0
        });
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($incidente->fecha_ocurrencia))}}" );
    </script>
    <script type="text/javascript">
		var map;
		var marker;
		function initMap() {
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: {{$incidente->lat_especifica}}, lng: {{$incidente->long_especifica}} },
	          zoom: 17,
	          mapTypeId: 'hybrid',
	          heading: 90,
    		  tilt: 45
	        });
	        marker = new google.maps.Marker({position: {lat: {{$incidente->lat_especifica}}, lng: {{$incidente->long_especifica}} }, map:map })

      	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap"
    ></script>
@endsection