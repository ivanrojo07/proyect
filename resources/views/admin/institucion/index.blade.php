@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	Instituciones
@endsection

{{-- estilos --}}
@section('estilos')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.flexdatalist.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
  	<style type="text/css">
  		table, th, td {
          /*border: 2px solid #48484b;*/
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
	<a href="{{ route('admin.institucion.create') }}"><span role="button" class="glbl glbl-more"  title="Registrar"></span></a>
@endsection

{{-- Titulo de sidebar --}}
@section('titulopanel')
	<div  class="titulolateral">
        <h5>Administración de instituciones 
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
	      <a href="{{ route('admin.institucion.index') }}" class="list-group-item list-group-item-action list-group-item-secondary far fa-file-alt"><span>Instituciones</span></a>
	    </ul>
  	</div>
@endsection

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