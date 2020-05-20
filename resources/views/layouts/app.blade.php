<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Incidentes') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom border-danger p-2">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @guest
                        {{ config('app.name', 'Incidentes') }}
                    @else
                        <img src="{{ Auth::user()->institucion ?  asset('storage/'.Auth::user()->institucion->path_imagen_header) : asset('images/claro.png') }}" height="40">
                    @endguest
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="pb-5 py-4">
            <div aria-live="polite" aria-atomic="true" style="position:relative;; min-height: 200px;">
                {{-- Position it --}}
                <div style="position: absolute;top: 0;right: 0;" id="alertas">
                </div>
                @yield('content')
            </div>

        </main>
        <footer class="bg-dark text-white fixed-bottom">
            <div class="container d-flex justify-content-between text-center">
                <div class="col-md-3 d-none d-lg-block">
                    @guest
                        <span>{{ config('app.name', 'Incidentes') }}</span>
                    @else
                        <img src="{{ Auth::user()->institucion ?  (asset('storage/'.Auth::user()->institucion->path_imagen_footer) ? asset('storage/'.Auth::user()->institucion->path_imagen_footer) : "") : asset('images/claro.png') }}" height="50">
                    @endguest
                </div>
                <div class="col-12 col-lg-6">
                    <span>Incidentes fue creado por Global Human Services.
                        <br>Copyright © 2017-2020 Global Human Services.</span>
                </div>
                <div class="col-md-3 align-self-center d-none d-lg-block">
                    <span>{{Date('Y-m-d')}}</span>
                </div>
            </div>
        </footer>
    </div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
@auth
    <script>
        @switch(Auth::user()->institucion->tipo_institucion)
            @case("Federal")
                Echo.private("incidentes_federal").listen('NewIncidente',(res)=>{
                    console.log(res.registro);
                    var registro = res.registro;
                    crearToast(registro)
                }); 
                @break
            @case("Estatal")
                Echo.private("incidentes_estatal.{{Auth::user()->institucion_id}}").listen('NewIncidente',(res)=>{
                    console.log(res.registro);
                    var registro = res.registro;
                    crearToast(registro)
                }); 
                @break
            
            @case("Municipal")
                Echo.private("incidentes_municipal.{{Auth::user()->institucion_id}}").listen('NewIncidente',(res)=>{
                    console.log(res.registro);
                    var registro = res.registro;
                    crearToast(registro)
                }); 
                @break

            @default
                    
        @endswitch
        
        function crearToast(incidente) {
            var html_toast = `  <div class="toast"  data-autohide="false" id="incidente_${incidente.id}" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1;position:relative;">
                                  <div class="toast-header ${incidente.impacto.nombre === "Alto" ? 'bg-danger' : (incidente.impacto.nombre === "Medio" ? 'bg-warning' : 'bg-success')}">
                                    <strong class="mr-auto"><a href="{{ url('incidente') }}/${incidente.id}">Nuevo incidente con folio #${incidente.id}!</a></strong>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="toast-body">
                                    Existe un nuevo incidente en ${incidente.municipio.nombre+", "+incidente.estado.nombre}.
                                  </div>
                                </div>`;
            $("#alertas").append(html_toast);
            $('#incidente_'+incidente.id).toast('show');
        }
        
    </script>
@endauth

</html>
