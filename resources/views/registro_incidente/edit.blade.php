@extends('layouts.app')
@section('content')
	<div class="form-group row">
		<div class="col-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
				</div>
				<div class="card-body">
					<form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
						<input class="form-control" type="date" name="fecha" id="fecha" value="{{Date('Y-m-d')}}" max="{{Date('Y-m-d')}}">
					</form>
				</div>
				<div class="card-footer">
					<a href="{{ route('incidente.create') }}" class="btn btn-block btn-info">Nuevo incidente</a>
					<a href="{{ route('incidente.index') }}" class="btn btn-block btn-success">Incidentes del día</a>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="card bg-secondary text-white">
				<div class="card-header bg-dark">
					Actualización Incidente {{Date('d-m-Y',strtotime($incidente->fecha_ocurrencia))." ".$incidente->catalogo_incidente->nombre}}
				</div>
				<form method="POST" action="{{ route('incidente.update',['incidente'=>$incidente]) }}">
					@csrf
					@method('PUT')
					<div class="card-body">
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="subcategoria" class="text-md-right col-form-label-sm">
									Tipo de incidente
								</label>
								<input class="form-control" readonly="" value="{{$incidente->catalogo_incidente->subcategoria->categoria->nombre.' / '.$incidente->catalogo_incidente->subcategoria->nombre}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="incidente" class="text-md-right col-form-label-sm">
									Incidente
								</label>
								<input class="form-control" readonly="" value="{{$incidente->catalogo_incidente->clave." / ".$incidente->catalogo_incidente->nombre}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="estado" class="text-md-right col-form-label-sm">
									Estado
								</label>
								<input class="form-control" readonly="" value="{{$incidente->estado->nombre}}">
							</div>
							<div class="col-12 col-md-6">
								<label for="municipio" class="text-md-right col-form-label-sm">
									Municipio
								</label>
								<input class="form-control" readonly="" value="{{$incidente->municipio->nombre}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-6">
							
								<label for="descripcion" class="text-md-right col-form-label-sm">
									Descripción del Incidente
								</label>
								<textarea name="descripcion" id="descripcion" rows="5" class="form-control">{{old('descripcion') ? old('descripcion') : $incidente->descripcion}}</textarea>

								<label for="locacion" class="text-md-right col-form-label-sm mt-3">
									Ubicación
								</label>
								<input type="text" name="locacion" id="locacion" class="form-control {{ $errors->has('locacion') ? ' is-invalid' : ''  }}" required="" value="{{old('locacion') ? old('locacion') : $incidente->locacion}}">
								<div class="form-group row">
									<div class="col-6 mt-2 mb-2">
										<label for="latitud" class="text-md-right col-form-label-sm">
											Latitud
										</label>
										<input type="numeric" name="latitud" id="latitud" class="form-control" value="{{old('latitud') ? old('latitud') : $incidente->lat_especifica}}">
									</div>
									<div class="col-6 mt-2 mb-2">
										<label for="longitud" class="text-md-right col-form-label-sm">
											Longitud
										</label>
										<input type="numeric" name="longitud" id="longitud" class="form-control" value="{{ old('longitud') ? old('longitud') : $incidente->long_especifica }}">
									</div>
									<div class="col-12 mt-2 mb-2">
										<label for="lugares_afectados" class="text-md-right col-form-label-sm"></label>
										<select class="form-control" id="localidades_afectadas" name="localidades_afectadas[]" multiple="multiple"></select>
										<textarea class="form-control mt-2" id="lugares_afectados" name="lugares_afectados" placeholder="localidades que no se encuentran en la lista">{{old('lugares_afectados') ? old('lugares_afectados') : $incidente->lugares_afectados}}</textarea>
									</div>
								</div>
								<input id="pac-input2" class="form-control mt-3 w-50" type="text">
								<div id="map"></div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label for="fecha" class="text-md-right col-form-label-sm">
											Fecha de Ocurrencia
										</label>
										<input type="date" class="form-control" name="fecha" id="fecha" value="{{old('fecha') ? old('fecha') : Date('Y-m-d')}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="hora" class="text-md-right col-form-label-sm">
											Hora de Ocurrencia
										</label>
										<input type="time" class="form-control" name="hora" id="hora" value="{{old('hora') ? old('hora') : Date('H:i')}}">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-12 col-md-6">
										<label for="afectacion_vial" class="text-md-right col-form-label-sm">
											Afectación Vial
										</label>
										<input type="text" class="form-control" name="afectacion_vial" id="afectacion_vial" value="{{old('afectacion_vial') ? old('afectacion_vial') : $incidente->afectacion_vial}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_afectadas" class="text-md-right col-form-label-sm">
											Personas Afectadas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_afectadas" id="personas_afectadas" value="{{old('personas_afectadas') ? old('personas_afectadas') : $incidente->personas_afectadas}}" >
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label for="infraestructura" class="text-md-right col-form-label-sm">
											Infraestructura Afectada
										</label>
										<input type="text" class="form-control" name="infraestructura" id="infraestructura" value="{{old('infraestructura') ? old('infraestructura') : $incidente->afectacion_infraestructural}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_lesionadas" class="text-md-right col-form-label-sm">
											Personas Lesionadas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_lesionadas" id="personas_lesionadas" value="{{old('personas_lesionadas') ? old('personas_lesionadas') : $incidente->personas_lesionadas}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label for="danos_colaterales" class="text-md-right col-form-label-sm">
											Daños Colaterales
										</label>
										<input type="text" class="form-control" name="danos_colaterales" id="danos_colaterales" value="{{old('danos_colaterales') ? old('danos_colaterales') : $incidente->danio_colateral}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_fallecidas" class="text-md-right col-form-label-sm">
											Personas Fallecidas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_fallecidas" id="personas_fallecidas" value="{{old('personas_fallecidas') ? old('personas_fallecidas') : $incidente->personas_fallecidas}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label for="estatus_incidente" class="text-md-right col-form-label-sm">
											Estatus del Incidente
										</label>
										<select class="form-control" name="estatus_incidente" id="estatus_incidente" required="">
											<option value="1">Activo</option>
											<option value="0">Inactivo</option>
										</select>
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_desaparecidas" class="text-md-right col-form-label-sm">
											Personas Desaparecidas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_desaparecidas" id="personas_desaparecidas" value="{{old('personas_desaparecidas') ? old('personas_desaparecidas') : $incidente->personas_desaparecidas}}">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12 col-md-6">
										<label for="tipo_seguimiento" class="text-md-right col-form-label-sm">
											Tipo de Seguimiento
										</label>
										<select class="form-control" name="tipo_seguimiento" id="tipo_seguimiento" required="">
											<option value="">Seleccione una opción</option>
											@foreach ($tipo_seguimiento as $seguimiento)
												<option value="{{$seguimiento->id}}" {{ $seguimiento->id == old('tipo_seguimiento') ? 'selected=""' : ($incidente->seguimiento->id == $seguimiento->id ? 'selected=""' : '') }}>{{$seguimiento->nombre}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_evacuadas" class="text-md-right col-form-label-sm">
											Personas Evacuadas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_evacuadas" id="personas_evacuadas" value="{{old('personas_evacuadas') ? old('personas_evacuadas') : $incidente->personas_evacuadas}}">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="nivel_impacto" class="text-md-right col-form-label-sm">
											Nivel de Impacto
										</label>
										<div class="col-12">
											@foreach ($tipo_impacto as $impacto)
												
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="nivel_impacto" id="nivel_impacto_{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : ($incidente->impacto->id == $impacto->id ? 'checked=""' : '') }} value="{{$impacto->id}}" required="">
														<label class="form-check-label" for="nivel_impacto_{{$impacto->id}}">{{$impacto->nombre}}</label>
												</div>
											@endforeach
											
										</div>
										

									</div>
									<div class="col-12 col-md-6">
										<label for="dependencia" class="text-md-right col-form-label-sm">
											Respuesta Institucional
										</label>
										<input type="text" class="form-control" name="dependencia" id="dependencia" value="{{old('dependencia') ? old('dependencia') : $incidente->dependencia}}" required="" placeholder="Dependencia">
										<input type="text" class="form-control mt-2" name="nombre" id="nombre" value="{{old('nombre') ? old('nombre') : $incidente->nombre_empleado}}" required="" placeholder="Nombre">
										<input type="text" class="form-control mt-2" name="cargo" id="cargo" value="{{old('cargo') ? old('cargo') : $incidente->cargo_empleado}}" required="" placeholder="Cargo">
									</div>
									<div class="col-12">
										<label for="medida_control" class="text-md-right col-form-label-sm">
											Medidas de Control
										</label>
										<input type="text" class="form-control" name="medida_control" id="medida_control" value="{{old('medida_control') ? old('medida_control') : $incidente->medidas_control}}" required="">
									</div>
									<div class="col-12 mt-2">
										<button class="btn btn-block btn-success" type="submit">Registrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
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
    loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key=AIzaSyAe5gzNGneaWmWLzmZs6bFKNlwdCTr0Odk',
            function(){/*log('google-loader has been loaded, but not the maps-API ');*/});
    function initialize() 
    {
      	//log('maps-API has been loaded, ready to use');
  		var mapOptions = {
      		zoom: 15,
          	center: new google.maps.LatLng({{old('latitud') ? old('latitud') : $incidente->lat_especifica}},{{ old('longitud') ? old('longitud') : $incidente->long_especifica}}),
          	mapTypeId: google.maps.MapTypeId.HYBRID
      	};
      	map = new google.maps.Map(document.getElementById('map'),
              mapOptions);
    	marker = new google.maps.Marker({
          	map: map,
          	position: {lat: {{old('latitud') ? old('latitud') : $incidente->lat_especifica}}, lng: {{ old('longitud') ? old('longitud') : $incidente->long_especifica}} },
          	draggable:true,
          	anchorPoint: new google.maps.Point(0, -29)
      	});
      	// marker.setMap( map );
      	var input = /** @type {!HTMLInputElement} */(
          	document.getElementById('pac-input2'));
      	google.maps.event.addDomListener(input, 'keydown', function(e) {
          	if (e.keyCode == 13) {
              	e.preventDefault();
          	}
      	});
      	
      google.maps.event.addListener(map, 'click', function(event) {
          marker.setPosition( event.latLng );
          map.panTo( event.latLng );
          var geocoder = geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': event.latLng }, function (results, status) {
          	console.log(results);
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                  	console.log(marker.position.lat());
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
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);
      var infowindow = new google.maps.InfoWindow();
      if(navigator.geolocation) {
          browserSupportFlag = true;
      }
      // Browser doesn't support Geolocation
      else {
          browserSupportFlag = false;
      }
      autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
              window.alert("Error");
              return;
          }
          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
              url: place.icon,
              size: new google.maps.Size(50, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          console.log(place.geometry.location);
          marker.setVisible(true);
          var address = '';
          if (place.address_components) {
              address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
          }
          document.getElementById('locacion').value = address;
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
          document.getElementById('latitud').value = marker.position.lat();
          document.getElementById('longitud').value = marker.position.lng();
          document.getElementById('locacion').value = address;
      });
    }

    $(document).ready(function(){
    	// Obtener localidades de este municipio
	    var municipio_id = {{$incidente->municipio->id}};
	    var localidades_html = $("#localidades_afectadas");
	    var mis_localidades = @json($incidente->localidades->pluck('id'));
	    axios.get(`{{ url('api/web/municipios/') }}/${municipio_id}/localidades`).then(res=>{
	    	var localidades = res.data.localidades;
	    	localidades.forEach(element=>{
	    		var option_html = `<option id="${element.id}" value="${element.id}" data-lat="${element.lat}" ${ mis_localidades.includes(element.id) ? 'selected=""' : '' } data-lng="${element.long}" >${element.nombre}</option>`;
	    		localidades_html.append(option_html);
	    	});
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
    });
    // localidades_html.val(mis_localidades);
</script>
@endpush