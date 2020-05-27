@extends('layouts.layoutBase')

{{-- Titulo de la pestaña --}}
@section('titulo')
	Nuevo Incidente
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
      p.info{
		font-size: 15px;
      }
      label.label{
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

{{-- Contenido --}}
@section('contenido')
  <form method="POST" action="{{ route('incidente.store') }}">
    @csrf
  	<div class="panel-content">
  		<div class="col-12 d-flex justify-content-between">
  			<label style="margin-top: 1%; margin-left: 1%;">
  				<h4 style="font-size: 20px; font-weight: bold;">
  					Registro de un nuevo incidente
  				</h4>
  			</label>
  			<div class="align-self-center">
  				<a href="{{ url('/incidente')}}?fecha={{ Date('Y-m-d') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Cancelar</a>
  				<button class="btn boton1 m-2" type="submit" style="background-color: #da291c !important; color: #f5f5f5;">Registrar</a>
  			</div>
  		</div>
  		<ul class="nav nav-tabs"  >
  			<li ><a  href="{{ url('/incidente')}}?fecha={{ Date('Y-m-d') }}" style="color: white;"  class="">Incidentes</a></li>
  		  	<li ><a  href="{{ route('incidente.create') }}"  style="color: white;" class="activo" >Información del Incidente </a></li>
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
  		<div class="row mb-4">
  			<div class="col-12 col-md-3 mt-2">
  				<label for="subcategoria" class="label">
  					Tipo de Incidente
  				</label>
  				<select class="form-control" id="subcategoria" name="subcategoria" required="">
  					<option value="">Seleccione una categoria</option>
  					@foreach ($subcategorias as $element)
  						<option value="{{$element->id}}" {{old('subcategoria') == $element->id ? 'selected=""' : ''}}>{{$element->categoria->nombre." / ".$element->nombre}}</option>
  					@endforeach
  				</select>
  			</div>
  			<div class="col-12 col-md-3 mt-2">
  				<label for="incidente" class="label">
  					Incidente
  				</label>
  				<select class="form-control" id="incidente" name="incidente" required="">
  					<option value="">Seleccione el incidente</option>
  					
  				</select>
  			</div>
  			<div class="col-12 col-md-3 mt-2">
  				<label for="estado" class="label">
  					Estado
  				</label>
  				<select class="form-control" id="estado" name="estado" required="">
  					<option value="">Seleccione el estado</option>
  					@foreach ($estados as $estado)
  						<option value="{{$estado->id}}" data-edo="{{$estado->nombre}}">{{$estado->nombre}}</option>
  					@endforeach
  				</select>
  			</div>
  			<div class="col-12 col-md-3 mt-2">
  				<label for="municipio" class="label">
  					Municipio
  				</label>
  				<select class="form-control" id="municipio" name="municipio" required="">
  					<option value="">Seleccione el municipio</option>
  				</select>
  			</div>
  		</div>
  		<hr>
  		<div class="row">
  			<div class="col-12 col-md-6">
  				<div class="row">
  					<div class="col-12 mt-2">
  						<label for="descripcion" class="label">Descripción del Incidente:</label>
  						<textarea class="form-control" id="descripcion" name="descripcion" rows="5" required=""></textarea>
  					</div>
  					<div class="col-12 mt-2">
  						<label for="locacion" class="label">Ubicación:</label>
              <input type="text" required="" class="form-control" name="locacion" id="locacion">
  					</div>
  					<div class="col-12 col-md-6 mt-2">
  						<label for="latitud" class="label">
  							Latitud
  						</label>
  						<input type="numeric" class="form-control" name="latitud" id="latitud" value="" required="">
  					</div>
  					<div class="col-12 col-md-6 mt-2">
  						<label for="longitud" class="label">
  							Longitud	
  						</label>
  						<input type="numeric" name="longitud" class="form-control" id="longitud" value="" required="">
  					</div>
  					<div class="col-12 mt-2 mb-2">
  						<label for="lugares_afectados" class="label">
  							Lugares Afectados
  						</label>
  						<select class="form-control" id="localidades_afectadas" name="localidades_afectadas[]" multiple="multiple"></select>
  						<textarea class="form-control mt-2" id="lugares_afectados" name="lugares_afectados" placeholder="localidades que no se encuentran en la lista">{{old('lugares_afectados')}}</textarea>
  					</div>
  					<div class="col-12 mt-2 mb-2">
  						<input name="mapinput" id="pac-input" class="form-control mt-3 w-50" type="text">
  						<div id="map" class="text-dark"></div>
  					</div>
  				</div>
  			</div>
  			<div class="col-12 col-md-3">
          <div class="row">
            <div class="col-12 mt-2">
      				<label for="fecha" class="label">
      					Fecha de Ocurrencia	
      				</label>
      				<input type="date" class="form-control" name="fecha" id="fecha" value="{{Date('Y-m-d')}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="afectacion_vial" class="label">
                Afectación Vial
              </label>
              <input type="text" class="form-control" name="afectacion_vial" id="afectacion_vial" value="{{old('afectacion_vial')}}">
            </div>
            <div class="col-12 mt-2">
              <label for="infraestructura" class="label">
                Infraesctructura Afectada
              </label>
              <input type="text" class="form-control" name="infraestructura" id="infraestructura" value="{{old('infraestructura')}}">
            </div>
            <div class="col-12 mt-2">
              <label for="danos_colaterales" class="label">
                Daños Colaterales
              </label>
              <input type="text" class="form-control" name="danos_colaterales" id="danos_colaterales" value="{{old('danos_colaterales')}}">
            </div>
            <div class="col-12 mt-2">
              <label for="estatus_incidente" class="label">
                Estatus del Incidente
              </label>
              <select class="form-control" name="estatus_incidente" id="estatus_incidente" required="">
                @foreach ($estatus as $statu)
                  <option value="{{$statu['value']}}" {{old('estatus_incidente') == $statu['value'] ? 'selected=""': ''}}>{{$statu['nombre']}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 mt-2">
              <label for="tipo_seguimiento" class="label">
                Tipo de Seguimiento
              </label>
              <select class="form-control" name="tipo_seguimiento" id="tipo_seguimiento" required="">
                <option value="">Seleccione una opción</option>
                @foreach ($tipo_seguimiento as $seguimiento)
                  <option value="{{$seguimiento->id}}" {{ $seguimiento->id == old('tipo_seguimiento') ? 'selected=""' :''}}>{{$seguimiento->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 mt-2">
              <label for="nivel_impacto" class="label">
                Nivel de Impacto
              </label>
              <div class="col-12">
                @foreach ($tipo_impacto as $impacto)
                  <div class="form-check form-check-inline {{$impacto->nombre}}">
                    <input class="form-check-input" type="radio" name="nivel_impacto" id="nivel_impacto_{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : '' }} value="{{$impacto->id}}" required="">
                      <label class="form-check-label" for="nivel_impacto_{{$impacto->id}}">{{$impacto->nombre}}</label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-12 mt-2">
              <label for="medida_control" class="label">
                Medidas de Control
              </label>
              <input type="text" class="form-control" name="medida_control" id="medida_control" value="{{old('medida_control')}}" required="">
            </div>
          </div>
  			</div>
  			<div class="col-12 col-md-3">
          <div class="row">
            <div class="col-12 mt-2">
      				<label for="hora" class="label">
      					Hora de ocurrencia 
      				</label>
      				<input type="time" class="form-control" name="hora" id="hora" value="{{Date('H:i')}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="personas_afectadas" class="label">
                Personas Afectadas 
              </label>
              <input type="number" min="0" step="1" class="form-control" name="personas_afectadas" id="personas_afectadas" value="{{ old('personas_afectadas') ? old('personas_afectadas') : 0}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="personas_lesionadas" class="label">
                Personas Lesionadas 
              </label>
              <input type="number" min="0" step="1" class="form-control" name="personas_lesionadas" id="personas_lesionadas" value="{{old('personas_lesionadas') ? old('personas_lesionadas') : 0}}">
            </div>
            <div class="col-12 mt-2">
              <label for="personas_fallecidas" class="label">
                Personas Fallecidas 
              </label>
              <input type="number" min="0" step="1" class="form-control" name="personas_fallecidas" id="personas_fallecidas" value="{{old('personas_fallecidas') ? old('personas_fallecidas') : 0}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="personas_desaparecidas" class="label">
                Personas Desaparecidas
              </label>
              <input type="number" step="1" min="0" class="form-control" name="personas_desaparecidas" id="personas_desaparecidas" value="{{ old('personas_desaparecidas') ? old('personas_desaparecidas') : 0}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="personas_evacuadas" class="label">
                Personas Evacuadas
              </label>
              <input type="number" min="0" step="1" class="form-control" name="personas_evacuadas" id="personas_evacuadas" value="{{ old('personas_evacuadas') ? old('personas_evacuadas') : 0}}" required="">
            </div>
            <div class="col-12 mt-2">
              <label for="dependencia" class="label">
                Respuesta Institucional
              </label>
            </div>
            <div class="col-12 mt-2">
              <label class="label">
                Dependencia
              </label>
              <input type="text" class="form-control" name="dependencia" id="dependencia" value="{{old('dependencia')}}" required="" placeholder="Dependencia">
            </div>
            <div class="col-12 mt-2">
              <label for="nombre" class="label">
                Nombre del que reporto
              </label>
              <input type="text" class="form-control mt-2" name="nombre" id="nombre" value="{{old('nombre')}}" required="" placeholder="Nombre">
            </div>
            <div class="col-12 mt-2">
              <label for="cargo" class="label">
                Cargo en la dependencia
              </label>
              <input type="text" class="form-control mt-2" name="cargo" id="cargo" value="{{old('cargo')}}" required="" placeholder="Cargo">
            </div>
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
    </script>
    <script type="text/javascript">
		var map;
		var marker;
    function loadScript(src,callback){
        var script = document.createElement("script");
        script.type = "text/javascript";
        if(callback)script.onload=callback;
        document.getElementsByTagName("head")[0].appendChild(script);
        script.src = src;
    }
    loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key={{env('MAP_KEY')}}',
            function(){/*log('google-loader has been loaded, but not the maps-API ');*/});
    function initialize() 
    {
      //log('maps-API has been loaded, ready to use');
      var mapOptions = {
          zoom: 8,
          center: new google.maps.LatLng(19.390858961426655,-99.14361265000002),
          mapTypeId: google.maps.MapTypeId.HYBRID
      };
      map = new google.maps.Map(document.getElementById('map'),
              mapOptions);
      var marker = new google.maps.Marker({
          map: map,
          draggable:true,
          anchorPoint: new google.maps.Point(0, -29)
      });
      marker.setMap( map );
      var input = /** @type {!HTMLInputElement} */(
              document.getElementById('pac-input'));
      google.maps.event.addDomListener(input, 'keydown', function(e) {
          if (e.keyCode == 13) {
              e.preventDefault();
          }

      });
      var select_localidad = document.getElementById('municipio');
      google.maps.event.addDomListener(select_localidad, 'change', function(e){
      	e.preventDefault();
      	var lat = parseFloat($('#municipio option:selected').attr('data-lat'));
      	var lng = parseFloat($('#municipio option:selected').attr('data-lng'));
      	$("#pac-input").val($("#pac-input").val()+", "+$('#municipio option:selected').attr('data-mun')+", "+$('#estado option:selected').attr('data-edo'));
      	var latlng = new google.maps.LatLng( lat,lng);
    	marker.setPosition(latlng);
    	map.panTo(latlng);
    	map.setZoom(17);

    	var geocodeder = geocoder = new google.maps.Geocoder();
    	geocoder.geocode({'latLng':latlng},function(results,status){
    		if (status == google.maps.GeocoderStatus.OK) {
    			if (results[0]) {
    				document.getElementById('latitud').value = marker.position.lat();
                  	document.getElementById('longitud').value = marker.position.lng();
                  	document.getElementById('locacion').value = results[0].formatted_address;
    			} 
    			infowindow.setContent('<div><strong>' + results[0].formatted_address + '</strong><br>' + results[0].formatted_address);
          		infowindow.open(map, marker);
    		}
    	})
      })
      google.maps.event.addListener(map, 'click', function(event) {
          marker.setPosition( event.latLng );
          map.panTo( event.latLng );
          var geocoder = geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': event.latLng }, function (results, status) {
          	console.log(results);
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                      document.getElementById('latitud').value = marker.position.lat();
                      document.getElementById('longitud').value = marker.position.lng();
                      document.getElementById('locacion').value = results[0].formatted_address;
                  }
              }
          });
      });
      var types = document.getElementById('type-selector');
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
      var autocomplete = new google.maps.places.Autocomplete(input,{
        componentRestrictions: { country: 'mx' }
      });
      autocomplete.bindTo('bounds', map);
      var infowindow = new google.maps.InfoWindow();
      if(navigator.geolocation) {
          browserSupportFlag = true;
          navigator.geolocation.getCurrentPosition(function(position) {
              initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
              map.setCenter(initialLocation);
              map.setZoom(17);
          }, function() {
              map.setCenter(new google.maps.LatLng(19.390858961426655,-99.14361265000002));
              map.setZoom(17);
          });
      }
      // Browser doesn't support Geolocation
      else {
          browserSupportFlag = false;
          map.setCenter(new google.maps.LatLng(19.390858961426655,-99.14361265000002));
          map.setZoom(17);
      }

      autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
              window.alert("Error");
              return;
          }
          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
              url: place.icon,
              size: new google.maps.Size(50, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          var address = '';
          if (place.address_components) {
              address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
              console.log(place);
          }
          document.getElementById('locacion').value = address;
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
          document.getElementById('latitud').value = marker.position.lat();
          document.getElementById('longitud').value = marker.position.lng();
          document.getElementById('locacion').value = address;
      });
    }
		$("#estado").change(function(){
			// alert("hola");
			var municipio_html = $("#municipio");
			municipio_html.empty();
			municipio_html.append("<option value=''>Seleccione el municipio</option>");
			var municipios_id = {{$municipios_id ? $municipios_id : 'null'}};
			console.log(municipios_id);
			var estado_id = $("#estado").val();
			axios.get(`{{ url('api/web/show_municipios/') }}/${estado_id}`).then(res=>{
				// var municipios = res.data.municipios.map(res=>JSON.parse(res.json_info));
				var municipios = res.data.municipios;
				municipios.forEach(element=>{
					if (municipios_id) {
						if (municipios_id.includes(element.id)) {
							console.log('con municipio_id',element);
							option_html = `<option value="${element.id}" data-lat="${element.lat}" data-lng="${element.long}" data-mun="${element.nombre}">${element.nombre}</option>`;
							municipio_html.append(option_html);
						} 
					} else {
						console.log('sin municipio_id',element);
						option_html = `<option value="${element.id}" data-lat="${element.lat}" data-lng="${element.long}" data-mun="${element.nombre}">${element.nombre}</option>`;
						municipio_html.append(option_html);
					}
				})
				// console.log(res.data.municipios);
			}).catch(err=>console.log(err));
		});
		$("#municipio").change(function(){
			var localidades_html = $("#localidades_afectadas");
			localidades_html.empty();
			var municipio_id = $("#municipio").val();
			axios.get(`{{ url('api/web/municipios/') }}/${municipio_id}/localidades`).then(res=>{
				// var localidades = res.data.localidades.map(res=>JSON.parse(res.json_info));
				var localidades = res.data.localidades;
				localidades.forEach(element=>{
					
					var option_html = `<option value="${element.id}" data-lat="${element.lat}" data-lng="${element.long}">${element.nombre}</option>`;
					localidades_html.append(option_html);

				})
				// console.log(res.data.localidades);
			}).catch(err=>console.log(err));
		});
		$("#subcategoria").change(function(){
			var subcat_id = $("#subcategoria").val();
			var incidente_html = $("#incidente");
			axios.get(`{{ url('api/web/incidentes/') }}/${subcat_id ? subcat_id : 801 /*801 es demo*/}`).then(res=>{
				incidente_html.empty();
				incidente_html.append('<option value="">Seleccione el incidente</option>');
				var incidentes = res.data.incidentes;
				incidentes.forEach(incidente=>{
					var option_html = `<option value="${incidente.id}">${incidente.clave+" / "+incidente.nombre}</option>`;
					incidente_html.append(option_html);
				})
			}).catch(err=>console.log(err))
		});

		var vals = [];
		$("select[multiple]").click(function(e){
		        var scroll_offset= this.scrollTop;
		      var newVals = $(this).val();
		    if (newVals.length === 1) {
		        var index = vals.indexOf(newVals[0])
		        if (index > -1) {
		        vals.splice(index, 1);
		      } else {
		        vals.push(newVals[0])
		      }
		      $(this).val(vals);
		      this.scrollTop = scroll_offset;
		    }
		});
	</script>
@endsection