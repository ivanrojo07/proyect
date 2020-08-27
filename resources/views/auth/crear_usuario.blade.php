@extends('layouts.layout1')

@section('titulo','Inicio de Sesión')

@section('estilos')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form-index.css') }}">
@endsection

@section('contenido')

  <div class=" formulario">
    <h2>Incidencias</h2> 
    <form class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" method="POST" action="{{ route('registrar') }}">
      {{ csrf_field() }}
      <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"for="nombre">Nombre:</label>
        <input type="text" name="nombre" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="nombre" value="{{old('nombre')}}">
        @error('nombre')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="apellido_paterno" value="{{ old('apellido_paterno') }}">
        @error('apellido_paterno')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="apellido_materno" value="{{ old('apellido_materno') }}">
        @error('apellido_materno')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
      <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"for="email">E-Mail:</label>
        <input type="email" name="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="email" value="{{ old('email') }}">
        @error('email')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
      <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" for="password">Contraseña:</label>
        <input type="password" name="password" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="password">
        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" for="password_confirmation">Confirmar la contraseña:</label>
        <input type="password" name="password_confirmation" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="password_confirmation">
        @error('password')
          <div class="col-6 offset-3 rounded-pill alert alert-danger">{{ $message }}</div>
        @enderror
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
  <div>
    <a href="{{ route('login') }}" class="btn btn-info rounded-pill m-auto" >Iniciar sesión</a>
    
  </div>
      <span style="">Las cookies y notificaciones deben de estar activadas en el navegador.</span>
    </form>
      @include('errors.errores')
      @include('errors.campos')
  </div>
@endsection
