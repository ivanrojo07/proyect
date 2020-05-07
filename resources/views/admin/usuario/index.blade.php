@extends('layouts.app')
@section('content')
	<div class="form-group row">
		<div class="col-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>Usuarios</h4>
				</div>
				<div class="card-body">
					<a href="{{ route('admin.usuarios.create') }}" class="btn btn-block btn-info">Nuevo usuario</a>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="card">
				<div class="card-header text-white bg-dark">
					Usuarios
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-dark table-bordered text-center">
						<thead>
							<tr>
								<th scope="col">
									Nombre
								</th>
								<th scope="col">
									Apellido paterno
								</th>
								<th scope="col">
									Apellido materno
								</th>
								<th scope="col">
									Email 
								</th>
								<th scope="col">
									Institucion
								</th>
								<th>
									
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($usuarios as $user)
								<tr>
									<th scope="row">
										{{$user->nombre}}
									</th>
									<td>
										{{$user->apellido_paterno}}
									</td>
									<td>
										{{$user->apellido_materno}}
									</td>
									<td>
										{{$user->email}}
									</td>
									<td>
										{{$user->institucion ? $user->institucion->nombre : 'Sin Institución'}}
									</td>
									<td>
										<a class="btn btn-sm btn-warning" href="{{ route('admin.usuarios.edit',['usuario'=>$user]) }}">Editar</a>
										<a class="btn btn-sm btn-info" href="{{ route('admin.usuarios.show',['usuario'=>$user]) }}">Mostrar</a>
										<form class="inline mt-2" action="{{ route('admin.usuarios.destroy',['usuario'=>$user]) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
										</form>
									</td>
								</tr>
							@empty
								<div class="alert alert-info" role="alert">
									No hay instituciones creadas.
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					{{-- {{$instituciones->render()}} --}}
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("#fecha").change(function(){
			$("#changeFecha").submit();
		})
	</script>
@endpush