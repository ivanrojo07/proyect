@extends('layouts.layoutBase')

{{-- Titulo de la pestaña --}}
@section('titulo')
	Incidente #{{$incidente->id}}
@endsection

{{-- estilos --}}
@section('estilos')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.flexdatalist.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
  	<style type="text/css">
  		table, th, td {
          /*border: 2px solid #48484b;*/
      }
      p.info{
		font-size: 15px;
      }
      p.label{
      	color: #FFA500;
      	font-size: 15px;
      }
      th {}
         /* background-color: #3f444b;
          color: white;
      }
      tr:nth-child(even) {
          background-color: #3d424a;
          color: white;
      }
      tr:nth-child(odd) {
          background-color: #50545b;
          color: white;
      }
      .medio {
          border: solid 2px #d2d228;
          padding: 1px 34px;
      }
      .alto {
          border: solid 2px #c10900;
          padding: 1px 40px;
      }
      .bajo {
          border: solid 2px #34a734;
          padding: 1px 38px;
      }
      /* Vista formulario editar  */
      .Bajo{
        border-left: 5px solid green;
        padding: 1px 38px;
      }
      .Medio{
        border-left: solid 5px #ffc300;
        padding: 1px 38px;
      }
      .Alto{
        border-left: solid 5px #b3282d;
        padding: 1px 38px;
      }
      .span-Bajo{
      	width: 35px;
      	height: 35px;
    	border-radius: 16px;
    	margin: 5px;
    	background-color: #15a746;
      }
      .span-Medio{
      	width: 35px;
      	height: 35px;
    	border-radius: 16px;
    	margin: 5px;
    	background-color: #ff8200;
      }
      .span-Alto{
      	width: 35px;
      	height: 35px;
    	border-radius: 16px;
    	margin: 5px;
    	background-color: #b3282d;
      }
      .panel {
            border: none;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .panel-heading {
            border: none;
            color: #fff !important;
            background-color: #a5a7a8 !important;
            height: 55px;
            padding: 0px 0px 0px 30px;
            border-radius: 20px 20px 0px 0px;"
        }
        .panel-heading .head-titulo>.nav-tabs {
            border-bottom: none;
            background-color: #3f444b;
            border-radius: 10px 10px 0px 0px;
        }
        .panel-heading .head-titulo>.nav-tabs>li.active>a {
            background-color: #3f444b;
        }
        .panel-heading .head-titulo>.nav>li>a {
            padding: 8px 15px;
        }
        .panel-heading .head-titulo>.nav-tabs>li>a {
            margin-right: 10px;
            border: none;
        }
        .panel-heading .head-titulo>.nav-tabs>li>a>h4 {
            color: #f58220;
        }
        .panel-body {
            background-color: #3f444b;
            padding: 1% 1% 0%;
        }
        .panel-body #agregarIncidente .form-group {
            margin-right: 0px;
            margin-left: 0px;
            color: white;
        }
        .formularioRegistro{
            background-color: #3f444b;
        }
        hr {
            margin-top: -7px;
            margin-bottom: 6px;
            border-top: 1px solid #fff;
        }
        .borde-indicadores {
            border: 1px solid #fff;
            padding-top: 1%;
            margin-bottom: 10px;
        }
        .radio {
            /*border: solid 2px #e2231a;*/
            padding: 4% 7%;
            margin-top: 0;
            margin-bottom: 0;
        }
        label{
            font-weight: bold;
        }
        .form-group {
            margin-right: 0px;
            margin-left: 0px;
        }
        .form-group>.radio label {
            padding-left: 27px;
            font-weight: normal;
        }
        .form-group>.radio>.radio-inline>input[type="radio"] {
            height: 22px;
            width: 22px;
            margin-left: -25px;
            margin-top: -3px;
        }
        #etiqueta { color:#FFA500 }
	    .panel-default{
			background-color:#a5a7a8 !important;
			border-radius: 20px 20px 0px 0px;
	    }
	    .panel-content{
			color: #fff !important;
			background-color:#a5a7a8 !important;
	     /* border-radius: 20px 20px 0px 0px;*/
	    }
	    .coloropt{
			  background-color:#3f444b !important;
			  color:#f58220 !important;
	    }
	    .ocultaropt{
			  display: none !important;
	    }
	    .seleccionadoclr{
			color: #f58220 !important;
	    }
	    .nav-tabs > li {
			float: left;
			margin-bottom: -1px;
	    }
	    .nav-tabs > li > a {
			margin-right: 2px;
			line-height: 1.42857143;
			border: 1px solid transparent;
			border-radius: 4px 4px 0 0;
	    }
	    .nav > li > a{
			position: relative;
			display: block;
			padding: 10px 15px;
	    }
	    .nav > li {
			position: relative;
			display: block;
	    }
	    .panel-body {
			background-color: #3f444b;
			padding: 1% 1% 0%;
	    }
	    .collapse.show {
	    }
	    label{
	    	font-size: 15px;
	    }
  	</style>
  	<!-- FUNCIONAL PARA LOS  DATE  PIKER -->
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  	<style type="text/css">
    	* {
      		font-family: 'Lato', 'Avenir', sans-serif;
    	}

    	.arrow {
      		position: absolute;
      		right: 0;
      		color: red;
		}
       	.letraregistro{
            color: #ff8200;

        }
		/*< CONFIGURACION DE MENU TABLA E INFORMACION DE INCIDENTE.*/
    	.activo{
  			background-color:gray !important;color: white;
    	}
    	.ocultar{
      		display:none !important;
    	}
    /*>*/
  	</style>
