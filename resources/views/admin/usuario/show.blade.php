@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	{{ $usuario->full_name." / ".$usuario->institucion->nombre }}
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
	<a href="{{ route('admin.usuarios.create') }}"><span role="button" class="glbl glbl-more"  title="Registrar"></span></a>
@endsection

{{-- Titulo de sidebar --}}
@section('titulopanel')
	<div  class="titulolateral">
        <h5>Administración de usuarios 
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
	      <a href="{{ route('admin.usuarios.index') }}" class="list-group-item list-group-item-action list-group-item-secondary far fa-file-alt"><span>Usuarios</span></a>
	    </ul>
  	</div>
@endsection

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;">
				<h4 style="font-size: 20px;font-weight: bold;">Usuario {{ $usuario->full_name }} | Institución: {{ $usuario->institucion->nombre }}</h4>
				
			</label>
			<div class="align-self-center">
				<form action="{{ route('admin.usuarios.destroy',['usuario'=>$usuario]) }}" method="POST">
					<a href="{{ route('admin.usuarios.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<a href="{{ route('admin.usuarios.edit',['usuario'=>$usuario]) }}" class="btn boton1 m-2" style="background-color: #da291c !important; color: #f5f5f5;">Actualizar</a>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Eliminar</button>
				</form>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="{{ route('admin.usuarios.index') }}" style="color: white;"  class="">Incidentes</a></li>
		  	<li ><a  href="{{ route('admin.usuarios.show',['usuario'=>$usuario]) }}"  style="color: white;" class="activo" >Información del Usuario </a></li>
		</ul>
	</div>
	<div class="panel-body pb-3">
		<div class="row form-group">
			<div class="col-12 col-md-3">
				<p class="label">
					Nombre(s)
				</p>
				<p class="info">
					{{$usuario->nombre}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Apellido Paterno
				</p>
				<p class="info">
					{{$usuario->apellido_paterno}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Apellido Materno
				</p>
				<p class="info">
					{{$usuario->apellido_materno}}
				</p>
			</div>
			<div class="col-12 col-md-3">
				<p class="label">
					Email
				</p>
				<p class="info">
					{{$usuario->email}}
				</p>
			</div>
		</div>
		<div id="accordion" class="row form-group">
			@if ($usuario->institucion)
				<div class="col-12 mt-2">
					<h4 class="text-center">
						{{$usuario->institucion->tipo_institucion." / ".$usuario->institucion->nombre}}

					</h4>
				</div>
				@if ($usuario->institucion->municipios->isNotEmpty())
					<div class="col-12 mt-2">
						<h4 class="text-center">
							MUNICIPIOS
						</h4>
					</div>
					@foreach ($usuario->institucion->municipios as $municipio)
						<div class="col-12 col-md-4 mt-2 mb-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_municipio_{{$municipio->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_municipio_{{$municipio->id}}" aria-expanded="true" aria-controls="collapse_municipio_{{$municipio->id}}">
											{{$municipio->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_municipio_{{$municipio->id}}" aria-labelledby="heading_municipio_{{$municipio->id}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											<li>
												{{$municipio->nombre}}
											</li>
											<ul>
												@foreach ($municipio->localidads as $localidad)
													<li>
														{{$localidad->nombre}}
													</li>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="col-12 mt-2">
						<h4 class="text-center">
							ESTADOS
						</h4>
					</div>
					@foreach ($usuario->institucion->estados as $estado)
						<div class="col-12 col-md-3 mt-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_estado_{{$estado->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_estado_{{$estado->id}}" aria-expanded="true" aria-controls="collapse_estado_{{$estado->id}}">
											{{$estado->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_estado_{{$estado->id}}" aria-labelledby="heading_estado_{{$estado->id}}" data-parent="#accordion">
									<div class="card-body">
										<ul>
											<li>
												{{$estado->nombre}}
											</li>
											<ul>
												@foreach ($estado->municipios as $municipio)
													<li>
														{{$municipio->nombre}}
													</li>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if ($usuario->institucion->categorias_incidente->isNotEmpty())
					<div class="col-12 mt-2">
						<h4 class="text-center">
							CATALOGO NACIONAL DE INCIDENTES
						</h4>
					</div>
					@foreach ($usuario->institucion->categorias_incidente as $categoria)
						<div class="col-12 col-md-3 mt-2">
							<div class="card">
								<div class="card-header bg-dark" id="heading_categoria_{{$categoria->id}}">
									<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_categoria_{{$categoria->id}}" aria-expanded="true" aria-controls="collapse_categoria_{{$categoria->id}}">
											{{$categoria->nombre}}
										</button>
									</h5>
								</div>
								<div class="collapse" id="collapse_categoria_{{$categoria->id}}" aria-labelledby="heading_categoria_{{$categoria->id}}" data-parent="#accordion">
									<div class="card-body">
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
														@foreach ($subcategoria->catalogos as $catalogo)
															<li>
																{{$catalogo->nombre}}
															</li>
														@endforeach
													</ul>
												@endforeach
											</ul>
										</ul>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			@endif
		</div>
	</div>
@endsection

@section('content')
	<div class="container-fluid d-flex">
		<div class="w-25 p-3 mr-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>Usuario</h4>
				</div>
				<div class="card-body">
					<a href="{{ route('admin.usuarios.create') }}" class="btn btn-block btn-info">Nuevo usuario</a>
				</div>
			</div>
		</div>
		<div class="w-75">
			<div class="card text-white bg-secondary">
				<div class="card-header bg-dark">
					{{$usuario->full_name}}
				</div>
				<div class="card-body table-responsive">
					<div class="row form-group">
						<div class="col-12 col-md-3">
							<label for="nombre" class="text-md-left col-form-label">
								Nombre
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->nombre }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="apellido_paterno" class="text-md-left col-form-label">
								Apellido Paterno
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->apellido_paterno }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="apellido_materno" class="text-md-left col-form-label">
								Apellido Materno
							</label>
							<input class="form-control" type="text" readonly="" value="{{ $usuario->apellido_paterno }}">
						</div>
						<div class="col-12 col-md-3">
							<label for="email" class="text-md-left col-form-label">
								Correo electrónico
							</label>
							<input class="form-control" type="email" readonly="" value="{{ $usuario->email }}">
						</div>
					</div>
					<div id="accordion" class="row form-group">
						@if ($usuario->institucion)
							<div class="col-12 mt-2">
								<h4 class="text-center">
									{{$usuario->institucion->tipo_institucion." / ".$usuario->institucion->nombre}}

								</h4>
							</div>
							@if (empty($usuario->institucion->municipios))
								<div class="col-12 mt-2">
									<h4 class="text-center">
										MUNICIPIOS
									</h4>
								</div>
								@foreach ($usuario->institucion->municipios as $municipio)
									<div class="col-12 col-md-4 mt-2 mb-2">
										<div class="card">
											<div class="card-header" id="heading_municipio_{{$municipio->id}}">
												<h5 class="mb-0">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_municipio_{{$municipio->id}}" aria-expanded="true" aria-controls="collapse_municipio_{{$municipio->id}}">
														{{$municipio->nombre}}
													</button>
												</h5>
											</div>
											<div class="collapse" id="collapse_municipio_{{$municipio->id}}" aria-labelledby="heading_municipio_{{$municipio->id}}" data-parent="#accordion">
												<div class="card-body">
													<ul>
														<li>
															{{$municipio->nombre}}
														</li>
														<ul>
															@foreach ($municipio->localidads as $localidad)
																<li>
																	{{$localidad->nombre}}
																</li>
															@endforeach
														</ul>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@else
								<div class="col-12 mt-2">
									<h4 class="text-center">
										ESTADOS
									</h4>
								</div>
								@foreach ($usuario->institucion->estados as $estado)
									<div class="col-12 col-md-3 mt-2 mb-2">
										<div class="card">
											<div class="card-header bg-dark" id="heading_estado_{{$estado->id}}">
												<h5 class="mb-0">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_estado_{{$estado->id}}" aria-expanded="true" aria-controls="collapse_estado_{{$estado->id}}">
														{{$estado->nombre}}
													</button>
												</h5>
											</div>
											<div class="collapse" id="collapse_estado_{{$estado->id}}" aria-labelledby="heading_estado_{{$estado->id}}" data-parent="#accordion">
												<div class="card-body text-dark">
													<ul>
														<li>
															{{$estado->nombre}}
														</li>
														<ul>
															@foreach ($estado->municipios as $municipio)
																<li>
																	{{$municipio->nombre}}
																</li>
															@endforeach
														</ul>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif

							@if ($usuario->institucion->categorias_incidente->isNotEmpty())
								<div class="col-12 mt-2">
									<h4 class="text-center">
										CATALOGO NACIONAL DE INCIDENTES
									</h4>
								</div>
								@foreach ($usuario->institucion->categorias_incidente as $categoria)
									<div class="col-12 col-md-3 mt-2 mb-2">
										<div class="card">
											<div class="card-header bg-dark" id="heading_categoria_{{$categoria->id}}">
												<h5 class="mb-0">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapse_categoria_{{$categoria->id}}" aria-expanded="true" aria-controls="collapse_categoria_{{$categoria->id}}">
														{{$categoria->nombre}}
													</button>
												</h5>
											</div>
											<div class="collapse" id="collapse_categoria_{{$categoria->id}}" aria-labelledby="heading_categoria_{{$categoria->id}}" data-parent="#accordion">
												<div class="card-body text-dark">
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
																	@foreach ($subcategoria->catalogos as $catalogo)
																		<li>
																			{{$catalogo->nombre}}
																		</li>
																	@endforeach
																</ul>
															@endforeach
														</ul>
													</ul>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						@endif
					</div>
				</div>
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					<a class="btn btn-warning" href="{{ route('admin.usuarios.edit',['usuario'=>$usuario]) }}">Editar</a>
					<form action="{{ route('admin.usuarios.destroy',['usuario'=>$usuario]) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
@endsection