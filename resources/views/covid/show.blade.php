@extends('layouts.layoutBase')


{{-- Menú lateral izquierdo con botones de navegacion (agregar titulo de la pestaña) --}}
@include('covid.menu', ['titulo' => "Registro #$covid->id"])

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
		<div class="text-center text-white">
			<h3>Perfil Usuario</h3>
		</div>
		<div class="row form-group"> 
			<div class="col-12 col-md-4">
			 	<label class="label">
			 		Edad 
			 	</label>
			 	<p class="info">
			 		{{$covid->edad-" Años"}}
			 	</p>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="genero" class="label">
			 		Genero 
			 	</label>
			 	<p class="info">
			 		{{$covid->genero}}
			 	</p>
			</div>
			<div class="col-12 col-md-4">
			 	<label for="codigo_postal" class="label">Código Postal</label>
			 	<p class="info">{{$covid->cp}}</p>
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
		@if ($covid->genero == "Mujer")
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
		@if ($covid->score > 8)
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
		<div class="form-group row">
			<div class="col-12 col-md-6">
				{{-- MAPA --}}
				<div class="mt-5 mb-5" id="map" style="height: 400px;"></div>
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

           window.location = "{{ url('/covid')}}"+"?fecha="+nuevafecha;
         },
         maxDate: 0
        });
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($covid->fecha))}}" );
    </script>
    <script type="text/javascript">
		var map;
		var marker;
		function initMap() {
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: {{$covid->lat}}, lng: {{$covid->lng}} },
	          zoom: 17,
	          mapTypeId: 'hybrid',
	          heading: 90,
    		  tilt: 45
	        });
	        marker = new google.maps.Marker({position: {lat: {{$covid->lat}}, lng: {{$covid->lng}} }, map:map })

      	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_KEY')}}&callback=initMap"
    ></script>
@endsection