@endsection

{{-- Menu de navegacion --}}
@section('botonera')
	<a href="{{ route('home') }}"><span role="button" class="glbl glbl-home"  title="Inicio"></span></a>
	<a href="{{ route('incidente.create') }}"><span role="button" class="glbl glbl-more"  title="Registrar"></span></a>
@endsection

{{-- Titulo de sidebar --}}
@section('titulopanel')
	<div  class="titulolateral">
        <h5>Incidentes 
            <a>
                <span class="glbl2 glbl glbl-down"></span>
            </a>
        </h5>
        
    </div>
@endsection


{{-- Contenido del sidebar --}}
@section('panellateral')
	<div>
    <ul class="list-group">
      <a href="{{ route('home') }}" class="list-group-item list-group-item-action list-group-item-secondary fas fa-globe"><span>Home</span></a>
      <a href="{{ url('/incidente')}}?fecha{{ Date('Y-m-d') }}" class="list-group-item list-group-item-action list-group-item-secondary far fa-file-alt"><span>Incidentes</span></a>
      <!--INFOMACION DEL DATEPIKER -->
      <div class="input-append date" id="datepicker"></div>

    </ul>
  </div>
@endsection

@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;">
				<h4 style="font-size: 20px;font-weight: bold;">Incidente #{{ $incidente->id }} | <span class="span-{{$incidente->impacto->nombre}}"></span> Prioridad: {{ $incidente->impacto->nombre }}</h4>
				<h6 style="font-size: 15px;">{{
					$incidente->catalogo_incidente->subcategoria->categoria->nombre
					." | ".
					$incidente->catalogo_incidente->subcategoria->nombre
					." | ".
					$incidente->catalogo_incidente->clave
					." | ".
					 $incidente->catalogo_incidente->nombre
				}}</h6>
			</label>
			<div class="align-self-center">
				<a href="{{ url('/incidente')}}?fecha={{ $incidente->fecha_ocurrencia }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
				<a href="{{ route('incidente.edit',['incidente'=>$incidente]) }}" class="btn boton1 m-2 {{ $incidente->incidente_siguiente || $incidente->seguimiento->nombre == 'Final' || $incidente->seguimiento->nombre == 'único' ? 'disabled' : '' }}" style="background-color: #da291c !important; color: #f5f5f5;">Actualizar</a>
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
			</div>
			<div class="col-12 col-md-3 col-xl-3">
				<p class="label">
					Hora de Ocurrencia
				</p>
				<p class="info">
					{{$incidente->hora_ocurrencia}}
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
					{{$incidente->catalogo_incidente->subcategoria->categoria->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Subcategoria del Catalogo Nacional de Incidente
				</p>
				<p class="info">
					{{$incidente->catalogo_incidente->subcategoria->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-3 mt-3">
				<p class="label">
					Incidente
				</p>
				<p class="info">
					{{$incidente->catalogo_incidente->nombre}}
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
					{{$incidente->municipio->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-4 mt-3">
				<p class="label">
					Dirección
				</p>
				<p class="info">
					{{$incidente->locacion}}
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
							{{$incidente->medidas_control ? $incidente->medidas_control : '' }}
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
										{{$incidente->dependencia}}
									</p>
								</div>
								<div class="col-12">
									<p class="label">
										Nombre
									</p>
									<p class="info">
										{{$incidente->nombre_empleado}}
									</p>
								</div>
								<div class="col-12">
									<p class="label">
										Cargo
									</p>
									<p class="info">
										{{$incidente->cargo_empleado}}
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center mt-5">
					<a class="btn boton1 m-2 {{ $incidente->incidente_previo ? '' : 'disabled' }}" href="{{ $incidente->incidente_previo ? route('incidente.show',['incidente'=>$incidente->incidente_previo]) : '#' }}" style="background-color: #f5f5f5 !important; color: #231f20;">Incidente Previo</a>
					<a href="{{ route('pdf.incidente.show',['incidente'=>$incidente]) }}" target="__blank" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Descargar PDF</a>
					<a class="btn boton1 m-2 {{ $incidente->incidente_siguiente ? '' : 'disabled' }}" href="{{ $incidente->incidente_siguiente ? route('incidente.show',['incidente'=>$incidente->incidente_siguiente]) : '#' }}" style="background-color: #da291c !important; color: #f5f5f5;">Incidente Siguiente</a>
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