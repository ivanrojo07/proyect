@extends('layouts.app')
@section('content')
	<div class="container-fluid d-md-flex d-block">
		@include('covid.menu', ['institucion' => Auth::user()->institucion,'fecha' => $fecha])
		<div class="col-12 col-md-9">
			<div class="card bg-secondary text-white mt-3 mb-5">
				<div class="card-header bg-dark">
					<h4>Registro COVID-19</h4>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-dark table-bordered text-center">
						<thead>
							<tr>
								<th scope="col">
									Serie
								</th>
								<th scope="col">
									Fecha
								</th>
								<th scope="col">
									Ubicación
								</th>
								<th scope="col">
									Posible nivel de Gravedad
								</th>
								<th scope="col">
									Elaboró
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($registros as $registro)
								<tr>
									<th scope="row">
										<a href="{{ route('covid.show',['covid'=>$registro]) }}" class="badge badge-secondary">
											{{$registro->id}}
										</a>
									</th>
									<td>
										{{$registro->fecha}}
										{{$registro->hora}}
									</td>
									<td>
										Latitud: {{$registro->lat}}
										Longitud: {{{$registro->lng}}}
									</td>
									<td>
										{{ $registro->rango }}
									</td>
									<td>
										{{$registro->user->nombre}}
									</td>
								</tr>
							@empty
								<div class="alert alert-info" role="alert">
									No hay registro de este día
								</div>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					{{$registros->appends(['fecha'=>$fecha])->render()}}
				</div>
			</div>
		</div>
	</div>
@endsection
