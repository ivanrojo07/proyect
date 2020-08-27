@extends('layouts.layoutBase')

{{-- Menu parte lateral izquierda, con menu de navegación y calendario (se requiere el titulo de la pestaña y fecha donde redirigirse) --}}
@include('registro_incidente.menu', ['titulo' => 'Nuevo incidente', 'fecha'=>Date('Y-m-d')])

{{-- Contenido --}}
@section('contenido')
  <form method="POST" id="create_incidente_form" action="{{ route('incidente.store') }}">
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
  				<button class="btn boton1 m-2" type="button" data-toggle="modal" data-target="#confirmSubmit" style="background-color: #da291c !important; color: #f5f5f5;">Registrar</a>
  			</div>
  		</div>
  		<ul class="nav nav-tabs"  >
  			<li ><a  href="{{ url('/incidente')}}?fecha={{ Date('Y-m-d') }}" style="color: white;"  class="">Incidentes</a></li>
  		  	<li ><a  href="{{ route('incidente.create') }}"  style="color: white;" class="activo" >Información del Incidente </a></li>
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
        <ul class="errorMessages"></ul>
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
              <div class="col-12" id="nivel_impacto">
                @foreach ($tipo_impacto as $impacto)
                  <div class="form-check form-check-inline {{$impacto->nombre}}">
                    <input class="form-check-input" type="radio" name="nivel_impacto" id="nivel_impacto_{{$impacto->id}}" {{ old('nivel_impacto') == $impacto->id ? 'checked=""' : '' }} value="{{$impacto->id}}" @if ($loop->last)
                      required=""
                    @endif>
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
            ¿Estás seguro que deseas guardar estos cambios?
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
          if ($("#create_incidente_form").valid() == false) {
            var errorList = $( "ul.errorMessages")
            errorList.empty();
            errorList.addClass("alert alert-danger")
            $("#create_incidente_form").find( ":invalid" ).each(function( index, node ) {
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
            $("#create_incidente_form").submit();
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
        var latlng = new google.maps.LatLng( lat,lng);
        marker.setPosition(latlng);
        map.panTo(latlng);
        map.setZoom(17);

        var geocodeder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({'latLng':latlng},function(results,status){
          console.log("results",results);
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              document.getElementById('latitud').value = marker.position.lat();
                      document.getElementById('longitud').value = marker.position.lng();
                      document.getElementById('locacion').value = results[0].formatted_address;
            } 
          }
        })
      })
      google.maps.event.addListener(map, 'click', function(event) {
          
          map.panTo( event.latLng );
          var geocoder = geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': event.latLng }, function (results, status) {
            console.log("results",results);
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                      var sitio_disponible = false;
                      results[0].address_components.forEach(address=>{
                        let municipio_name = $('#estado option:selected').attr('data-edo');
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
          var place = autocomplete.getPlace();
          var sitio_disponible = false;
          place.address_components.forEach(address=>{
            let municipio_name = $('#estado option:selected').attr('data-edo');
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
    $("#estado").change(function(){
      // alert("hola");
      var municipio_html = $("#municipio");
      municipio_html.empty();
      municipio_html.append("<option value=''>Seleccione el municipio</option>");
      var municipios_id = {{$municipios_id ? $municipios_id : 'null'}};
      var estado_id = $("#estado").val();
      axios.get(`{{ url('api/web/show_municipios/') }}/${estado_id}`).then(res=>{
        // var municipios = res.data.municipios.map(res=>JSON.parse(res.json_info));
        var municipios = res.data.municipios;
        municipios.forEach(element=>{
          if (municipios_id) {
            if (municipios_id.includes(element.id)) {
              option_html = `<option value="${element.id}" data-lat="${element.lat}" data-lng="${element.long}" data-mun="${element.nombre}">${element.nombre}</option>`;
              municipio_html.append(option_html);
            } 
          } else {
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