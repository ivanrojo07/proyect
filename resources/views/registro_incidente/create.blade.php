@extends('layouts.layoutBase')

@include('registro_incidente.menu', ['titulo' => 'Nuevo incidente', 'fecha'=>Date('Y-m-d')])

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
