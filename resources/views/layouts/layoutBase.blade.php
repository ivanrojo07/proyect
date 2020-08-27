<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>@yield('titulo')</title>
  <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{ Auth::user() ? (Auth::user()->institucion ? asset('storage/'.Auth::user()->institucion->path_imagen_favicon) : asset('/favicon/favicon360.png') ) : asset('/favicon/favicon360.png') }}">
  <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    {{-- STYLES --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layoutBase.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/jquery-ui.1.12.1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/global-icons.css') }}">

    <style type="text/css">
        .ocultar{
          display:none;
        }
        body{
            color: white;
        }
       
        .list-group-item{
         
          border-bottom: 4px solid #40474f;
        }
        span{
          padding-left:3%;
        }

        .encabezado{
          background-color: black;
          padding-top: 2%;
          padding-bottom: 2%;
          font-size: 20px !important;
          font-family: Arial, Helvetica, sans-serif;
          border: 1px solid gray;
        }


    </style>
    @yield('estilos')

</head>
<body>
  <header>
      <div class="cabezera header1">
        <a href="{{ url('/home') }}" title="Inicio" style="background-color: white;">
            <img src="{{ Auth::user()->institucion ?  asset('storage/'.Auth::user()->institucion->path_imagen_header) : asset('images/claro.png') }}" alt="inicio">
        </a>
      </div>

      <div class="cabezera header2">

            <button id="btn-menuSeg" class="btn-menuSeg">
              Menu
            </button>

            <ul id="menuResponsivo" class="menu menuResponsivo">
              @guest
              @else
                  <li id="submenu" class="submenu"> <a href="#">Mis Servicios</a> </li>
                @endguest

              <li> <a href="#">Persona</a> </li>
              <li> <a href="#">Empresa</a> </li>
              <li> <a href="#">Corporativo</a> </li>
              <li> <a href="#">Gobierno</a> </li>
            </ul>
      </div>

      <div class="cabezera header3">
          @guest
          @else
          <div class="sesion">
            <div class="titulo nombre">
                <h5 class="usuario">Plataforma Emergencias / {{ Auth::user()->institucion ? Auth::user()->institucion->nombre : "Sin Institución" }}</h5>
            </div>


            <div class="toggle-btn">
                <button id="btn-abrir"><span class="glbl glbl-menu"></span></button>
                <button id="btn-cerrar"><span class="glbl glbl-close"></span></button>
            </div>
          </div>
          @endguest
      </div>
  </header>
  <div id="menuServicios" class="menuServicios">
    @include('claro360.modulos')
  </div>
  <address class="cerrarSesion" id="ventanaSesion">
    <div class="menuContenedor">
      <ul>
        <li>
          <a href="#" class="enlace-menu">
            Incidentes | {{ Auth::user()->full_name }}
          </a>
        </li>
      </ul>
    </div>

    <div class="textoLogin">
      <h5 class="tittleLogin">
        Contacto
      </h5>
      <img src="{{ asset('images/Claro360logo-03.png') }}">
      <p>
        Lago Zurich No. 245
        <br>
        Torre Presa Falcón, Piso 19, Plaza Carso
        <br>
        Ampliación Granada, Miguel Hidalgo,
        <br>
        Ciudad de México, México
      </p>
      <p>
        Teléfono: 5590003902 ext. 520
        <br>
        Correo: contacto@claro360.com
      </p>
    </div>
    <div class="btn-cerrar">
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            <button type="button" id="botonsesion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <strong>{{ __('Cerrar Sesión') }} </strong></button>
    </div>
  </address>

  <section>
    <nav>
      @yield('botonera')
    </nav>

    <main>
      <div class="container-fluid">
        <div aria-live="polite" aria-atomic="true" style="position:relative;; min-height: 200px;">
                  {{-- Position it --}}
                  <div style="position: absolute;top: 0;right: 0;" id="alertas">
                  </div>
                  {{-- Para seccione de vista --}}
                  @yield('contenido')
        </div>
      </div>
    </main>

    <aside>
      <div class="titulo-menu">
        @yield('titulopanel')
        <div class="toggle-menuBTN" id="menuAbrir"></div>
        <div class="toggle-menuBTN" id="menuCerrar"></div>
      </div>
      <div class="contenidoMenu MenuInactivo" id="contenido">
        @yield('panellateral')
      </div>
    </aside>
    <div class="chat">
      <div class="btn-chat" id="chat-btn">
        <span class="glbl glbl-chatpyme"></span>
        <span class="titulo-chat">CHAT</span>
      </div>
      <div class="soluciones" id="soluciones-btn">
        <a href="/chat" target="popup" onClick="javascript:window.open(this.href, this.target, 'toolbar=0 , location=1 , status=0 , menubar=1 , scrollbars=0 , resizable=1 ,left=0px,top=150px,width=400px,height=600px'); return false;">
          <span class="titulo">Centro de Soluciones 360</span>
                    <br>
                    <span class="sub-titulo">Inicie Comunicación</span>
        </a>
      </div>
    </div>

  </section>

    <footer>
        <div class="texto"><h6>© 360 HQ S.A de C.V 2019. Todos los derechos reservados.</h6></div>
        <div class="logo"><img src="{{ Auth::user()->institucion ?  asset('storage/'.Auth::user()->institucion->path_imagen_footer) : asset('images/claro2min.png') }}" class="img-fluid logofoter" alt="claro-360" ></div>
    </footer>
  {{-- Para secciones de modal --}}
      @yield('modal')

      {{-- Modal de acciones --}}
      @if (Session::has("mensaje"))
          {{-- modal confirmar guardado/editar usuario --}}
          <!-- Modal -->
          <div class="modal fade" id="actionServer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLongTitle">Acción</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                <div class="modal-body bg-secondary">
                      {{Session::get('mensaje')}}
                </div>
                  <div class="modal-footer bg-secondary">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
                  </div>
                </div>
          </div>
          </div>
      @endif

  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/controlmodal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendor/jquery-ui.1.12.1.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    <script type="text/javascript" src="{{ asset('js/jquery-validation-1.17.0/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-validation-1.17.0/messages_es.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/btns-toggle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/togglefect.js') }}"></script>

    <!--script> alert('El ancho de la resolucion de pantalla es de '+screen.width+'pixeles'+'El alto de la resolucion de pantalla es de '+screen.height+'pixeles');</script-->
    {{--
      * Configuracion de script date piker en español
      * Configuracion de la ruta de la aplicacion --}}
    <script type="text/javascript">
      
      @if (Session::has("mensaje"))
        $('#actionServer').modal("show");
      @endif

      var rutaApp = '{!! url('/') !!}' + '/';
      $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
       };
       $.datepicker.setDefaults($.datepicker.regional['es']);
    </script>

    @auth
        <script>
          @if (Auth::user()->institucion)
            {{-- expr --}}
            @switch(Auth::user()->institucion->tipo_institucion)
                @case("Federal")
                    Echo.private("incidentes_federal").listen('NewIncidente',(res)=>{
                        // console.log(res.registro);
                        var registro = res.registro;
                        crearToastIncidente(registro)
                    }).listen("NewReporteDependencia",(res)=>{
                      // console.log(res);
                      crearToastReporte(res.reporte);
                    });
                    @break
                @case("Estatal")
                    Echo.private("incidentes_estatal.{{Auth::user()->institucion_id}}").listen('NewIncidente',(res)=>{
                        // console.log(res.registro);
                        var registro = res.registro;
                        crearToastIncidente(registro)
                    }).listen("NewReporteDependencia",(res)=>{
                      // console.log(res);
                      crearToastReporte(res.reporte);
                    });
                    @break
                
                @case("Municipal")
                    Echo.private("incidentes_municipal.{{Auth::user()->institucion_id}}").listen('NewIncidente',(res)=>{
                        // console.log(res.registro);
                        var registro = res.registro;
                        crearToastIncidente(registro)
                    }).listen("NewReporteDependencia",(res)=>{
                      // console.log(res);
                      crearToastReporte(res.reporte);
                    });
                    @break

                @default
                        
            @endswitch
          @endif
            
            function crearToastIncidente(incidente) {
                var html_toast = `  <div class="toast"  data-autohide="false" id="incidente_${incidente.id}" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1;position:relative;">
                                      <div class="toast-header ${incidente.impacto.nombre === "Alto" ? 'bg-danger' : (incidente.impacto.nombre === "Medio" ? 'bg-warning' : 'bg-success')}">
                                        <strong class="mr-auto"><a class="text-white" href="{{ url('incidente') }}/${incidente.id}">Nuevo incidente con folio #${incidente.id}!</a></strong>
                                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="toast-body bg-secondary">
                                        Existe un nuevo incidente en ${incidente.municipio.nombre+", "+incidente.estado.nombre}.
                                      </div>
                                    </div>`;
                $("#alertas").append(html_toast);
                $('#incidente_'+incidente.id).toast('show');
            }
            function crearToastReporte(reporte){
              var html_toast =`<div class="toast"  data-autohide="false" id="reporte_${reporte.id}" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:1;position:relative;">
                                <div class="toast-header ${reporte.registro_incidente.impacto.nombre === "Alto" ? 'bg-danger' : (reporte.registro_incidente.impacto.nombre === "Medio" ? 'bg-warning' : 'bg-success')}">
                                  <strong class="mr-auto"><a class="text-white" href="{{ url('incidente') }}/${reporte.registro_incidente.id}">Nuevo Reporte de dependencia #${reporte.id}!</a></strong>
                                  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="toast-body bg-secondary">
                                  Existe un nuevo reporte de dependencia para el incidente #${reporte.registro_incidente.id} en ${reporte.registro_incidente.municipio.nombre+", "+reporte.registro_incidente.estado.nombre}.
                                </div>
                              </div>`;
              $("#alertas").append(html_toast);
              $('#reporte_'+reporte.id).toast('show');
            }
            
        </script>
    @endauth

    @yield('scripts')
</body>

</html>