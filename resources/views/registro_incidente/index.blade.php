@extends('layouts.app')
@section('content')
	<div class="container-fluid d-flex">
		<div class="w-25 p-3 mr-3 bg-dark text-white">
			<div class="card bg-secondary text-center mt-3 ">
				<div class="card-header">
					<h4>{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
				</div>
				<div class="card-body">
					<form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
						<input class="form-control" type="date" name="fecha" id="fecha" value="{{$fecha}}" max="{{Date('Y-m-d')}}">
					</form>
				</div>
				<div class="card-footer">
					<a href="{{ route('incidente.create') }}" class="btn btn-block btn-info">Nuevo incidente</a>
				</div>
			</div>
		</div>
		<div class="w-75">
			<div class="card bg-secondary">
				<div class="card-header text-white bg-dark">
					Incidentes
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-dark table-bordered text-center">
						<thead>
							<tr>
								<th scope="col">
									Serie
								</th>
								<th scope="col">
									Fecha de ocurrencia
								</th>
								<th scope="col">
									Incidente
								</th>
								<th scope="col">
									Estado 
								</th>
								<th scope="col">
									Tipo de Seguimiento
								</th>
								<th scope="col">
									Elaboró
								</th>
								<th scope="col">
									Revisó
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($registro_incidentes as $incidente)
								<tr>
									<th scope="row">
										<a href="{{ route('incidente.show',['incidente'=>$incidente]) }}" class="badge {{ 
				$incidente->impacto->nombre == 'Alto' ? 'bg-danger text-white' : (
					$incidente->impacto->nombre == 'Medio' ? 'bg-warning text-dark' :
						'bg-success text-white')}}">
											{{ $incidente->id }}
										</a>
									</th>
									<td>
										{{$incidente->fecha_ocurrencia}}
										{{$incidente->hora_ocurrencia}}
									</td>
									<td>
										{{$incidente->catalogo_incidente->clave." ".$incidente->catalogo_incidente->nombre}}
									</td>
									<td>
										{{$incidente->estado->nombre}}
									</td>
									<td>
										{{$incidente->seguimiento->nombre}}
									</td>
									<td>
										{{$incidente->user->nombre}}
									</td>
									<td>
										{{$incidente->user->nombre}}
									</td>
								</tr>
							@empty
								<div class="alert alert-info" role="alert">
									No hay registros de este día.
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="card-footer text-white bg-dark d-flex justify-content-around">
					{{$registro_incidentes->appends(['fecha'=>$fecha])->render()}}
					@if ($registro_incidentes->isNotEmpty())
						<form class="inline" target="_blank" action="{{ route('pdf.incidente.index') }}" method="GET">
							@csrf
							<input type="hidden" name="fecha" value="{{$fecha}}">
							<button type="submit" class="btn btn-info">Descargar</button>
						</form> 
					@endif
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