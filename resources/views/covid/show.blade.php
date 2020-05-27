@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	Registro #{{$covid->id}}
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
      	.info{
			font-size: 15px;
      	}
      	.label{
      		color: #FFA500;
      		font-size: 15px;
      	}
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
	<a href="{{ route('covid.create') }}"><span role="button" class="glbl glbl-more"  title="Registrar"></span></a>
@endsection

{{-- Titulo de sidebar --}}
@section('titulopanel')
	<div  class="titulolateral">
        <h5>Registro COVID-19 
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
	      <a href="{{ route('covid.index') }}" class="list-group-item list-group-item-action list-group-item-secondary far fa-file-alt"><span>COVID-19</span></a>
	      <!--INFOMACION DEL DATEPIKER -->
      		<div class="input-append date" id="datepicker"></div>
	    </ul>
  	</div>
@endsection

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left: 1%;">
				<h4 style="font-size: 20px; font-weight: bold;">
					Folio #{{$covid->id}} | {{$covid->fecha}}
				</h4>
			</label>
			<div class="align-self-center">
				<a href="{{ route('covid.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="{{ route('covid.index') }}" style="color: white;" >Covid</a></li>
			<li ><a   href="#"  style="color: white;" class="activo" >Crear COVID-19 </a></li>
		</ul>
	</div>
	<div class="panel-body pb-4">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="text-center text-white">
			<h3>Perfil Usuario</h3>
		</div>
		<div class="row form-group"> 
		 	<div class="col-12 col-md-4">
			 	<label class="label">Edad</label>
			 	<p class="info">{{$perfil->edad." Años"}}</p>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="genero" class="label">
			 		Genero 
			 	</label>
			 	<p class="info">
			 		{{$perfil->genero}}
			 	</p>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="codigo_postal" class="label">Código Postal</label>
			 	<p class="info">{{$perfil->codigo_postal}}</p>
			</div>
		</div>
		<div class="text-center text-white">
			<h3>Test COVID-19</h3>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="convivir_enfermo" class="label">
					¿Has convivido con alguna persona que sea un caso confirmado de COVID-19 (Coronavirus)?
				</label>
				<p class="info">
					{{$covid->convivir_enfermo == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="fiebre" class="label">
					¿Tienes fiebre? (Temperatura igual o mayor a 38ºC)
				</label>
				<p class="info">
					{{$covid->fiebre == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_cabeza" class="label">
					¿Tienes dolor de cabeza?
				</label>
				<p class="info">
					{{$covid->dolor_cabeza == 1 ? 'Si' : 'No'}}
				</p>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="tos" class="label">
					¿Tienes tos?
				</label>
				<p class="info">
					{{$covid->tos == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_pecho" class="label">
					¿Tienes dolor en el pecho?
				</label>
				<p class="info">
					{{$covid->dolor_pecho == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_garganta" class="label">
					¿Tienes dolor de garganta?
				</label>
				<p class="info">
					{{$covid->dolor_garganta == 1 ? 'Si' : 'No'}}
				</p>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="dificultad_respirar" class="label">
					¿Tienes dificultad para respirar?
				</label>
				<p class="info">
					{{$covid->dificultad_respirar == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="escurrimiento_nasal" class="label">
					¿Tienes escurrimiento nasal?
				</label>
				<p class="info">
					{{$covid->escurrimiento_nasal == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_cuerpo" class="label">
					¿Tienes dolor en el cuerpo?
				</label>
				<p class="info">
					{{$covid->dolor_cuerpo == 1 ? 'Si' : 'No'}}
				</p>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="conjuntivitis" class="label">
					¿Tienes conjuntivitis?
				</label>
				<p class="info">
					{{$covid->conjuntivitis == 1 ? 'Si' : 'No'}}
				</p>
			</div>
			<div class="col-12 col-md-8">
				<label for="condiciones_medicas" class="label">
					¿Tienes alguna de las siguientes condiciones? (diabetes, hipertensión, obesidad, problemas cardiacos, asma, EPOC, VIH, cáncer)
				</label>
				<p class="info">
					{{$covid->condiciones_medicas == 1 ? 'Si' : 'No'}}
				</p>
			</div>
		</div>
		@if ($perfil->genero == "Mujer")
			<div class="form-group row">
				<div class="col-12 col-md-6">
					<label for="embarazada" class="label">
						¿Estás embarazada?
					</label>
					<p class="info">
						{{$covid->embarazada == 1 ? 'Si' : 'No'}}
					</p>
				</div>
				<div class="col-12 col-md-6">
					<label for="meses_embarazo" class="label">
						¿Tienes 6 o más meses de embarazo?
					</label>
					<p class="info">
						{{$covid->meses_embarazo == 1 ? 'Si' : 'No'}}
					</p>
				</div>
			</div>
		@endif
		@if ($covid->rango > 8)
			<div class="form-group row">
				<div class="col-12 col-md-4 col-lg-3">
					<label for="dias_sintomas" class="label">
						¿Hace cuántos días iniciaron tus síntomas? Escribe el número de días, si iniciaron hoy responde "0"
					</label>
					<p class="info">
						{{$covid->dias_sintomas}} Días
					</p>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<label for="dolor_respirar" class="label">
						¿Sientes dolor al respirar?
					</label>
					<p class="info">
						{{$covid->dolor_respirar == 1 ? 'Si' : 'No'}}
					</p>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<label for="falta_aire" class="label">¿Sientes falta de aire al hablar o caminar algunos pasos?</label>
					<p class="info">
						{{$covid->falta_aire == 1 ? 'Si' : 'No'}}
					</p>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<label for="coloracion_azul" class="label">¿Tienes coloración azul o morada en labios, dedos o uñas?</label>
					<p class="info">
						{{$covid->coloracion_azul == 1 ? 'Si' : 'No'}}
					</p>
				</div>
			</div>
		@endif
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

           window.location = "{{ url('/covid')}}"+"?fecha="+nuevafecha;
         },
         maxDate: 0
        });
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($covid->fecha))}}" );
    </script>
@endsection