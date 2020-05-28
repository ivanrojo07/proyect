@extends('layouts.pdf')
@section('content')
	<div class="page">
		<div class="card w-100">
			<div class="card-header row">
				<h3 class="col-10">
					Lista de Incidentes
				</h3>
				<span class="col-2 badge badge-pill badge-secondary">
					{{$fecha}}
				</span>
			</div>
			<div class="card-body">
				<table class="table table-bordered text-center">
					<thead>
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
					</thead>
					<tbody>
						@forelse ($incidentes as $key=>$incidente)
							<tr>
								<th scope="row" class="{{$incidente->impacto->nombre}}">
									<span class="badge">
										{{$incidente->id}}
									</span>
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
			<div class="card-footer text-muted d-flex justify-content-between">
				<p>
					{{Date('Y-m-d')}}
				</p>
				<p>
					{{ $institucion ? $institucion->nombre : "Claro 360."}}
				</p>
				<p>
					Descargado por: {{Auth::user()->nombre}}
				</p>
			</div>
		</div>
	</div>
@endsection