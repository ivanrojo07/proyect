@extends('layouts.layout1')

@section('titulo','Inicio de Sesión')

@section('estilos')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/form-index.css') }}">
@endsection

@section('contenido')

  <div class=" formulario">
    <h2>Incidencias</h2>
    <form class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"for="email">E-Mail:</label>
        <input type="email" name="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="email">
      <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" for="password">Contraseña:</label>
        <input type="password" name="password" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="password">
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <button type="submit" class="btn" name="enviar" style="
    text-align: -webkit-center;">Entrar</button></div>
    <div>
      <a href="{{ route('registrar_form') }}" class="btn btn-info rounded-pill m-auto" >Registrarse</a>
      
    </div>
      <span style="">Las cookies y notificaciones deben de estar activadas en el navegador.</span>
    
    </form>
      @include('errors.errores')
      @include('errors.campos')
  </div>
@endsection
