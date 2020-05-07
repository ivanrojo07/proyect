@extends('layouts.app')
@section('content')
	<div class="container-fluid d-flex">
		<div class="w-25 p-3 mr-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>Nuevo usuarios</h4>
				</div>
				<div class="card-body">
					<a href="{{ route('admin.usuarios.create') }}" class="btn btn-block btn-info">Nuevo usuario</a>
				</div>
			</div>
		</div>
		<div class="w-75">
			<div class="card text-white bg-secondary">
				<div class="card-header bg-dark">
					Nuevo usuarios
				</div>
				<form action="{{ $edit ? route('admin.usuarios.update',['usuario'=>$user]) : route('admin.usuarios.store') }}" method="POST">
					@csrf
					@if ($edit)
						@method('PUT')
					@endif
					<div class="card-body table-responsive">
						<div class="row form-group">
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
					<div class="card-footer text-white bg-dark d-flex justify-content-around">
						<button type="submit" class="btn btn-success">Agregar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection