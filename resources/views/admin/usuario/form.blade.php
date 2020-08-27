@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo (Agregar titulo de pestaña) --}}
@include('admin.usuario.menu', ['titulo' => ($edit ? "Editar a $user->full_name" : "Nuevo Usuario")])

{{-- Contenido de la vista --}}
@section('contenido')
	<form id="formulario" action="{{ $edit ? route('admin.usuarios.update',['usuario'=>$user]) : route('admin.usuarios.store') }}" method="POST">
		@csrf
		@if ($edit)
			@method('PUT')
		@endif
		<div class="panel-content">
			<div class="col-12 d-flex justify-content-between">
				<label style="margin-top:1%;margin-left:1%;">
					<h4 style="font-size: 20px;font-weight: bold;">{{ $edit ? "Actualizar a $user->full_name" : "Nuevo usuario" }}</h4>
					
				</label>
				<div class="align-self-center">

					<a href="{{ route('admin.usuarios.index') }}" class="btn boton1 m-2" style="background-color: #f5f5f5 !important; color: #231f20;">Regresar</a>
					<button type="button" data-toggle="modal" data-target="#confirmSubmit" class="btn boton1 m-2" style="background-color: #b3282d !important; color: #f5f5f5;">{{$edit ? "Actualizar" : "Registrar"}}</button>
				</div>
			</div>
			<ul class="nav nav-tabs">
				<li ><a  href="{{ route('admin.usuarios.index') }}" style="color: white;"  class="">Usuarios</a></li>
			  	<li ><a  href="{{ $edit ? route('admin.usuarios.show',['usuario'=>$user]) : route('admin.usuarios.index') }}"  style="color: white;" class="activo" >Información del Usuario </a></li>
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
			<div class="row form-group mt-3 pb-5">
				<div class="col-12 col-md-4">
					<label for="nombre" class="text-md-left col-form-label">
						Nombre
					</label>
					<input class="form-control" type="text" name="nombre" id="nombre" value="{{ $edit ? $user->nombre : old('nombre') }}">
				</div>
				<div class="col-12 col-md-4">
					<label for="apellido_paterno" class="text-md-left col-form-label">
						Apellido Paterno
					</label>
					<input class="form-control" type="text" name="apellido_paterno" id="apellido_paterno" value="{{ $edit ? $user->apellido_paterno : old('apellido_paterno') }}">
				</div>
				<div class="col-12 col-md-4">
					<label for="apellido_materno" class="text-md-left col-form-label">
						Apellido Materno
					</label>
					<input class="form-control" type="text" name="apellido_materno" id="apellido_materno" value="{{ $edit ? $user->apellido_materno : old('apellido_materno') }}">
				</div>
				<div class="col-12 col-md-3">
					<label for="email" class="text-md-left col-form-label">
						Correo electrónico
					</label>
					<input class="form-control" type="email" name="email" id="email" value="{{ $edit ? $user->email : old('email') }}">
				</div>
				<div class="col-12 col-md-3">
					<label for="password" class="text-md-left col-form-label">
						Contraseña
					</label>
					<input class="form-control" type="password" name="password" id="password">
				</div>
				<div class="col-12 col-md-3">
					<label for="password_confirmation" class="text-md-left col-form-label">
						Repetir contraseña
					</label>
					<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
				</div>
				<div class="col-12 col-md-3">
					<label for="institucion" class="text-md-left col-form-label">
						Institución
					</label>
					<select class="form-control" name="institucion" id="institucion">
						<option value="">Seleccione una opción</option>
						@foreach ($instituciones as $institucion)
							<option value="{{ $institucion->id }}" {{ $edit ? ($user->institucion ? ($user->institucion->id == $institucion->id ? "selected=''" : '') : '') : (old('institucion') == $institucion->id ? "selected=''" : '') }}>{{$institucion->tipo_institucion."/".$institucion->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('scripts')
	{{-- modal confirmar guardado/editar usuario --}}
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
	            ¿Estás seguro que deseas {{ $edit ? "actualizar" : "guardar"}} estos cambios?
	          </div>
	          <div class="modal-footer bg-secondary">
	            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
	            <button type="button" id="submit" class="btn btn-danger">{{ $edit ? "Actualizar" : "Guardar"}}</button>
	          </div>
	        </div>
	      </div>
	    </div>
	    <script type="text/javascript">
	    	$(document).ready(function(){
		        $("#submit").click(function(){
		          if ($("#formulario").valid() == false) {
		            var errorList = $( "ul.errorMessages")
		            errorList.empty();
		            errorList.addClass("alert alert-danger")
		            $("#formulario").find( ":invalid" ).each(function( index, node ) {
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
		            $("#formulario").submit();
		          }

		        
		        });
		    });
	    </script>
@endsection