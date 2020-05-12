<div class="col-12 col-md-3 text-white">
	<div class="card bg-secondary text-center mt-3">
		<div class="card-header navbar-dark d-flex justify-content-between bg-dark">
			<h4 class="align-self-center">{{$institucion ? $institucion->nombre : "CLARO 360"}}</h4>
			<button class="btn d-md-none" type="button" data-toggle="collapse" data-target="#covid-menu">
				<span class="navbar-light">
					<span class="navbar-toggler-icon"></span>
				</span>
			</button>
		</div>
		<div id="covid-menu" class="collapse d-md-block">
			<div class="card-body">
				<form class="inline" id="changeFecha" method="GET" action="{{ route('covid.index') }}">
					<input type="date" class="form-control" name="fecha" id="fecha" value="{{$fecha}}" max="{{Date('Y-m-d')}}">
				</form>
			</div>
			<div class="card-footer">
				<a href="{{ route('covid.create') }}" class="btn btn-block btn-info">
					Nuevo registro de COVID-19
				</a>
			</div>
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