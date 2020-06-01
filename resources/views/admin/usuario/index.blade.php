@extends('layouts.layoutBase')

{{-- Menu lateral izquierdo (Agregar titulo de pestaña) --}}
@include('admin.usuario.menu', ['titulo' => 'Administración de usuarios'])

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;"><h4 style="font-size: 15px;font-weight: bold;">{{ date('d-F-Y') }}</h4></label>
		</div>
		<ul class="nav nav-tabs"  >
			<li ><a  href="{{ route('admin.usuarios.index') }}" style="color: white;"  class="activo">Usuarios</a></li>
		  	<li ><a   href="#"  style="color: white;" class="ocultar" >Información del usuario </a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div style="overflow: auto">
			<div class="tab-content">
				<div class="col-12">
					<table class="text-center" id="tablaPaginado" cellspacing="0" width="100%">
						<thead id="tablaEncabezadoIncidentes">
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
						<tbody id="tablaListaIncidentes">
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
										<form id="delete_{{$user->id}}" class="inline mt-2" action="{{ route('admin.usuarios.destroy',['usuario'=>$user]) }}" method="POST">
											<a class="btn btn-sm boton1" href="{{ route('admin.usuarios.edit',['usuario'=>$user]) }}">Editar</a>
											<a class="btn btn-sm boton1" href="{{ route('admin.usuarios.show',['usuario'=>$user]) }}">Mostrar</a>
											@csrf
											@method('DELETE')
											<button type="button" data-toggle="modal" data-target="#confirmDelete_{{$user->id}}" onclick="formularioID({{$user->id}})" class="btn btn-sm boton3">Eliminar</button>
											{{-- modal confirmar eliminar --}}
										    <!-- Modal -->
										    <div class="modal fade" id="confirmDelete_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										      <div class="modal-dialog modal-dialog-centered" role="document">
										        <div class="modal-content">
										          <div class="modal-header bg-dark">
										            <h5 class="modal-title" id="exampleModalLongTitle">Confirmación</h5>
										            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										              <span aria-hidden="true">&times;</span>
										            </button>
										          </div>
										          <div class="modal-body bg-secondary">
										            ¿Estás seguro que deseas eliminar este usuario?
										          </div>
										          <div class="modal-footer bg-secondary">
										            <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
										            <button type="submit" class="btn btn-danger">Eliminar</button>
										          </div>
										        </div>
										      </div>
										    </div>
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
			</div>
		</div>
	</div>
@endsection

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
@endsection