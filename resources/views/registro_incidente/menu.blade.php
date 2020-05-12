<div class="card bg-secondary text-center mt-3">
	<div class="card-header navbar-dark d-flex justify-content-between bg-dark">
		<h4 class="align-self-center">{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
		<button class="btn d-md-none" type="button" data-toggle="collapse" data-target="#incidente-menu">
			<span class="navbar-light">
				<span class="navbar-toggler-icon"></span>
			</span>
		</button>
	</div>
	<div id="incidente-menu" class="collapse d-md-block">
		<div class="card-body">
			<form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
				<input class="form-control" type="date" name="fecha" id="fecha" value="{{$fecha}}" max="{{Date('Y-m-d')}}">
			</form>
		</div>
		<div class="card-footer bg-dark">
			<a href="{{ route('incidente.create') }}" class="btn btn-block btn-info">Nuevo incidente</a>
			<a href="{{ route('incidente.index',['fecha'=>$fecha])}}" class="btn btn-block btn-success">Incidentes del día</a>
		</div>
	</div>
</div>
@push('scripts')
	<script type="text/javascript">
		$("#fecha").change(function(){
			$("#changeFecha").submit();
		})
	</script>
@endpush