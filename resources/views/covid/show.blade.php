@extends('layouts.app')
@section('content')
<div class="row">
	@include('covid.menu', ['fecha' => $covid->fecha])
	<div class="col-9">
		<div class="card bg-secondary text-white">
			<div class="card-header bg-dark">
				<h4>Registro COVID-19</h4>
			</div>
			<div class="card-body">
				<div class="text-center text-white">
					<h5>Perfil Usuario</h5>
				</div>
				<div class="row"> 
					 <div class="col-4">
					 	<label class="text-md-left col-form-label-sm">Edad</label>
					 	<div class="input-group mb-3">
					 		<input type="text" readonly="" class="form-control" value="{{$perfil->edad}}">
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
					 	<input type="text" class="form-control" readonly="" value="{{$perfil->genero}}">
					 </div>
					 <div class="col-4">
					 	<label for="codigo_postal" class="text-md-left col-form-label-sm">Código Postal</label>
					 	<input type="text" class="form-control" readonly="" value="{{$perfil->codigo_postal}}">
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
						<input type="text" class="form-control" readonly="" value="{{$covid->convivir_enfermo == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="fiebre" class="text-md-left col-form-label-sm">
							¿Tienes fiebre? (Temperatura igual o mayor a 38ºC)
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->fiebre == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="dolor_cabeza" class="text-md-left col-form-label-sm">
							¿Tienes dolor de cabeza?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->dolor_cabeza == 1 ? 'Si' : 'No'}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-4">
						<label for="tos" class="text-md-left col-form-label-sm">
							¿Tienes tos?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->tos == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="dolor_pecho" class="text-md-left col-form-label-sm">
							¿Tienes dolor en el pecho?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->dolor_pecho == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="dolor_garganta" class="text-md-left col-form-label-sm">
							¿Tienes dolor de garganta?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->dolor_garganta == 1 ? 'Si' : 'No'}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-4">
						<label for="dificultad_respirar" class="text-md-left col-form-label-sm">
							¿Tienes dificultad para respirar?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->dificultad_respirar == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="escurrimiento_nasal" class="text-md-left col-form-label-sm">
							¿Tienes escurrimiento nasal?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->escurrimiento_nasal == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-4">
						<label for="dolor_cuerpo" class="text-md-left col-form-label-sm">
							¿Tienes dolor en el cuerpo?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->dolor_cuerpo == 1 ? 'Si' : 'No'}}">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-4">
						<label for="conjuntivitis" class="text-md-left col-form-label-sm">
							¿Tienes conjuntivitis?
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->conjuntivitis == 1 ? 'Si' : 'No'}}">
					</div>
					<div class="col-8">
						<label for="condiciones_medicas" class="text-md-left col-form-label-sm">
							¿Tienes alguna de las siguientes condiciones? (diabetes, hipertensión, obesidad, problemas cardiacos, asma, EPOC, VIH, cáncer)
						</label>
						<input type="text" class="form-control" readonly="" value="{{$covid->condiciones_medicas == 1 ? 'Si' : 'No'}}">
					</div>
				</div>
				@if ($perfil->genero == "Mujer")
					<div class="form-group row">
						<div class="col-6">
							<label for="embarazada" class="text-md-left col-form-label-sm">
								¿Estás embarazada?
							</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->embarazada == 1 ? 'Si' : 'No'}}">
						</div>
						<div class="col-6">
							<label for="meses_embarazo" class="text-md-left col-form-label-sm">
								¿Tienes 6 o más meses de embarazo?
							</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->meses_embarazo == 1 ? 'Si' : 'No'}}">
						</div>
					</div>
				@endif
				@if ($covid->rango > 8)
					<div class="form-group row">
						<div class="col-3">
							<label for="dias_sintomas" class="text-md-left col-form-label-sm">
								¿Hace cuántos días iniciaron tus síntomas? Escribe el número de días, si iniciaron hoy responde "0"
							</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->dias_sintomas}}">
						</div>
						<div class="col-3">
							<label for="dolor_respirar" class="text-md-left col-form-label-sm">
								¿Sientes dolor al respirar?
							</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->dolor_respirar == 1 ? 'Si' : 'No'}}">
						</div>
						<div class="col-3">
							<label for="falta_aire" class="text-md-left col-form-label-sm">¿Sientes falta de aire al hablar o caminar algunos pasos?</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->falta_aire == 1 ? 'Si' : 'No'}}">
						</div>
						<div class="col-3">
							<label for="coloracion_azul" class="text-md-left col-form-label-sm">¿Tienes coloración azul o morada en labios, dedos o uñas?</label>
							<input type="text" class="form-control" readonly="" value="{{$covid->coloracion_azul == 1 ? 'Si' : 'No'}}">
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection