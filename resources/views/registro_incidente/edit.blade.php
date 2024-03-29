@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo de incidente con botones y calendario de navegación (introducir fecha de incidente y titulo de pestaña) --}}
@include('registro_incidente.menu', ['titulo' => "INCIDENTE #$incidente->id", 'fecha'=>Date('Y-m-d')])

{{-- Contenido --}}
@section('contenido')
	<form method="POST" id="update_registro_form" action="{{ route('incidente.update',['incidente'=>$incidente]) }}">
	@csrf
	@method('PUT')
		<div class="panel-content">
			<div class="col-12 d-flex justify-content-between">
				<label style="margin-top:1%;margin-left:1%;">
					<h4 style="font-size: 20px;font-weight: bold;">Incidente #{{ $incidente->id }} | <span class="span-{{$incidente->impacto->nombre}}"></span> Prioridad: {{ $incidente->impacto->nombre }}</h4>
					<h6 style="font-size: 15px;">{{
						$incidente->catalogo_incidente->subcategoria->categoria->nombre
						." | ".
						$incidente->catalogo_incidente->subcategoria->nombre
						." | ".
						$incidente->catalogo_incidente->clave
						." | ".
						 $incidente->catalogo_incidente->nombre
					}}</h6>
				</label>
				<div class="align-self-center">
					<a href="{{ route('incidente.show',['incidente'=>$incidente]) }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<button type="button" data-toggle="modal" data-target="#confirmSubmit" class="btn boton1 m-2 {{ $incidente->seguimiento->nombre == 'Final' || $incidente->seguimiento->nombre == 'único' ? 'disabled' : '' }}" style="background-color: #da291c !important; color: #f5f5f5;">Registrar</button>
				</div>
			</div>
			<ul class="nav nav-tabs"  >
				<li ><a  href="{{ url('/incidente')}}?fecha={{ $incidente->fecha_ocurrencia }}" style="color: white;"  class="">Incidentes</a></li>
			  	<li ><a  href="{{ route('incidente.show',['incidente'=>$incidente]) }}"  style="color: white;" class="activo" >Información del Incidente </a></li>
			</ul>
		</div>
	
		<div class="panel-body">
			<ul class="errorMessages"></ul>
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
				<div class="col-12 col-md-6 col-xl-6">
					<h4 style="font-size: 20px;font-weight: bold; margin: 25px">
						Actualización del {{$incidente->fecha_ocurrencia." ".$incidente->hora_ocurrencia}} 
					</h4>
				</div>
				<div class="col-12 col-md-3 col-xl-3">
					<p class="label">
						Fecha de Ocurrencia
					</p>
					<p class="info">
						{{$incidente->fecha_ocurrencia}}
					</p>
				</div>
				<div class="col-12 col-md-3 col-xl-3">
					<p class="label">
						Hora de Ocurrencia
					</p>
					<p class="info">
						{{$incidente->hora_ocurrencia}}
					</p>
				</div>
			</div>
			<hr>
			<div class="row mb-2">
				<div class="col-12 col-md-3 mt-2">
					<label for="subcategoria" class="label">
						Tipo de incidente
					</label>
					<p class="info">
						{{$incidente->catalogo_incidente->subcategoria->categoria->nombre.' / '.$incidente->catalogo_incidente->subcategoria->nombre}}
					</p>
				</div>
				<div class="col-12 col-md-3 mt-2">
					<label for="incidente" class="label">
						Incidente
					</label>
					<p class="info">
						{{$incidente->catalogo_incidente->clave." / ".$incidente->catalogo_incidente->nombre}}
					</p>
				</div>
				<div class="col-12 col-md-3 mt-2">
					<label for="estado" class="label">
						Estado
					</label>
					<p class="info">
						{{$incidente->estado->nombre}}
					</p>
				</div>
				<div class="col-12 col-md-3 mt-2">
					<label for="municipio" class="label">
						Municipio
					</label>
					<p class="info">
						{{ $incidente->municipio ? $incidente->municipio->nombre : "N/A"}}
					</p>
				</div>
			</div>
			<hr>
			<div class="row">
	  			<div class="col-12 col-md-6">
	  				<div class="row">
	  					<div class="col-12 mt-2">
	  						<label for="descripcion" class="label">Descripción del Incidente:</label>
	  						<textarea name="descripcion" id="descripcion" rows="5" class="form-control" required="">{{old('descripcion') ? old('descripcion') : $incidente->descripcion}}</textarea>
	  					</div>
	  					<div class="col-12 mt-2">
	  						<label for="locacion" class="label">Ubicación:</label>
	              			<input type="text" name="locacion" id="locacion" class="form-control {{ $errors->has('locacion') ? ' is-invalid' : ''  }}" required="" value="{{old('locacion') ? old('locacion') : $incidente->locacion}}">
	  					</div>
	  					<div class="col-12 col-md-6 mt-2">
	  						<label for="latitud" class="label">
	  							Latitud
	  						</label>
	  						<input type="numeric" name="latitud" id="latitud" class="form-control" value="{{old('latitud') ? old('latitud') : $incidente->lat_especifica}}">
	  					</div>
	  					<div class="col-12 col-md-6 mt-2">
	  						<label for="longitud" class="label">
	  							Longitud	
	  						</label>
	  						<input type="numeric" name="longitud" id="longitud" class="form-control" value="{{ old('longitud') ? old('longitud') : $incidente->long_especifica }}">
	  					</div>
	  					<div class="col-12 mt-2 mb-2">
	  						<label for="lugares_afectados" class="label">
	  							Lugares Afectados
	  						</label>
	  						<select class="form-control" id="localidades_afectadas" name="localidades_afectadas[]" multiple="multiple"></select>
	  						<textarea class="form-control mt-2" id="lugares_afectados" name="lugares_afectados" placeholder="localidades que no se encuentran en la lista">{{old('lugares_afectados') ? old('lugares_afectados') : $incidente->lugares_afectados}}</textarea>
	  					</div>
	  					<div class="col-12 mt-2 mb-2">
	  						<input id="pac-input2" class="form-control mt-3 w-50" type="text">
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
	  				<input type="date" class="form-control" name="fecha" id="fecha" value="{{old('fecha') ? old('fecha') : Date('Y-m-d')}}">
	            </div>
	            <div class="col-12 mt-2">
	              	<label for="afectacion_vial" class="label">
	                	Afectación Vial
	              	</label>
					<input type="text" class="form-control" name="afectacion_vial" id="afectacion_vial" value="{{old('afectacion_vial') ? old('afectacion_vial') : $incidente->afectacion_vial}}">
	              
	            </div>
	            <div class="col-12 mt-2">
	              <label for="infraestructura" class="label">
	                Infraesctructura Afectada
	              </label>
	              <input type="text" class="form-control" name="infraestructura" id="infraestructura" value="{{old('infraestructura') ? old('infraestructura') : $incidente->afectacion_infraestructural}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="danos_colaterales" class="label">
	                Daños Colaterales
	              </label>
	              <input type="text" class="form-control" name="danos_colaterales" id="danos_colaterales" value="{{old('danos_colaterales') ? old('danos_colaterales') : $incidente->danio_colateral}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="estatus_incidente" class="label">
	                Estatus del Incidente
	              </label>
	              <select class="form-control" name="estatus_incidente" id="estatus_incidente" required="">
	                @foreach ($estatus as $statu)
	                  <option value="{{$statu['value']}}">{{$statu['nombre']}}</option>
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
						<option value="{{$seguimiento->id}}" {{ $seguimiento->id == old('tipo_seguimiento') ? 'selected=""' : ($incidente->seguimiento->id == $seguimiento->id ? 'selected=""' : '') }}>{{$seguimiento->nombre}}</option>
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
	                    <input class="form-check-input" type="radio" name="nivel_impacto" id="nivel_impacto_{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : '' }} value="{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : ($incidente->impacto->id == $impacto->id ? 'checked=""' : '') }} value="{{$impacto->id}}" required="">
	                      <label class="form-check-label" for="nivel_impacto_{{$impacto->id}}">{{$impacto->nombre}}</label>
	                  </div>
	                @endforeach
	              </div>
	            </div>
	            <div class="col-12 mt-2">
	              <label for="medida_control" class="label">
	                Medidas de Control
	              </label>
	              <input type="text" class="form-control" name="medida_control" id="medida_control" value="{{old('medida_control') ? old('medida_control') : $incidente->medidas_control}}" required="">
	            </div>
	          </div>
	  			</div>
	  			<div class="col-12 col-md-3">
	          <div class="row">
	            <div class="col-12 mt-2">
	  				<label for="hora" class="label">
	  					Hora de ocurrencia 
	  				</label>
	  				<input type="time" class="form-control" name="hora" id="hora" value="{{old('hora') ? old('hora') : Date('H:i')}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="personas_afectadas" class="label">
	                Personas Afectadas 
	              </label>
	              <input type="number" min="0" step="1" class="form-control" name="personas_afectadas" id="personas_afectadas" value="{{old('personas_afectadas') ? old('personas_afectadas') : $incidente->personas_afectadas}}" >
	            </div>
	            <div class="col-12 mt-2">
	              <label for="personas_lesionadas" class="label">
	                Personas Lesionadas 
	              </label>
	              <input type="number" min="0" step="1" class="form-control" name="personas_lesionadas" id="personas_lesionadas" value="{{old('personas_lesionadas') ? old('personas_lesionadas') : $incidente->personas_lesionadas}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="personas_fallecidas" class="label">
	                Personas Fallecidas 
	              </label>
	              <input type="number" min="0" step="1" class="form-control" name="personas_fallecidas" id="personas_fallecidas" value="{{old('personas_fallecidas') ? old('personas_fallecidas') : $incidente->personas_fallecidas}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="personas_desaparecidas" class="label">
	                Personas Desaparecidas
	              </label>
	              <input type="number" min="0" step="1" class="form-control" name="personas_desaparecidas" id="personas_desaparecidas" value="{{old('personas_desaparecidas') ? old('personas_desaparecidas') : $incidente->personas_desaparecidas}}">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="personas_evacuadas" class="label">
	                Personas Evacuadas
	              </label>
	              <input type="number" min="0" step="1" class="form-control" name="personas_evacuadas" id="personas_evacuadas" value="{{old('personas_evacuadas') ? old('personas_evacuadas') : $incidente->personas_evacuadas}}">
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
	              <input type="text" class="form-control" name="dependencia" id="dependencia" value="{{old('dependencia') ? old('dependencia') : $incidente->dependencia}}" required="" placeholder="Dependencia">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="nombre" class="label">
	                Nombre del que reporto
	              </label>
	              <input type="text" class="form-control mt-2" name="nombre" id="nombre" value="{{old('nombre') ? old('nombre') : $incidente->nombre_empleado}}" required="" placeholder="Nombre">
	            </div>
	            <div class="col-12 mt-2">
	              <label for="cargo" class="label">
	                Cargo en la dependencia
	              </label>
	              <input type="text" class="form-control mt-2" name="cargo" id="cargo" value="{{old('cargo') ? old('cargo') : $incidente->cargo_empleado}}" required="" placeholder="Cargo">
	            </div>
	          </div>
	  			</div>
	  		</div>
		</div>
	</form>
@endsection

{{-- Scripts --}}
@section('scripts')
	{{-- modal confirmar incidente --}}
	    <!-- Modal -->
	    <div class="modal fade" id="confirmSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	      <div class="modal-dialog modal-dialog-centered" role="document">
	        <div class="modal-content">
	          <div class="modal-header bg-dark">
	            <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body bg-secondary">
	            ¿Estás seguro que deseas actualizar estos cambios?
	          </div>
	          <div class="modal-footer bg-secondary">
	            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
	            <button type="button" id="submit" class="btn btn-danger">Registrar</button>
	          </div>
	        </div>
	      </div>
	    </div>
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
	<script>

		$(document).ready(function(){
	        $("#submit").click(function(){
	          if ($("#update_registro_form").valid() == false) {
	            var errorList = $( "ul.errorMessages")
	            errorList.empty();
	            errorList.addClass("alert alert-danger")
	            $("#update_registro_form").find( ":invalid" ).each(function( index, node ) {
	                  console.log(node);
	                  // Find the field's corresponding label
	                  var label = $( "label[for=" + node.id + "] "),
	                      // Opera incorrectly does not fill the validationMessage property.
	                      message = node.validationMessage || 'No es valor valido.';

	                  errorList
	                      .show()
	                      .append( "<li><span>En el campo '" + label.html() + "':</span> " + message + "</li>" );
	              });
	            $("#confirmSubmit").modal("hide");

	          }
	          else{
	            $("#update_registro_form").submit();
	          }

	        
	        });
	    });
	

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
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($incidente->fecha_ocurrencia))}}" );
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
	    loadScript('https://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key={{env('MAP_KEY')}}',
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
          
		          map.panTo( event.latLng );
		          var geocoder = geocoder = new google.maps.Geocoder();
		          geocoder.geocode({ 'latLng': event.latLng }, function (results, status) {
		            console.log("results",results);
		              if (status == google.maps.GeocoderStatus.OK) {
		                  if (results[0]) {
		                      var sitio_disponible = false;
		                      results[0].address_components.forEach(address=>{
		                        let municipio_name = "{{$incidente->estado->nombre}}";
		                        if (municipio_name == address.long_name) {
		                          sitio_disponible = true
		                        } 
		                      });
		                      if (sitio_disponible) {
		                        marker.setPosition( event.latLng );
		                        document.getElementById('latitud').value = marker.position.lat();
		                        document.getElementById('longitud').value = marker.position.lng();
		                        document.getElementById('locacion').value = results[0].formatted_address;
		                      } else {
		                        alert('El indicador esta fuera de la zona permitida');
		                      }
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
		          var place = autocomplete.getPlace();
		          var sitio_disponible = false;
		          place.address_components.forEach(address=>{
		            let municipio_name = "{{$incidente->estado->nombre}}";
		            if (municipio_name == address.long_name) {
		              sitio_disponible = true
		            } 
		          });
		          console.log('places',place);
		          if (sitio_disponible) {
		            infowindow.close();
		            marker.setVisible(false);
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
		            }
		            document.getElementById('locacion').value = address;
		            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		            infowindow.open(map, marker);
		            document.getElementById('latitud').value = marker.position.lat();
		            document.getElementById('longitud').value = marker.position.lng();
		            document.getElementById('locacion').value = address;
		          } else {
		            alert('No es un lugar disponible');
		          }
		          
		    });
	    }

	    $(document).ready(function(){
	    	// Obtener localidades de este municipio
		    var municipio_id = {{ $incidente->municipio ? $incidente->municipio->id : "null"}};
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
@endsection