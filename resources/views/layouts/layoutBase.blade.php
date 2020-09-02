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
      svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.3333333333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2.5em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1.25em}.svg-inline--fa.fa-stack-2x{height:2em;width:2.5em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.svg-inline--fa .fa-primary{fill:var(--fa-primary-color,currentColor);opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa .fa-secondary{fill:var(--fa-secondary-color,currentColor);opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-primary{opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-secondary{opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa mask .fa-primary,.svg-inline--fa mask .fa-secondary{fill:#000}.fad.fa-inverse{color:#fff}

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
        <a href="https://claro360.ml/plataforma360/" title="Inicio" style="text-align: right;">
            <img  src="{{ asset('images/Claro360_Logo_Header_negro.png') }}" alt="inicio">
        </a>
      </div>

      <div class="cabezera header2">
          
      </div>


      <div class="cabezera header3">
          @guest
          @else
          <div class="titulo">
            <h5 class="tituloPrincipal text-dark">Plataforma Emergencias</h5>
            <h6 class="tituloSecundario text-dark">{{ Auth::user()->institucion ? Auth::user()->institucion->nombre : "Sin Institución" }}</h6>
            </div>
          </div>
          @endguest
      </div>

      <div class="cabezera header4" style="background-color: #da291c;color: white;">
        <div class="titulo nombre">
            <h5 class="usuario">{{Auth::user()->full_name}}</h5>
        </div>
        

        <div class="toggle-btn">
            <button id="btn-abrir"><span class="glbl glbl-menu"></span></button>
            <button id="btn-cerrar"><span class="glbl glbl-close"></span></button>
        </div>
      </div>
  </header>
  <address class="cerrarSesion" id="ventanaSesion">
    <div class="titulo text-center">
        <h5 class="titulo-seg" style="font-family: DINPro-Bold !important;">360 Segmento</h5>
    </div>

     <div class="perfil">
      <div class="foto">
          <div class="foto-perfil d-flex justify-content-center align-content-center" id="img_perfil_user"><svg class="svg-inline--fa fa-user-circle fa-w-16" style="font-size: 7rem;margin-top: 20px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path></svg><!-- <i class="fas fa-user-circle" style="font-size: 7rem;margin-top: 20px"></i> --></div>
      </div>

            <div class="datos">
                <div class="info">
                    <h6 class="nombre">{{
                      Auth::user()->full_name
                    }}</h6>

                    <p class="correo">{{Auth::user()->email}}</p>
                </div>
            </div>

            <div class="btn-perfil">
                <a class="boton-perfil" href="https://claro360.ml/plataforma360/perfil/API/cuenta360/access_token/{{Session::get('claro360.id')}}/{{Session::get('claro360.token')}}">Mi Perfil 360</a>
            </div>
        </div>

        <div class="navegacion text-center">
            <nav>
                <ul class="menu-sesion">
                    <li class="servicios" data-toggle="collapse" href="#collapseServicios" role="button" aria-expanded="false" aria-controls="collapseExample">MIS SERVICIOS</li>
                    <ul class="menu-servicios collapse" id="collapseServicios">
                      @include('claro360.modulos')
                    </ul>
                    <li class="segmentos" data-toggle="collapse" href="#collapseSegmentos" role="button" aria-expanded="false" aria-controls="collapseExample">360</li>
                    <ul class="menu-segmentos collapse" id="collapseSegmentos">
                        <li> <a href="#">Persona</a> </li>
                        <li> <a href="#">Empresa</a> </li>
                        <li> <a href="#">Corporativo</a> </li>
                        <li> <a href="#">Gobierno</a> </li>
                    </ul>
                    <li> <a href="https://store360.ml/app">Store 360</a> </li>
                    <li> <a href="#">Ayuda</a> </li>
                </ul>
            </nav>
        </div>

        <div class="btn-sesion">

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            <a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="boton-sesion">Cerrar Sesión</a>
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