<ul>
	@if ($plataformas360 = Session::get("modulos360.plataforma360"))
		@foreach ($plataformas360 as $plataforma360)
			<li>
				<a href="#" onclick="crearLiga('{{$plataforma360['url']}}API/cuenta360/access_token/')">
					<div></div>
					<label>Plataforma 360</label>
				</a>
			</li>
		@endforeach
	@endif
	@if ($telemedicina_medico = Session::get("modulos360.telemedicina_medico"))
		<li>
			<a href="#" onclick="crearLiga('{{$telemedicina_medico['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Telemedicina Medico</label>
			</a>
		</li>
	@endif

	@if ($telemedicina_paciente = Session::get("modulos360.telemedicina_paciente"))
		<li>
			<a href="#" onclick="crearLiga('{{$telemedicina_paciente['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Telemedicina Paciente</label>
			</a>
		</li>
	@endif


	@if ($facturacion = Session::get("modulos360.facturacion"))
		<li>
			<a href="#" onclick="crearLiga('{{$facturacion['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Facturación</label>
			</a>
		</li>
	@endif


	@if ($app360 = Session::get("modulos360.app360"))
		<li>
			<a href="#" onclick="crearLiga('{{$app360['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>App 360</label>
			</a>
		</li>
	@endif


	@if ($mapagis = Session::get("modulos360.mapagis"))
		<li>
			<a href="#" onclick="crearLiga('{{$mapagis['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Mapa GIS</label>
			</a>
		</li>
	@endif


	@if ($lineamientos = Session::get("modulos360.lineamientos"))
		<li>
			<a href="#" onclick="crearLiga('{{$lineamientos['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Lineamientos</label>
			</a>
		</li>
	@endif


	@if ($plan_interno = Session::get("modulos360.plan_interno"))
		<li>
			<a href="#" onclick="crearLiga('{{$plan_interno['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Plan Interno</label>
			</a>
		</li>
	@endif


	@if ($videovigilancia = Session::get("modulos360.videovigilancia"))
		<li>
			<a href="#" onclick="crearLiga('{{$videovigilancia['url']}}API/cuenta360/access_token/')">
				<div></div>
				<label>Video Vigilancia</label>
			</a>
		</li>
	@endif
</ul>

@section('scripts')
	<script type="text/javascript">
		function crearLiga($url){
			var params = {
				"user_id" : "{{Session::get('claro360.id')}}",
				"token" : "{{Auth::user()->claro_token}}"
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