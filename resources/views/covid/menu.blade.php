<div class="w-25 p-3 mr-3 bg-dark text-white">
	<div class="card bg-secondary text-center mt-3">
		<div class="card-header">
			<h4>COVID-19</h4>
		</div>
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
@push('scripts')
	<script type="text/javascript">
		$("#fecha").change(function(){
			$("#changeFecha").submit();
		})
	</script>
@endpush