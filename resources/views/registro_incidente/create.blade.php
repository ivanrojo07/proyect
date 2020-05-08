@extends('layouts.app')
@section('content')
	<div class="container-fluid d-flex">
		<div class="w-25 p-3 mr-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
				</div>
				<div class="card-body">
					<form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
						<input class="form-control" type="date" name="fecha" id="fecha" value="{{$fecha}}" max="{{Date('Y-m-d')}}">
					</form>
				</div>
				<div class="card-footer">
					<a href="{{ route('incidente.create') }}" class="btn btn-block btn-info">Nuevo incidente</a>
					<a href="{{ route('incidente.index') }}" class="btn btn-block btn-success">Incidentes del día</a>
				</div>
			</div>
		</div>
		<div class="w-75">
			<div class="card bg-secondary text-white">
				<div class="card-header bg-dark">
					Nuevo Incidente
				</div>
				<form method="POST" action="{{ route('incidente.store') }}">
					@csrf
					<div class="card-body">
						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label for="subcategoria" class="text-md-right col-form-label-sm">
									Tipo de Incidente
								</label>
								<select class="form-control" id="subcategoria" name="subcategoria" required="">
									<option value="">Seleccione una categoria</option>
									@foreach ($subcategorias as $element)
										<option value="{{$element->id}}" {{old('subcategoria') == $element->id ? 'selected=""' : ''}}>{{$element->categoria->nombre." / ".$element->nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="incidente" class="text-md-right col-form-label-sm">
									Incidente
								</label>
								<select class="form-control" id="incidente" name="incidente" required="">
									<option value="">Seleccione el incidente</option>
									
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="estado" class="text-md-right col-form-label-sm">
									Estado
								</label>
								<select class="form-control" id="estado" name="estado" required="">
									<option value="">Seleccione el estado</option>
									@foreach ($estados as $estado)
										<option value="{{$estado->id}}" data-edo="{{$estado->nombre}}">{{$estado->nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="municipio" class="text-md-right col-form-label-sm">
									Municipio
								</label>
								<select class="form-control" id="municipio" name="municipio" required="">
									<option value="">Seleccione el municipio</option>
								</select>
							</div>
							<div class="col-12 col-md-6">
								<label for="descripcion" class="text-md-right col-form-label-sm">Descripción del Incidente:</label>
								<textarea class="form-control" id="descripcion" name="descripcion" rows="5" required=""></textarea>
								<label for="locacion" class="col-md-12 col-form-label text-md-center">Ubicación:</label>
								<div class="col-12">
									<div class="row">
										<div class="col-12">
											<label for="locacion" class="text-md-right col-form-label-sm">
												Dirección
											</label>
											<input id="locacion" type="text" class="form-control {{ $errors->has('locacion') ? ' is-invalid' : ''  }}" name="locacion" value="" required>
										</div>
										<div class="col-6 mt-2 mb-2">
											<label for="latitud" class="text-md-right col-form-label-sm">
												Latitud
											</label>
											<input type="numeric" class="form-control" name="latitud" id="latitud" value="" required="">
										</div>
										<div class="col-6 mt-2 mb-2">
											<label for="longitud" class="text-md-right col-form-label-sm">
												Longitud	
											</label>
											<input type="numeric" name="longitud" class="form-control" id="longitud" value="" required="">
											
										</div>
										<div class="col-12 mt-2 mb-2">
											<label for="lugares_afectados" class="text-md-right col-form-label-sm">
												Lugares Afectados
											</label>
											<select class="form-control" id="localidades_afectadas" name="localidades_afectadas[]" multiple="multiple"></select>
											<textarea class="form-control mt-2" id="lugares_afectados" name="lugares_afectados" placeholder="localidades que no se encuentran en la lista">{{old('lugares_afectados')}}</textarea>
										</div>
									</div>
									@if ($errors->has('locacion'))
										{{-- expr --}}
										<span class="invalid-feedback">
											<strong>{{ $errors->first("locacion")}}</strong>
										</span>
									@endif
								</div>
								<input name="mapinput" id="pac-input" class="form-control mt-3 w-50" type="text">
								<div id="map" class="text-dark"></div>
								
							</div>
							<div class="col-12 col-md-6">
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="fecha" class="text-md-right col-form-label-sm">
											Fecha de Ocurrencia	
										</label>
										<input type="date" class="form-control" name="fecha" id="fecha" value="{{Date('Y-m-d')}}" required="">
									</div>
									<div class="col-12 col-md-6">
										<label for="hora" class="text-md-right col-form-label-sm">
											Hora de ocurrencia 
										</label>
										<input type="time" class="form-control" name="hora" id="hora" value="{{Date('H:i')}}" required="">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="afectacion_vial" class="text-md-right col-form-label-sm">
											Afectación Vial
										</label>
										<input type="text" class="form-control" name="afectacion_vial" id="afectacion_vial" value="{{old('afectacion_vial')}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_afectadas" class="text-md-right col-form-label-sm">
											Personas Afectadas 
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_afectadas" id="personas_afectadas" value="{{ old('personas_afectadas') ? old('personas_afectadas') : 0}}" required="">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="infraestructura" class="text-md-right col-form-label-sm">
											Infraesctructura Afectada
										</label>
										<input type="text" class="form-control" name="infraestructura" id="infraestructura" value="{{old('infraestructura')}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_lesionadas" class="text-md-right col-form-label-sm">
											Personas Lesionadas 
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_lesionadas" id="personas_lesionadas" value="{{old('personas_lesionadas') ? old('personas_lesionadas') : 0}}">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="danos_colaterales" class="text-md-right col-form-label-sm">
											Daños Colaterales
										</label>
										<input type="text" class="form-control" name="danos_colaterales" id="danos_colaterales" value="{{old('danos_colaterales')}}">
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_fallecidas" class="text-md-right col-form-label-sm">
											Personas Fallecidas 
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_fallecidas" id="personas_fallecidas" value="{{old('personas_fallecidas') ? old('personas_fallecidas') : 0}}" required="">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="estatus_incidente" class="text-md-right col-form-label-sm">
											Estatus del Incidente
										</label>
										<select class="form-control" name="estatus_incidente" id="estatus_incidente" required="">
											@foreach ($estatus as $statu)
												<option value="{{$statu['value']}}" {{old('estatus_incidente') == $statu['value'] ? 'selected=""': ''}}>{{$statu['nombre']}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_desaparecidas" class="text-md-right col-form-label-sm">
											Personas Desaparecidas
										</label>
										<input type="number" step="1" min="0" class="form-control" name="personas_desaparecidas" id="personas_desaparecidas" value="{{ old('personas_desaparecidas') ? old('personas_desaparecidas') : 0}}" required="">
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<label for="tipo_seguimiento" class="text-md-right col-form-label-sm">
											Tipo de Seguimiento
										</label>
										<select class="form-control" name="tipo_seguimiento" id="tipo_seguimiento" required="">
											<option value="">Seleccione una opción</option>
											@foreach ($tipo_seguimiento as $seguimiento)
												<option value="{{$seguimiento->id}}" {{ $seguimiento->id == old('tipo_seguimiento') ? 'selected=""' :''}}>{{$seguimiento->nombre}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-12 col-md-6">
										<label for="personas_evacuadas" class="text-md-right col-form-label-sm">
											Personas Evacuadas
										</label>
										<input type="number" min="0" step="1" class="form-control" name="personas_evacuadas" id="personas_evacuadas" value="{{ old('personas_evacuadas') ? old('personas_evacuadas') : 0}}" required="">
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
													<input class="form-check-input" type="radio" name="nivel_impacto" id="nivel_impacto_{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : '' }} value="{{$impacto->id}}" required="">
														<label class="form-check-label" for="nivel_impacto_{{$impacto->id}}">{{$impacto->nombre}}</label>
												</div>
											@endforeach
											
										</div>
									</div>
									<div class="col-12 col-md-6">
										<label for="dependencia" class="text-md-right col-form-label-sm">
											Respuesta Institucional
										</label>
										<input type="text" class="form-control" name="dependencia" id="dependencia" value="{{old('dependencia')}}" required="" placeholder="Dependencia">
										<input type="text" class="form-control mt-2" name="nombre" id="nombre" value="{{old('nombre')}}" required="" placeholder="Nombre">
										<input type="text" class="form-control mt-2" name="cargo" id="cargo" value="{{old('cargo')}}" required="" placeholder="Cargo">
									</div>
									<div class="col-12">
										<label for="medida_control" class="text-md-right col-form-label-sm">
											Medidas de Control
										</label>
										<input type="text" class="form-control" name="medida_control" id="medida_control" value="{{old('medida_control')}}" required="">
									</div>
									<div class="col-12 mt-2">
										<button class="btn btn-block btn-success" type="submit">Registrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("#fecha").change(function(){
			$("#changeFecha").submit();
		})
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
    loadScript('http://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key=AIzaSyAe5gzNGneaWmWLzmZs6bFKNlwdCTr0Odk',
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
@endpush