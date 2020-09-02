@extends('layouts.layout1')

@section('titulo','Inicio de Sesión')

@section('estilos')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form-index.css') }}">
@endsection

@section('contenido')

  <div class=" formulario">
    <h2>Registrar modulo</h2> 
    <form class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" method="POST" action="{{ route('submit_modulo') }}">
      {{ csrf_field() }}
        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" for="institucion">Institución:</label>
        <select name="institucion" id="institucion" class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> 
          <option value="">Seleccione una opción</option>
            @foreach ($instituciones as $institucion)
              <option value="{{ $institucion->id }}" {{ old('institucion') == $institucion->id ? "selected=''" : '' }}>{{$institucion->tipo_institucion."/".$institucion->nombre}}</option>
            @endforeach
         </select>
         @error('institucion')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <button type="submit" class="btn" name="submit" style="
    text-align: -webkit-center;">Entrar</button>
  </div>
    </form>
      @include('errors.errores')
      @include('errors.campos')
  </div>
@endsection
