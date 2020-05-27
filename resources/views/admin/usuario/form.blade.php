@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	{{ $edit ? "Editar a $user->full_name" : "Nuevo Usuario" }}
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
	<form action="{{ $edit ? route('admin.usuarios.update',['usuario'=>$user]) : route('admin.usuarios.store') }}" method="POST">
		@csrf
		@if ($edit)
			@method('PUT')
		@endif
		<div class="panel-content">
			<div class="col-12 d-flex justify-content-between">
				<label style="margin-top:1%;margin-left:1%;">
					<h4 style="font-size: 20px;font-weight: bold;">{{ $edit ? "Actualizar a $user->full_name" : "Nuevo usuario" }}</h4>
					
				</label>
				<div class="align-self-center">

					<a href="{{ route('admin.usuarios.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<button type="submit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">{{$edit ? "Actualizar" : "Registrar"}}</button>
				</div>
			</div>
			<ul class="nav nav-tabs">
				<li ><a  href="{{ route('admin.usuarios.index') }}" style="color: white;"  class="">Usuarios</a></li>
			  	<li ><a  href="{{ $edit ? route('admin.usuarios.show',['usuario'=>$user]) : route('admin.usuarios.index') }}"  style="color: white;" class="activo" >Información del Usuario </a></li>
			</ul>
		</div>
		<div class="panel-body">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="row form-group mt-3 pb-5">
				<div class="col-12 col-md-4">
					<label for="nombre" class="text-md-left col-form-label">
						Nombre
					</label>
					<input class="form-control" type="text" name="nombre" id="nombre" value="{{ $edit ? $user->nombre : old('nombre') }}">
				</div>
				<div class="col-12 col-md-4">
					<label for="apellido_paterno" class="text-md-left col-form-label">
						Apellido Paterno
					</label>
					<input class="form-control" type="text" name="apellido_paterno" id="apellido_paterno" value="{{ $edit ? $user->apellido_paterno : old('apellido_paterno') }}">
				</div>
				<div class="col-12 col-md-4">
					<label for="apellido_materno" class="text-md-left col-form-label">
						Apellido Materno
					</label>
					<input class="form-control" type="text" name="apellido_materno" id="apellido_materno" value="{{ $edit ? $user->apellido_materno : old('apellido_materno') }}">
				</div>
				<div class="col-12 col-md-3">
					<label for="email" class="text-md-left col-form-label">
						Correo electrónico
					</label>
					<input class="form-control" type="email" name="email" id="email" value="{{ $edit ? $user->email : old('email') }}">
				</div>
				<div class="col-12 col-md-3">
					<label for="password" class="text-md-left col-form-label">
						Contraseña
					</label>
					<input class="form-control" type="password" name="password" id="password">
				</div>
				<div class="col-12 col-md-3">
					<label for="password_confirmation" class="text-md-left col-form-label">
						Repetir contraseña
					</label>
					<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
				</div>
				<div class="col-12 col-md-3">
					<label for="institucion" class="text-md-left col-form-label">
						Institución
					</label>
					<select class="form-control" name="institucion" id="institucion">
						<option value="">Seleccione una opción</option>
						@foreach ($instituciones as $institucion)
							<option value="{{ $institucion->id }}" {{ $edit ? ($user->institucion ? ($user->institucion->id == $institucion->id ? "selected=''" : '') : '') : (old('institucion') == $institucion->id ? "selected=''" : '') }}>{{$institucion->tipo_institucion."/".$institucion->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</form>
@endsection