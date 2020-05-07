@extends('layouts.app')
@section('content')
<div class="container-fluid d-flex">
	@include('covid.menu', ['fecha' => Date('Y-m-d')])
	<div class="w-75">
		<div class="card bg-secondary text-white">
			<div class="card-header bg-dark">
				<h4>Nuevo registro COVID-19</h4>
			</div>
			<form method="POST" action="{{ route('covid.store') }}">
				@csrf
				<div class="card-body">
					<div class="text-center text-white">
						<h5>Perfil Usuario</h5>
					</div>
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<div class="row"> 
						 <div class="col-4">
						 	<label for="edad" class="text-md-left col-form-label-sm">Edad</label>
						 	<div class="input-group mb-3">
						 		<input type="number" class="form-control" name="edad" id="edad" min="0" max="120" value="{{ old('edad') }}">
						 		<div class="input-group-append">
						 			<span class="input-group-text">
						 				Años
						 			</span>
						 		</div>
						 	</div>
						 </div>
						 <div class="col-4">
						 	<label for="genero" class="text-md-left col-form-label-sm">
						 		Genero
						 	</label>
						 	<select class="form-control" id="genero" name="genero" required="">
						 		<option value="">Seleccione una opción</option>
						 		<option value="Mujer" {{ old('genero') == "Mujer" ? "selected=''" : "" }}>Mujer</option>
						 		<option value="Hombre" {{ old('genero') == "Hombre" ? "selected=''" : "" }}>Hombre</option>
						 	</select>
						 </div>
						 <div class="col-4">
						 	<label for="codigo_postal" class="text-md-left col-form-label-sm">Código Postal</label>
						 	<input type="text" class="form-control" pattern="[0-9]{5}" name="codigo_postal" id="codigo_postal" title="El código postal consta de 5 números" value="{{ old('codigo_postal') }}">
						 </div>
					</div>
					<div class="text-center text-white">
						<h5>Test COVID-19</h5>
					</div>
					<div class="form-group row">
						<div class="col-4">
							<label for="convivir_enfermo" class="text-md-left col-form-label-sm">
								¿Has convivido con alguna persona que sea un caso confirmado de COVID-19 (Coronavirus)?
							</label>
							<select class="form-control" id="convivir_enfermo" name="convivir_enfermo" required="">
								<option value="">Seleccione una opción</option>
								<option data-convivir_enfermo="3" value="1" {{ old('convivir_enfermo') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-convivir_enfermo="0" value="0" {{ old('convivir_enfermo') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="fiebre" class="text-md-left col-form-label-sm">
								¿Tienes fiebre? (Temperatura igual o mayor a 38ºC)
							</label>
							<select class="form-control" id="fiebre" name="fiebre" required="">
								<option value="">Seleccione una opción</option>
								<option data-fiebre="2" value="1" {{ old('fiebre') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-fiebre="0" value="0" {{ old('fiebre') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="dolor_cabeza" class="text-md-left col-form-label-sm">
								¿Tienes dolor de cabeza?
							</label>
							<select class="form-control" id="dolor_cabeza" name="dolor_cabeza">
								<option value="">Seleccione una opción</option>
								<option data-dolor_cabeza="1" value="1" {{ old('dolor_cabeza') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-dolor_cabeza="0" value="0" {{ old('dolor_cabeza') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-4">
							<label for="tos" class="text-md-left col-form-label-sm">
								¿Tienes tos?
							</label>
							<select class="form-control" id="tos" name="tos" required="">
								<option value="">Seleccione una opción</option>
								<option data-tos="2" value="1" {{ old('tos') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-tos="0" value="0" {{ old('tos') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="dolor_pecho" class="text-md-left col-form-label-sm">
								¿Tienes dolor en el pecho?
							</label>
							<select class="form-control" id="dolor_pecho" name="dolor_pecho" required="">
								<option value="">Seleccione una opción</option>
								<option data-dolor_pecho="1" value="1" {{ old('dolor_pecho') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-dolor_pecho="0" value="0" {{ old('dolor_pecho') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="dolor_garganta" class="text-md-left col-form-label-sm">
								¿Tienes dolor de garganta?
							</label>
							<select class="form-control" id="dolor_garganta" name="dolor_garganta" required="">
								<option value="">Seleccione una opción</option>
								<option data-dolor_garganta="1" value="1" {{ old('dolor_garganta') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-dolor_garganta="0" value="0" {{ old('dolor_garganta') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-4">
							<label for="dificultad_respirar" class="text-md-left col-form-label-sm">
								¿Tienes dificultad para respirar?
							</label>
							<select class="form-control" id="dificultad_respirar" name="dificultad_respirar" required="">
								<option value="">Seleccione una opción</option>
								<option data-dificultad_respirar="2" value="1" {{ old('dificultad_respirar') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-dificultad_respirar="0" value="0" {{ old('dificultad_respirar') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="escurrimiento_nasal" class="text-md-left col-form-label-sm">
								¿Tienes escurrimiento nasal?
							</label>
							<select class="form-control" id="escurrimiento_nasal" name="escurrimiento_nasal" required="">
								<option value="">Seleccione una opción</option>
								<option data-escurrimiento_nasal="2" value="1" {{ old('escurrimiento_nasal') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-escurrimiento_nasal="0" value="0" {{ old('escurrimiento_nasal') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-4">
							<label for="dolor_cuerpo" class="text-md-left col-form-label-sm">
								¿Tienes dolor en el cuerpo?
							</label>
							<select class="form-control" id="dolor_cuerpo" name="dolor_cuerpo" required="">
								<option value="">Seleccione una opción</option>
								<option data-dolor_cuerpo="2" value="1" {{ old('dolor_cuerpo') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-dolor_cuerpo="0" value="0" {{ old('dolor_cuerpo') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-4">
							<label for="conjuntivitis" class="text-md-left col-form-label-sm">
								¿Tienes conjuntivitis?
							</label>
							<select class="form-control" id="conjuntivitis" name="conjuntivitis" required="">
								<option value="">Seleccione una opción</option>
								<option data-conjuntivitis="1" value="1" {{ old('conjuntivitis') == '1' ? "selected=''" : "" }} >Si</option>
								<option data-conjuntivitis="0" value="0" {{ old('conjuntivitis') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-8">
							<label for="condiciones_medicas" class="text-md-left col-form-label-sm">
								¿Tienes alguna de las siguientes condiciones? (diabetes, hipertensión, obesidad, problemas cardiacos, asma, EPOC, VIH, cáncer)
							</label>
							<select class="form-control" id="condiciones_medicas" name="condiciones_medicas" required="">
								<option value="">Seleccione una opción</option>
								<option data-condiciones_medicas="2" value="1" {{ old('condiciones_medicas') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-condiciones_medicas="0" value="0" {{ old('condiciones_medicas') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
					</div>
					<div class="form-group row d-none" id="only_woman">
						<div class="col-6">
							<label for="embarazada" class="text-md-left col-form-label-sm">
								¿Estás embarazada?
							</label>
							<select class="form-control" id="embarazada" name="embarazada">
								<option value="">Seleccione una opción</option>
								<option data-embarazada="2" value="1" {{ old('embarazada') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-embarazada="0" value="0" {{ old('embarazada') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-6">
							<label for="meses_embarazo" class="text-md-left col-form-label-sm">
								¿Tienes 6 o más meses de embarazo?
							</label>
							<select class="form-control" id="meses_embarazo" name="meses_embarazo">
								<option value="">Seleccione una opción</option>
								<option data-meses_embarazo="2" value="1" {{ old('meses_embarazo') == '1' ? "selected=''" : "" }}>Si</option>
								<option data-meses_embarazo="0" value="0" {{ old('meses_embarazo') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
					</div>
					<div class="form-group row d-none" id="more_info">
						<div class="col-3">
							<label for="dias_sintomas" class="text-md-left col-form-label-sm">
								¿Hace cuántos días iniciaron tus síntomas? Escribe el número de días, si iniciaron hoy responde "0"
							</label>
							<input class="form-control " type="number" name="dias_sintomas" id="dias_sintomas" step="1" min="-1" value="{{ old('dias_sintomas') }}">
						</div>
						<div class="col-3">
							<label for="dolor_respirar" class="text-md-left col-form-label-sm">
								¿Sientes dolor al respirar?
							</label>
							<select class="form-control" name="dolor_respirar" id="dolor_respirar">
								<option value="">Seleccione una opción</option>
								<option data-dolor_respirar="3" value="1" {{ old('dolor_respirar') == '1' ? "selected=''" : "" }}>Si</option>
								<option value="0" data-dolor_respirar="0" {{ old('dolor_respirar') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-3">
							<label for="falta_aire" class="text-md-left col-form-label-sm">¿Sientes falta de aire al hablar o caminar algunos pasos?</label>
							<select name="falta_aire" id="falta_aire" class="form-control">
								<option value="">Seleccione una opción</option>
								<option value="1" data-falta_aire="3" {{ old('falta_aire') == '1' ? "selected=''" : "" }}>Si</option>
								<option value="0" data-falta_aire="0" {{ old('falta_aire') == '0' ? "selected=''" : "" }}>No</option>
							</select>
						</div>
						<div class="col-3">
							<label for="coloracion_azul" class="text-md-left col-form-label-sm">¿Tienes coloración azul o morada en labios, dedos o uñas?</label>
							<select name="coloracion_azul" id="coloracion_azul" class="form-control">
								<option value="">Seleccione una opción</option>
								<option value="1" data-coloracion_azul="3" {{ old('coloracion_azul') == '1' ? "selected=''" : "" }}>Si</option>
								<option value="0" data-coloracion_azul="0" {{ old('coloracion_azul') == '0' ? "selected=''" : "" }}>No</option>
							</select>
							<input type="hidden" id="score" name="score" value="{{ old('score') }}">
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Registrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("#genero").change(function(){
			if ($(this).val() == "Mujer") {
				$("#only_woman").removeClass("d-none").addClass("d-flex");
				$("#embarazada").attr("required",true);
				$("#meses_embarazo").attr("required",true);
			}
			else{
				$("#only_woman").removeClass("d-flex").addClass("d-none");
				$("#embarazada").val("").removeAttr("required");
				$("#meses_embarazo").val("").removeAttr("required");
			}
		});
		$("select").change(function(){
			getScore();
		});
		$("#dias_sintomas").change(function(){
			getScore();
		});

		function getScore() {
			var score= 0;
			var value_convivirEnfermo = $("#convivir_enfermo").children("option:selected").attr('data-convivir_enfermo') ?  $("#convivir_enfermo").children("option:selected").attr('data-convivir_enfermo') : 0;
			console.log(value_convivirEnfermo);
			score += + value_convivirEnfermo;
			var value_fiebre = $("#fiebre").children("option:selected").attr('data-fiebre') ? $("#fiebre").children("option:selected").attr('data-fiebre') : 0;
			console.log(value_fiebre);
			score += + value_fiebre;
			var value_dolorCabeza = $("#dolor_cabeza").children('option:selected').attr("data-dolor_cabeza") ? $("#dolor_cabeza").children('option:selected').attr("data-dolor_cabeza") : 0;
			console.log(value_dolorCabeza);
			score += + value_dolorCabeza;
			var value_tos = $("#tos").children('option:selected').attr("data-tos") ? $("#tos").children('option:selected').attr("data-tos") : 0;
			console.log(value_tos);
			score += + value_tos;
			var dolorPecho = $("#dolor_pecho").children('option:selected').attr("data-dolor_pecho") ? $("#dolor_pecho").children('option:selected').attr("data-dolor_pecho") : 0;
			console.log(dolorPecho);
			score += + dolorPecho;
			var dolorGarganta = $("#dolor_garganta").children('option:selected').attr("data-dolor_garganta") ? $("#dolor_garganta").children('option:selected').attr("data-dolor_garganta") : 0;
			console.log(dolorGarganta);
			score += + dolorGarganta;
			var dificultadRespirar = $("#dificultad_respirar").children('option:selected').attr("data-dificultad_respirar") ? $("#dificultad_respirar").children('option:selected').attr("data-dificultad_respirar") : 0;
			console.log(dificultadRespirar);
			score += + dificultadRespirar;
			var escurrimientoNasal = $("#escurrimiento_nasal").children('option:selected').attr('data-escurrimiento_nasal') ? $("#escurrimiento_nasal").children('option:selected').attr('data-escurrimiento_nasal') : 0;
			score += + escurrimientoNasal;
			var dolorCuerpo = $("#dolor_cuerpo").children('option:selected').attr('data-dolor_cuerpo') ? $("#dolor_cuerpo").children('option:selected').attr('data-dolor_cuerpo') : 0;
			score += + dolorCuerpo;
			var conjuntivitis = $("#conjuntivitis").children("option:selected").attr('data-conjuntivitis') ? $("#conjuntivitis").children("option:selected").attr('data-conjuntivitis') : 0;
			score += + conjuntivitis;
			var condicionesMedicas = $("#condiciones_medicas").children("option:selected").attr("data-condiciones_medicas") ? $("#condiciones_medicas").children("option:selected").attr("data-condiciones_medicas") : 0;
			score += + condicionesMedicas;
			var embarazada = $("#embarazada").children("option:selected").attr("data-embarazada") ? $("#embarazada").children("option:selected").attr("data-embarazada") : 0;
			score += + embarazada;
			var mesesEmbarazo = $("#meses_embarazo").children("option:selected").attr("data-meses_embarazo") ? $("#meses_embarazo").children("option:selected").attr("data-meses_embarazo") : 0;
			score += + mesesEmbarazo;
			var dolorRespirar = $("#dolor_respirar").children("option:selected").attr("data-dolor_respirar") ? $("#dolor_respirar").children("option:selected").attr("data-dolor_respirar") : 0;
			score += + dolorRespirar;
			var faltaAire = $("#falta_aire").children("option:selected").attr("data-falta_aire") ? $("#falta_aire").children("option:selected").attr("data-falta_aire") : 0;
			score += + faltaAire;
			var coloracionAzul = $("#coloracion_azul").children("option:selected").attr("data-coloracion_azul") ? $("#coloracion_azul").children("option:selected").attr("data-coloracion_azul") : 0;
			score += + coloracionAzul;
			if (score > 8) {
				$("#more_info").removeClass("d-none").addClass("d-flex");
				$("#dias_sintomas").attr("required",true);
				$("#falta_aire").attr("required",true);
				$("#dolor_respirar").attr("required",true);
				$("#coloracion_azul").attr("required",true);

			}
			else{
				$("#more_info").removeClass("d-flex").addClass("d-none");
				$("#dias_sintomas").val(-1).removeAttr("required");
				$("#falta_aire").val("").removeAttr("required");
				$("#dolor_respirar").val("").removeAttr("required");
				$("#coloracion_azul").val("").removeAttr("required");
			}

			var diasSintomas = $("#dias_sintomas").val();
			if (diasSintomas == 0) {
				score += + 1;
			}
			else if(diasSintomas >0 && diasSintomas <= 3){
				score += + 2;
			}
			else if (diasSintomas >3 &&  diasSintomas <= 7) {
				score += + 3;
			}
			else if(diasSintomas == -1){
				score += + 0
			}
			else{
				score += + 4;
			}

			$("#score").val(score);
		}
	</script>
@endpush