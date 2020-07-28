@extends('layouts.layoutBase2')

{{-- titulo de la pestaña --}}
@section('titulo')
	Bienvenido
@endsection


{{-- Menu de navegación --}}
@section('botonera')
	<ul class="botonera">
		<li>
			<a href="/" title="Inicio">
				<span class="glbl glbl-home"></span>
			</a>
		</li>
		<li>
			<a href="/mosaico" title="Mosaico de Video"><span class="glbl glbl-mosaico"></span></a>
		</li>
	</ul>
@endsection


{{-- Titulo del sidebar --}}
@section('tituloPanel')
	<h6>Tienda CDMX</h6>
@endsection


{{-- Contenido del sidebar --}}
@section('contenidoPanel')
	<h4>Aqui va el contenido de la vista de Dashboard</h4>
@endsection


{{-- Contenido de la vista --}}
@section('contenido')
	<h1>Vista principal</h1>
@endsection