@extends('layouts.layoutBase')

{{-- Menú lateral izquierdo con botones de navegacion (agregar titulo de la pestaña) --}}
@include('covid.menu', ['titulo' => "Registro COVID-19"])

{{-- Contenido de la vista --}}
@section('contenido')
<div class="panel-content">
	<div class="col-12 d-flex justify-content-between">
		<label style="margin-top:1%;margin-left:1%;"><h4 style="font-size: 15px;font-weight: bold;">{{ date('d-F-Y',strtotime($fecha)) }}</h4></label>
	</div>
	<ul class="nav nav-tabs"  >
		<li ><a  href="{{ url('/covid')}}?fecha={{ $fecha }}" style="color: white;"  class="activo">Registro COVID-19</a></li>
	  	<li ><a   href="#"  style="color: white;" class="ocultar" >Información del COVID-19 </a></li>
	</ul>
</div>
<div class="panel-body">
	<div style="overflow: auto;">
		<div class="tab-content">
			<div class="col-12">
				<table id="tablaPaginado" class="text-center" cellspacing="0" width="100%">
					<thead id="tablaEncabezadoIncidentes">
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
					<tbody id="tablaListaIncidentes">
						@forelse ($registros as $registro)
							<tr>
								<th scope="row">
									<a href="{{ route('covid.show',['covid'=>$registro]) }}" class="btn btn-link text-white">
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
		</div>
	</div>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery-flexdatalist-2.2.1/jquery.flexdatalist.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/funciones/exp1.js') }}"></script>
	<script>
	

        $("#datepicker").datepicker({
          onSelect: function(e) {
	    var diafecha=e;
            var fechaarray=diafecha.split('-');
            var fechainvertir=fechaarray.reverse();
            var nuevafecha=fechainvertir.join('-');
            console.log(nuevafecha);

           window.location = "{{ url('/covid')}}"+"?fecha="+nuevafecha;
         },
         maxDate: 0
        });
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($fecha))}}" );
    </script>
@endsection