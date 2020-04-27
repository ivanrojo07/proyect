@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellido_paterno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                            <div class="col-md-6">
                                <input id="apellido_paterno" type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required autocomplete="apellido_paterno" autofocus>

                                @error('apellido_paterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apellido_materno" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                            <div class="col-md-6">
                                <input id="apellido_materno" type="text" class="form-control @error('apellido_materno') is-invalid @enderror" name="apellido_materno" value="{{ old('apellido_materno') }}" autocomplete="apellido_materno" autofocus>

                                @error('apellido_materno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo_catalogo" class="col-md-4 col-form-label text-md-right">{{ __('Catalogo') }}</label>

                            <div class="col-md-6">
                                <select id="tipo_catalogo" class="form-control @error('tipo_catalogo') is-invalid @enderror" name="tipo_catalogo">
                                    <option value="" {{old('tipo_catalogo' == "" ? 'selected' : '')}}>Incidentes y Protección Civil</option>
                                    <option value="proteccion civil" {{old('tipo_catalogo' == "proteccion civil" ? 'selected' : '')}}>Protección Civil</option>
                                    <option value="incidente" {{old('tipo_catalogo' == "incidente" ? 'selected' : '')}}>Incidente</option>
                                </select>

                                @error('tipo_catalogo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                            <div class="col-md-6">
                                <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                    <option value="" {{old('estado' == "" ? 'selected' : '')}}>SEDENA</option>

                                </select>

                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="municipio" class="col-md-4 col-form-label text-md-right">{{ __('Municipio') }}</label>

                            <div class="col-md-6">
                                <select id="municipio" class="form-control @error('municipio') is-invalid @enderror" name="municipio">
                                    <option value="" {{old('municipio' == "" ? 'selected' : '')}}>SEDENA</option>

                                </select>

                                @error('municipio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        {{-- INICIANDO EL DOCUMENTO --}}
        $(document).ready(function(){
            // PETICIóN A LA API, PARA OBTENER LOS ESTADOS
            // DE LA REPUBLICA MEXICANA
            axios.get("{{ url('api/web/estados') }}").then(
                res=>{
                    // OBTENEMOS EL ARRAY DE LOS ESTADOS
                    var estados = res.data.estados;
                    // OBTENEMOS EL HTML DONDE SE ENCUENTRA
                    // EL INPUT SELECT DE ESTADOS
                    var estados_select = $("#estado");
                    // TRASLADAMOS EL VALOR OBTENIDO EN 
                    // SESION DEL ANTERIOR REGISTRO DE ESTADO
                    // Y LO CONVERTIMOS EN VARIABLE JAVASCRIPT
                    var old_estado = "{{old('estado')}}";
                    // var old_estado = "9";
                    // RECORREMOS EL ARRAY DE ESTADOS
                    estados.forEach(estado=>{
                        // CREAMOS UNA ETIQUETA HTML
                        // DE OPTION CON LOS VALORES DEL ESTADO
                        option_html = `<option value="${estado.id}">${estado.nombre}</option>`;
                        // Y LO INSERTAMOS EN HTML
                        estados_select.append(option_html);
                    });
                    // POR ULTIMO AGREGAMOS EL ATRIBUTO
                    // SELECTED A LA OPCION AGREGADA
                    // ANTERIORMENTE EN EL FORMULARIO
                    // (SI ES QUE HAY ERROR DE VALIDACIóN)
                    if (old_estado) {

                        $(`#estado option[value=${old_estado}]`).attr("selected","selected");
                        
                    }
                    getMunicipios(old_estado);
            });
        });

        $("#estado").change(function(){getMunicipios($("#estado").val())});

        function getMunicipios(estado_id) {
            var municipio_html = $("#municipio");
            // var estado_id = $("#estado").val();
            if (estado_id) {
                municipio_html.empty();
                var old_municipio = "{{old('municipio')}}";
                // var old_municipio = "277";
                municipio_html.append(`<option value="">Organo Estatal</option>`);
                axios.get(`api/web/estados/${estado_id}/municipios`).then(res=>{
                    var municipios = res.data.municipios;
                    municipios.forEach(municipio=>{
                        var option_html = `<option value="${municipio.id}">${municipio.nombre}</option>`;
                        municipio_html.append(option_html);
                    });
                    if (old_municipio) {

                        $(`#municipio option[value=${old_municipio}]`).attr("selected","selected");
                        
                    }
                });

            } else {
                municipio_html.empty();
                municipio_html.append(`<option value="">SEDENA</option>`);
            }
        }
    </script>
@endpush
