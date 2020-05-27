@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	Nuevo Registro
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
<form method="POST" action="{{ route('covid.store') }}">
	@csrf
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left: 1%;">
				<h4 style="font-size: 20px; font-weight: bold;">
					Nuevo Registro COVID-19
				</h4>
			</label>
			<div class="align-self-center">
				<a href="{{ route('covid.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
				<button type="submit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Registrar</button>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li ><a  href="{{ route('covid.index') }}" style="color: white;" >Covid</a></li>
			<li ><a  href="#"  style="color: white;" class="activo" >Crear COVID-19 </a></li>
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
		<div class="row"> 
			<div class="col-12 col-md-4">
			 	<label for="edad" class="label">Edad</label>
			 	<div class="input-group mb-3">
			 		<input type="number" class="form-control" name="edad" id="edad" min="0" max="120" value="{{ old('edad') }}">
			 		<div class="input-group-append">
			 			<span class="input-group-text">
			 				Años
			 			</span>
			 		</div>
			 	</div>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="genero" class="label">
			 		Genero
			 	</label>
			 	<select class="form-control" id="genero" name="genero" required="">
			 		<option value="">Seleccione una opción</option>
			 		<option value="Mujer" {{ old('genero') == "Mujer" ? "selected=''" : "" }}>Mujer</option>
			 		<option value="Hombre" {{ old('genero') == "Hombre" ? "selected=''" : "" }}>Hombre</option>
			 	</select>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="codigo_postal" class="label">Código Postal</label>
			 	<input type="text" class="form-control" pattern="[0-9]{5}" name="codigo_postal" id="codigo_postal" title="El código postal consta de 5 números" value="{{ old('codigo_postal') }}">
			</div>
		</div>
		<div class="text-center text-white">
			<h5>Test COVID-19</h5>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="convivir_enfermo" class="label">
					¿Has convivido con alguna persona que sea un caso confirmado de COVID-19 (Coronavirus)?
				</label>
				<select class="form-control" id="convivir_enfermo" name="convivir_enfermo" required="">
					<option value="">Seleccione una opción</option>
					<option data-convivir_enfermo="3" value="1" {{ old('convivir_enfermo') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-convivir_enfermo="0" value="0" {{ old('convivir_enfermo') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="fiebre" class="label">
					¿Tienes fiebre? (Temperatura igual o mayor a 38ºC)
				</label>
				<select class="form-control" id="fiebre" name="fiebre" required="">
					<option value="">Seleccione una opción</option>
					<option data-fiebre="2" value="1" {{ old('fiebre') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-fiebre="0" value="0" {{ old('fiebre') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_cabeza" class="label">
					¿Tienes dolor de cabeza?
				</label>
				<select class="form-control" id="dolor_cabeza" name="dolor_cabeza">
					<option value="">Seleccione una opción</option>
					<option data-dolor_cabeza="1" value="1" {{ old('dolor_cabeza') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-dolor_cabeza="0" value="0" {{ old('dolor_cabeza') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="tos" class="label">
					¿Tienes tos?
				</label>
				<select class="form-control" id="tos" name="tos" required="">
					<option value="">Seleccione una opción</option>
					<option data-tos="2" value="1" {{ old('tos') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-tos="0" value="0" {{ old('tos') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_pecho" class="label">
					¿Tienes dolor en el pecho?
				</label>
				<select class="form-control" id="dolor_pecho" name="dolor_pecho" required="">
					<option value="">Seleccione una opción</option>
					<option data-dolor_pecho="1" value="1" {{ old('dolor_pecho') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-dolor_pecho="0" value="0" {{ old('dolor_pecho') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_garganta" class="label">
					¿Tienes dolor de garganta?
				</label>
				<select class="form-control" id="dolor_garganta" name="dolor_garganta" required="">
					<option value="">Seleccione una opción</option>
					<option data-dolor_garganta="1" value="1" {{ old('dolor_garganta') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-dolor_garganta="0" value="0" {{ old('dolor_garganta') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="dificultad_respirar" class="label">
					¿Tienes dificultad para respirar?
				</label>
				<select class="form-control" id="dificultad_respirar" name="dificultad_respirar" required="">
					<option value="">Seleccione una opción</option>
					<option data-dificultad_respirar="2" value="1" {{ old('dificultad_respirar') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-dificultad_respirar="0" value="0" {{ old('dificultad_respirar') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="escurrimiento_nasal" class="label">
					¿Tienes escurrimiento nasal?
				</label>
				<select class="form-control" id="escurrimiento_nasal" name="escurrimiento_nasal" required="">
					<option value="">Seleccione una opción</option>
					<option data-escurrimiento_nasal="2" value="1" {{ old('escurrimiento_nasal') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-escurrimiento_nasal="0" value="0" {{ old('escurrimiento_nasal') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4">
				<label for="dolor_cuerpo" class="label">
					¿Tienes dolor en el cuerpo?
				</label>
				<select class="form-control" id="dolor_cuerpo" name="dolor_cuerpo" required="">
					<option value="">Seleccione una opción</option>
					<option data-dolor_cuerpo="2" value="1" {{ old('dolor_cuerpo') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-dolor_cuerpo="0" value="0" {{ old('dolor_cuerpo') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-12 col-md-4">
				<label for="conjuntivitis" class="label">
					¿Tienes conjuntivitis?
				</label>
				<select class="form-control" id="conjuntivitis" name="conjuntivitis" required="">
					<option value="">Seleccione una opción</option>
					<option data-conjuntivitis="1" value="1" {{ old('conjuntivitis') == '1' ? "selected=''" : "" }} >Si</option>
					<option data-conjuntivitis="0" value="0" {{ old('conjuntivitis') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-8">
				<label for="condiciones_medicas" class="label">
					¿Tienes alguna de las siguientes condiciones? (diabetes, hipertensión, obesidad, problemas cardiacos, asma, EPOC, VIH, cáncer)
				</label>
				<select class="form-control" id="condiciones_medicas" name="condiciones_medicas" required="">
					<option value="">Seleccione una opción</option>
					<option data-condiciones_medicas="2" value="1" {{ old('condiciones_medicas') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-condiciones_medicas="0" value="0" {{ old('condiciones_medicas') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
		</div>
		<div class="form-group row d-none" id="only_woman">
			<div class="col-12 col-md-6">
				<label for="embarazada" class="label">
					¿Estás embarazada?
				</label>
				<select class="form-control" id="embarazada" name="embarazada">
					<option value="">Seleccione una opción</option>
					<option data-embarazada="2" value="1" {{ old('embarazada') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-embarazada="0" value="0" {{ old('embarazada') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-6">
				<label for="meses_embarazo" class="label">
					¿Tienes 6 o más meses de embarazo?
				</label>
				<select class="form-control" id="meses_embarazo" name="meses_embarazo">
					<option value="">Seleccione una opción</option>
					<option data-meses_embarazo="2" value="1" {{ old('meses_embarazo') == '1' ? "selected=''" : "" }}>Si</option>
					<option data-meses_embarazo="0" value="0" {{ old('meses_embarazo') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
		</div>
		<div class="form-group row d-none" id="more_info">
			<div class="col-12 col-md-4 col-lg-3">
				<label for="dias_sintomas" class="label">
					¿Hace cuántos días iniciaron tus síntomas? Escribe el número de días, si iniciaron hoy responde "0"
				</label>
				<input class="form-control " type="number" name="dias_sintomas" id="dias_sintomas" step="1" min="-1" value="{{ old('dias_sintomas') }}">
			</div>
			<div class="col-12 col-md-4 col-lg-3">
				<label for="dolor_respirar" class="label">
					¿Sientes dolor al respirar?
				</label>
				<select class="form-control" name="dolor_respirar" id="dolor_respirar">
					<option value="">Seleccione una opción</option>
					<option data-dolor_respirar="3" value="1" {{ old('dolor_respirar') == '1' ? "selected=''" : "" }}>Si</option>
					<option value="0" data-dolor_respirar="0" {{ old('dolor_respirar') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4 col-lg-3">
				<label for="falta_aire" class="label">¿Sientes falta de aire al hablar o caminar algunos pasos?</label>
				<select name="falta_aire" id="falta_aire" class="form-control">
					<option value="">Seleccione una opción</option>
					<option value="1" data-falta_aire="3" {{ old('falta_aire') == '1' ? "selected=''" : "" }}>Si</option>
					<option value="0" data-falta_aire="0" {{ old('falta_aire') == '0' ? "selected=''" : "" }}>No</option>
				</select>
			</div>
			<div class="col-12 col-md-4 col-lg-3">
				<label for="coloracion_azul" class="label">¿Tienes coloración azul o morada en labios, dedos o uñas?</label>
				<select name="coloracion_azul" id="coloracion_azul" class="form-control">
					<option value="">Seleccione una opción</option>
					<option value="1" data-coloracion_azul="3" {{ old('coloracion_azul') == '1' ? "selected=''" : "" }}>Si</option>
					<option value="0" data-coloracion_azul="0" {{ old('coloracion_azul') == '0' ? "selected=''" : "" }}>No</option>
				</select>
				<input type="hidden" id="score" name="score" value="{{ old('score') }}">
			</div>
		</div>
	</div>
</form>
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
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y')}}" );
    </script>
    <script type="text/javascript">
		$("#genero").change(function(){
			if ($(this).val() == "Mujer") {
				$("#only_woman").removeClass("d-none").addClass("d-flex");
				$("#embarazada").attr("required",true);
				$("#meses_embarazo").attr("required",true);
			}
			else{
				$("#only_woman").removeClass("d-flex").addClass("d-none");
				$("#embarazada").val("").removeAttr("required");
				$("#meses_embarazo").val("").removeAttr("required");
			}
		});
		$("select").change(function(){
			getScore();
		});
		$("#dias_sintomas").change(function(){
			getScore();
		});

		function getScore() {
			var score= 0;
			var value_convivirEnfermo = $("#convivir_enfermo").children("option:selected").attr('data-convivir_enfermo') ?  $("#convivir_enfermo").children("option:selected").attr('data-convivir_enfermo') : 0;
			console.log(value_convivirEnfermo);
			score += + value_convivirEnfermo;
			var value_fiebre = $("#fiebre").children("option:selected").attr('data-fiebre') ? $("#fiebre").children("option:selected").attr('data-fiebre') : 0;
			console.log(value_fiebre);
			score += + value_fiebre;
			var value_dolorCabeza = $("#dolor_cabeza").children('option:selected').attr("data-dolor_cabeza") ? $("#dolor_cabeza").children('option:selected').attr("data-dolor_cabeza") : 0;
			console.log(value_dolorCabeza);
			score += + value_dolorCabeza;
			var value_tos = $("#tos").children('option:selected').attr("data-tos") ? $("#tos").children('option:selected').attr("data-tos") : 0;
			console.log(value_tos);
			score += + value_tos;
			var dolorPecho = $("#dolor_pecho").children('option:selected').attr("data-dolor_pecho") ? $("#dolor_pecho").children('option:selected').attr("data-dolor_pecho") : 0;
			console.log(dolorPecho);
			score += + dolorPecho;
			var dolorGarganta = $("#dolor_garganta").children('option:selected').attr("data-dolor_garganta") ? $("#dolor_garganta").children('option:selected').attr("data-dolor_garganta") : 0;
			console.log(dolorGarganta);
			score += + dolorGarganta;
			var dificultadRespirar = $("#dificultad_respirar").children('option:selected').attr("data-dificultad_respirar") ? $("#dificultad_respirar").children('option:selected').attr("data-dificultad_respirar") : 0;
			console.log(dificultadRespirar);
			score += + dificultadRespirar;
			var escurrimientoNasal = $("#escurrimiento_nasal").children('option:selected').attr('data-escurrimiento_nasal') ? $("#escurrimiento_nasal").children('option:selected').attr('data-escurrimiento_nasal') : 0;
			score += + escurrimientoNasal;
			var dolorCuerpo = $("#dolor_cuerpo").children('option:selected').attr('data-dolor_cuerpo') ? $("#dolor_cuerpo").children('option:selected').attr('data-dolor_cuerpo') : 0;
			score += + dolorCuerpo;
			var conjuntivitis = $("#conjuntivitis").children("option:selected").attr('data-conjuntivitis') ? $("#conjuntivitis").children("option:selected").attr('data-conjuntivitis') : 0;
			score += + conjuntivitis;
			var condicionesMedicas = $("#condiciones_medicas").children("option:selected").attr("data-condiciones_medicas") ? $("#condiciones_medicas").children("option:selected").attr("data-condiciones_medicas") : 0;
			score += + condicionesMedicas;
			var embarazada = $("#embarazada").children("option:selected").attr("data-embarazada") ? $("#embarazada").children("option:selected").attr("data-embarazada") : 0;
			score += + embarazada;
			var mesesEmbarazo = $("#meses_embarazo").children("option:selected").attr("data-meses_embarazo") ? $("#meses_embarazo").children("option:selected").attr("data-meses_embarazo") : 0;
			score += + mesesEmbarazo;
			var dolorRespirar = $("#dolor_respirar").children("option:selected").attr("data-dolor_respirar") ? $("#dolor_respirar").children("option:selected").attr("data-dolor_respirar") : 0;
			score += + dolorRespirar;
			var faltaAire = $("#falta_aire").children("option:selected").attr("data-falta_aire") ? $("#falta_aire").children("option:selected").attr("data-falta_aire") : 0;
			score += + faltaAire;
			var coloracionAzul = $("#coloracion_azul").children("option:selected").attr("data-coloracion_azul") ? $("#coloracion_azul").children("option:selected").attr("data-coloracion_azul") : 0;
			score += + coloracionAzul;
			if (score > 8) {
				$("#more_info").removeClass("d-none").addClass("d-flex");
				$("#dias_sintomas").attr("required",true);
				$("#falta_aire").attr("required",true);
				$("#dolor_respirar").attr("required",true);
				$("#coloracion_azul").attr("required",true);

			}
			else{
				$("#more_info").removeClass("d-flex").addClass("d-none");
				$("#dias_sintomas").val(-1).removeAttr("required");
				$("#falta_aire").val("").removeAttr("required");
				$("#dolor_respirar").val("").removeAttr("required");
				$("#coloracion_azul").val("").removeAttr("required");
			}

			var diasSintomas = $("#dias_sintomas").val();
			if (diasSintomas == 0) {
				score += + 1;
			}
			else if(diasSintomas >0 && diasSintomas <= 3){
				score += + 2;
			}
			else if (diasSintomas >3 &&  diasSintomas <= 7) {
				score += + 3;
			}
			else if(diasSintomas == -1){
				score += + 0
			}
			else{
				score += + 4;
			}

			$("#score").val(score);
		}
	</script>
@endsection