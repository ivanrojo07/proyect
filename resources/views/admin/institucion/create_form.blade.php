@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	Nueva Institución
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
	<form action="{{ route('admin.institucion.store') }}" method="POST" enctype="multipart/form-data">
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
					<button type="submit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">Registrar</button>
				</div>
			</div>
			<ul class="nav nav-tabs">
				<li ><a  href="{{ route('admin.institucion.index') }}" style="color: white;"  class="activo">Instituciones</a></li>
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
		    <div class="row from-group">
		    	<div class="col-12 col-md-4">
					<label for="nombre" class="label">Nombre de la institución</label>
					<input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
				</div>
				<div class="col-12 col-md-4">
					<label for="header_1" class="label">Imagen principal</label>
					<input type="file" accept="image/*" class="form-control" name="header_1" id="header_1">
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
					<div class="text-center label">
						<h5>Estados/Municipios</h5>
					</div>
					<label for="regiones" class="text-md-left col-form-label">
						Seleccione el tipo de institución que será y las regiones correspondientes
					</label>
					<select class="form-control" id="tipo_institucion" name="tipo_institucion" required="">
						<option value="">Seleccione una opción</option>
						<option value="Estatal">Estatal</option>
						<option value="Municipal">Municipal</option>
						<option value="Federal">Federal/SEDENA</option>
					</select>
					<select class="form-control mt-2 d-none" id="estado" name="estado">
						<option value="">Seleccione el estado correspondiente</option>
						@foreach ($estados as $estado)
							<option value="{{$estado->id}}">{{$estado->nombre}}</option>
						@endforeach
					</select>
					<div class="row form-group d-none" id="div_estados">
						<div class="col-12 mt-2">
							<label class="text-md-left col-form-label">
								Seleccione el o los estados donde se activaran los incidentes
							</label>
						</div>
						@foreach ($estados as $estado)
							<div class="col-12 col-md-6 col-lg-4 mt-2">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="{{$estado->nombre}}" name="estados[]" value="{{$estado->id}}">
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
					</div>
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