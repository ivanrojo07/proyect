@extends('layouts.layoutBase')

{{-- Menu incidentes, calendario y pestañas de navegacion (se requiere titulo de la pestaña y la fecha a donde redirigirse) --}}
@include('registro_incidente.menu', ['titulo' => 'Registro de Incidentes', 'fecha'=>$fecha])

{{-- Contenido de la vista --}}
@section('contenido')
	<div class="panel-content">
		<div class="col-12 d-flex justify-content-between">
			<label style="margin-top:1%;margin-left:1%;"><h4 style="font-size: 15px;font-weight: bold;">{{ date('d-F-Y',strtotime($fecha)) }}</h4></label>
				@if ($registro_incidentes->isNotEmpty())
					<!-- Button trigger modal -->
					<button type="button" class="btn boton2 mt-3" data-toggle="modal" data-target="#pdfIncidentes">
					  Descargar PDF
					</button>
				@endif
		</div>
		<ul class="nav nav-tabs"  >
			<li ><a  href="{{ url('/incidente')}}?fecha={{ $fecha }}" style="color: white;"  class="activo">Incidentes</a></li>
		  	<li ><a   href="#"  style="color: white;" class="ocultar" >Información del Incidente </a></li>
		</ul>
	</div>
	<div class="panel-body">
		<div style="overflow: auto;">
			<div class="tab-content">
				<div class="col-12">
					<table id="tablaPaginado" class="text-center" cellspacing="0" width="100%">
						<thead id="tablaEncabezadoIncidentes">
							<tr>
								<th>
									Serie
								</th>
								<th>
									Fecha de Ocurrencia
								</th>
								<th>
									Incidentes
								</th>
								<th>
									Estado
								</th>
								<th>
									Tipo de Seguimiento
								</th>
								<th>
									Elaboró
								</th>
								<th>
									Revisó
								</th>
							</tr>
						</thead>
						<tbody id="tablaListaIncidentes">
							@forelse ($registro_incidentes as $incidente)
								<tr>
									<td class="{{ $incidente->impacto->nombre }}">
										<a href="{{ route('incidente.show',['incidente'=>$incidente]) }}" style="text-decoration: none; color: white;">
											{{$incidente->id}}
										</a>
									</td>
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
										{{$incidente->user->full_name}}
									</td>
									<td>
										{{$incidente->user->institucion->nombre}}
									</td>
								</tr>
							@empty
								<div class="alert h4" role="alert">
              						Ningun incidente registrado.
            					</div>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	{{-- MODAL PDF --}}
	 <!-- Modal -->
	<div class="modal fade" id="pdfIncidentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 65%">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title" id="exampleModalLongTitle">PDF Incidentes del {{$fecha}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body bg-secondary">
					<iframe class="w-100" style="height: 80vh;" src="{{ url('pdf/incidente') }}?fecha={{$fecha}}" title="Incidentes PDF">
					</iframe>      
				</div>
				<div class="modal-footer bg-secondary">
					<button type="button" class="btn boton1" data-dismiss="modal">Cerrar</button>
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

           window.location = "{{ url('/incidente')}}"+"?fecha="+nuevafecha;
         },
         maxDate: 0
        });
        $( "#datepicker" ).datepicker( "setDate", "{{date('d-m-Y',strtotime($fecha))}}" );

        function cambiarFormulario(tab){
        	tabs = ['tipo','serie'];
        	if(tabs.includes(tab)){
        		tabs.forEach(t=>{
        			if(t !== tab){
        				$(`#${t}`).val('');
        			}
        		})
        	}
        }
    </script>
@endsection