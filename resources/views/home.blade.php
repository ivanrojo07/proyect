@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
    Bienvenido {{Auth::user()->full_name}}
@endsection

{{-- estilos para el index --}}
@section('estilos')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style type="text/css">
    .ocultar{
      display:none;
    }
    body{
      color: white;
    }
</style>
@endsection

{{-- Menú de navegacion --}}
@section('botonera')
    <a href="{{ route('home') }}"><span role="button" class="glbl glbl-home"  title="Inicio"></span></a>
@endsection

{{-- titulo del sidebar --}}
@section('titulopanel')
    <div  class="titulolateral">
        <h5>Expediente de Incidencias 
            <a>
                <span class="glbl2 glbl glbl-down"></span>
            </a>
        </h5>
        
    </div>
@endsection

{{-- contenido del sidebar --}}
@section('panellateral')
    <ul class="list-group">
        <a href="{{ route('incidente.index') }}" class="list-group-item list-group-item-action list-group-item-secondary">
            <span>Incidentes</span><span class="glbl2 glbl glbl-down" style="color: white"></span>
        </a>
        <a href="{{ route('admin.usuarios.index') }}" class="list-group-item list-group-item-action list-group-item-secondary">
            <span>Usuarios</span><span class="glbl2 glbl glbl-down" style="color: white"></span>
        </a>
        <a href="{{ route('admin.institucion.index') }}" class="list-group-item list-group-item-action list-group-item-secondary">
            <span>Instituciones</span><span class="glbl2 glbl glbl-down" style="color: white"></span>
        </a>
        <a href="{{ route('covid.index') }}" class="list-group-item list-group-item-action list-group-item-secondary">
            <span>Covid-19</span><span class="glbl2 glbl glbl-down" style="color: white"></span>
        </a>
    </ul>
@endsection
@section('contenido')
    {{-- EMPTY --}}
@endsection