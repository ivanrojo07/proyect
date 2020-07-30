<ul>
	@if ($plataforma360 = Session::get("modulos360.plataforma360"))
		<li>
			<a href="#" onclick="crearLiga('{{$plataforma360['url']}}/API/cuenta360/access_token/')">
				<div></div>
				<label>Plataforma 360</label>
			</a>
		</li>
	@endif
	@if ($telemedicina_medico = Session::get("modulos360.telemedicina_medico"))
		<li>
			<a href="#">
				<div></div>
				<label>Telemedicina Medico</label>
			</a>
		</li>
	@endif

	@if ($telemedicina_paciente = Session::get("modulos360.telemedicina_paciente"))
		<li>
			<a href="#">
				<div></div>
				<label>Telemedicina Paciente</label>
			</a>
		</li>
	@endif


	@if ($facturacion = Session::get("modulos360.facturacion"))
		<li>
			<a href="#">
				<div></div>
				<label>Facturación</label>
			</a>
		</li>
	@endif


	@if ($app360 = Session::get("modulos360.app360"))
		<li>
			<a href="#">
				<div></div>
				<label>App 360</label>
			</a>
		</li>
	@endif


	@if ($mapagis = Session::get("modulos360.mapagis"))
		<li>
			<a href="#">
				<div></div>
				<label>Mapa GIS</label>
			</a>
		</li>
	@endif


	@if ($lineamientos = Session::get("modulos360.lineamientos"))
		<li>
			<a href="#">
				<div></div>
				<label>Lineamientos</label>
			</a>
		</li>
	@endif


	@if ($plan_interno = Session::get("modulos360.plan_interno"))
		<li>
			<a href="#" onclick="crearLiga('https://planfamiliar-pc.ml/API/cuenta360/access_token/')">
				<div></div>
				<label>Plan Interno</label>
			</a>
		</li>
	@endif
</ul>

@section('scripts')
	<script type="text/javascript">
		function crearLiga($url){
			var params = {
				"user_id" : "{{Session::get('claro360.id')}}",
				"token" : "{{Session::get('claro360.token')}}"
			};
			var id, access_token;
			console.log(params);
			axios.post("{{ route('getAccessToken') }}",params)
				.then(res=>{
					var data = res.data;
					id = data.id360;
					access_token = data.access_token
					if (id && access_token) {
						window.open($url+`${id}/${access_token}`);
					}
					else{
						alert('No se puede acceder a esta pagina, intentalo mas tarde');
					}
				})
				.catch(err=>alert(err.message));

			
		}
	</script>
@endsection