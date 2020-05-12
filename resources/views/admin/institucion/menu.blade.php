<div class="card bg-secondary text-center mt-3 ">
	<div class="card-header navbar-dark d-flex justify-content-between bg-dark">
		<h4 class="align-self-center">{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
		<button class="btn d-md-none" type="button" data-toggle="collapse" data-target="#institucion-menu">
			<span class="navbar-light">
				<span class="navbar-toggler-icon"></span>
			</span>
		</button>
	</div>
	<div id="institucion-menu" class="collapse d-md-block">
		<div class="card-body">
			<form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
				<input class="form-control" type="date" name="fecha" id="fecha" value="{{$fecha}}" max="{{Date('Y-m-d')}}">
			</form>
		</div>
		<div class="card-footer bg-dark">
			<a href="{{ route('admin.institucion.create') }}" class="btn btn-block btn-info">Nueva institución</a>
			<a href="{{ route('admin.institucion.index') }}" class="btn btn-block btn-success">Lista de instituciones</a>
		</div>
	</div>
</div>