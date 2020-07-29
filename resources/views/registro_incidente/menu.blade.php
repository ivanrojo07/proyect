{{-- Titulo de la pestaña --}}
@section('titulo')
	{{$titulo}}
@endsection

{{-- estilos --}}
@section('estilos')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.flexdatalist.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
  	<style type="text/css">
  		#map{
		    width: 100% !important;
		    height: 36vh !important;
		    position: relative !important;
		    overflow: hidden !important;
		}
  		table, th, td {
          /*border: 2px solid #48484b;*/
      }
      .info{
		font-size: 15px;
      }
      .label{
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
        padding: 1px 15px;
      }
      .Medio{
        border-left: solid 5px #ffc300;
        padding: 1px 15px;
      }
      .Alto{
        border-left: solid 5px #b3282d;
        padding: 1px 15px;
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
  <a href="#"  data-toggle="modal" data-target="#searchUser"><span role="button" class="glbl glbl-search"  title="Buscar"></span></a>
	<a href="{{ route('incidente.create') }}"><span role="button" class="glbl glbl-more"  title="Registrar"></span></a>
@endsection

{{-- Titulo de sidebar --}}
@section('titulopanel')
	{{-- <div  class="titulo-menu"> --}}

        <h5 style="color: black;">Incidentes 
        </h5>
        
    {{-- </div> --}}
@endsection

{{-- Contenido del sidebar --}}
@section('panellateral')
	<div>
    <ul class="list-group">
      <a href="{{ route('home') }}" class="list-group-item list-group-item-action list-group-item-secondary fas fa-globe"><span>Home</span></a>
      <a href="{{ url('/incidente')}}?fecha{{ $fecha }}" class="list-group-item list-group-item-action list-group-item-secondary far fa-file-alt"><span>Incidentes</span></a>
      <!--INFOMACION DEL DATEPIKER -->
      <div class="input-append date" id="datepicker"></div>

    </ul>
  </div>
@endsection

@section('modal')
  <!-- The Modal -->
  <div class="modal" id="searchUser">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-dark">Buscar Incidentes</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a onclick="cambiarFormulario('tipo')" class="nav-link active" id="pills-tipo-tab" data-toggle="pill" href="#pills-tipo" role="tab" aria-controls="pills-tipo" aria-selected="true">Tipo de Seguimiento</a>
          </li>
          <li class="nav-item">
            <a onclick="cambiarFormulario('serie')" class="nav-link" id="pills-serie-tab" data-toggle="pill" href="#pills-serie" role="tab" aria-controls="pills-serie" aria-selected="false">Número de serie</a>
          </li>
        </ul>

        {{-- formulario search --}}
        <form action="{{ route('incidente.index') }}" method="GET">
          
          <!-- Modal body -->
          <div class="modal-body bg-secondary text-white">
            <div class="tab-content m-3" id="pills-tabContent">
              <div class="tab-pane fade show active bg-secondary" id="pills-tipo" role="tabpanel" aria-labelledby="pills-tipo-tab">
                <div class="col-12 offset-md-3 col-md-6">
                  <label for="tipo" class="label">
                    Tipo de Seguimiento
                  </label>
                  <select name="tipo" id="tipo" class="form-control">
                    <option value="">Seleccione una opción</option>
                    @foreach ($tipo_seguimientos as $seguimiento)
                      <option value="{{$seguimiento->id}}">{{$seguimiento->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="tab-pane fade bg-secondary" id="pills-serie" role="tabpanel" aria-labelledby="pills-serie-tab">
                <div class="col-12 offset-md-3 col-md-6">
                  <label for="serie" class="label">
                    Número de Serie
                  </label>
                  <input type="text" name="serie" id="serie" class="form-control">
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer bg-secondary text-white d-flex justify-content-around">
            <input type="hidden" name="fecha" id="fecha" value="{{$fecha}}">
            <button type="submit" class="btn btn-success">Buscar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
          
        </form>
        
      </div>
    </div>
  </div>

  

@endsection
