@extends('layouts.layoutBase')

{{-- titulo de la pestaña --}}
@section('titulo')
	Bienvenido
@endsection


{{-- Menu de navegación --}}
@section('botonera')
	<a href="#"><span role="button" class="glbl glbl-home"  title="Inicio"></span></a>
@endsection


{{-- Titulo del sidebar --}}
@section('titulopanel')
	<h6>Tienda CDMX</h6>
@endsection


{{-- Contenido del sidebar --}}
@section('panellateral')
	<h4>Aqui va el contenido de la vista de Dashboard</h4>
@endsection


{{-- Contenido de la vista --}}
@section('contenido')
	<h1>Vista principal</h1>
@endsection