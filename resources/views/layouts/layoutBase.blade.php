<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>@yield('titulo')</title>
  <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shorcut ico" type="image/x-icon" href="/favicon.ico">
  <link rel="stylesheet" type="text/css" href="{{ Auth::user() ? (Auth::user()->institucion ? asset('storage/'.Auth::user()->institucion->path_imagen_favicon) : asset('/favicon/favicon360.png') ) : asset('/favicon/favicon360.png') }}">
  <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    {{-- STYLES --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layoutBase.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/headerb.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/jquery-ui.1.12.1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    {{-- 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}"> --}}

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
  <header class="segmento corporativo">
      <div class="cabezera header1">
          <a href="https://claro360.ml/plataforma360/home" style="text-align: right; background-image: url('https://empresas360.ml/p360_v3.04/Img/Logos/Claro%20360.png'); height: 100%; width: 100%; background-size: contain; background-position: center center; background-repeat: no-repeat; display: block;"></a>
      </div>
      <div class="cabezera header2">
          <ul id="menuResponsivo" class="menu menuResponsivo">
              <li class="segmentosV" id="inicio"><a href="https://claro360.ml/plataforma360">360</a></li>
              <li class="segmentos" id="persona"><a href="https://claro360.ml/plataforma360/persona">Persona</a></li>
              <li class="segmentos" id="empresa"><a href="https://claro360.ml/plataforma360/empresa">Empresa</a></li>
              <li class="segmentos" id="corporativo"><a href="https://claro360.ml/plataforma360/corporativo">Corporativo</a></li>
              <li class="segmentos" id="gobierno"><a href="https://claro360.ml/plataforma360/gobierno">Gobierno</a></li>
              <li class="segmentosV" id="store"><a target="_blank" href="https://store360.ml/app">Store 360</a></li>
          </ul>
      </div>
      <div class="col h-100 header3 unlogged">
          <div class="containerHeader4">
              <span class="fas fa-th iconServicios" id="iconServ"></span>
              <span id="NombreDependencia" align="right"></span>
              <span id="user" style="color: white;">{{Auth::user()->full_name}}</span>
              <span id="t4" style="display: none;"></span>
              <button id="btn-abrir" style="background-color: #282828;border:none;"><span class="glbl glbl-menu" style="background-color: #282828; margin:0px;border: 6px solid #282828;font-size: 30px;font-weight: bold;"></span></button>
              <button id="btn-cerrar" style="background-color: #282828;border:none;"><span class="glbl glbl-close"
                  style="background-color: #282828; margin:0px;border: 6px solid #282828;font-size: 30px;font-weight: bold;"></span></button>

          </div>
      </div>
      {{--<div class="cabezera header3">
          <!-- <a class="btn btn-danger btn-registrate" href="/registro">Regístrate</a>
          <a class="btn btn-danger btn-ingresa" href="/logeo">Ingresa</a> -->
          <div class="sesion">
              <div class="mosaico-btn">
                  <span class="fas fa-th iconServicios" id="iconServ"></span>
                  <!--button id="btn-mosaico"><span class="glbl glbl-mosaico"></span></button-->
              </div>
              <div class="titulo nombre">
                  <h5 class="usuario">Hola, user</h5>
              </div>
              <div class="toggle-btn">
                  <button id="btn-abrir"><span class="glbl glbl-menu"></span></button>
                  <button id="btn-cerrar"><span class="glbl glbl-close"></span></button>
              </div>
          </div>
      </div>--}}
  </header>

  <div id="menuServicios" class="menuServicios segmento">
      <ul id="servicios" class="servicios d-none">
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/Hogar_Conectado-Persona_40X40.png"></div>
                  <label for="">EJEMPLO DE SERVICIOS</label>
              </a>
          </li>
      </ul>{{-- 
      <ul id="ulpersona" class="servicios d-none">
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/Hogar_Conectado-Persona_40X40.png"></div>
                  <label for="">Hogar Conectado</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/Administracion-Persona_40X40.png"></div>
                  <label for="">Administración</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/Salud360-Persona_40X40.png"></div>
                  <label for="">Salud 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/SOS_CIudadano-Persona_40X40.png"></div>
                  <label for="">SOS Ciudadano</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/persona/40/Expertos360-Persona_40X40.png"></div>
                  <label for="">Expertos 360</label>
              </a>
          </li>
      </ul>
      <ul id="ulempresa" class="servicios d-none">
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/empresa/40/Empresa360-Empresa_40X40.png"></div>
                  <label for="">Empresa 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/empresa/40/Administracion-Empresa_40X40.png"></div>
                  <label for="">Administración</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/empresa/40/Expertos360-Empresa_40X40.png"></div>
                  <label for="">Expertos 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/empresa/40/SOS_CIudadano-Empresa_40X40.png"></div>
                  <label for="">SOS Ciudadano</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/empresa/40/Videovigilancia-Empresa_40X40.png"></div>
                  <label for="">Videovigilancia</label>
              </a>
          </li>
      </ul>
      <ul id="ulcorporativo" class="servicios d-none">
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/corporativo/40/Empresa360-Corporativo_40X40.png"></div>
                  <label for="">Empresa 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/corporativo/40/Administracion-Corporativo_40X40.png"></div>
                  <label for="">Administracion</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/corporativo/40/Expertos360-Corporativo_40X40.png"></div>
                  <label for="">Expertos 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div class="text-center"><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/corporativo/40/SOS_CIudadano-Corporativo_40X40.png"></div>
                  <label for="">SOS Ciudadano</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/corporativo/40/Videovigilancia-Corporativo_40X40.png"></div>
                  <label for="">Videovigilancia</label>
              </a>
          </li>
      </ul>
      <ul id="ulgobierno" class="servicios d-none">
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/gobierno/40/Videovigilancia-Gobierno_40X40.png"></div>
                  <label for="">Videovigilancia</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/gobierno/40/Analitico_de_Video-Gobierno_40X40.png"></div>
                  <label for="">Analítico de Video</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/gobierno/40/Consulta_Visualizacion-Datos-Gobierno_40X40.png"></div>
                  <label for="">Consulta y Visualización de Datos</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/gobierno/40/Expertos360-Gobierno_40X40.png"></div>
                  <label for="">Expertos 360</label>
              </a>
          </li>
          <li>
              <a href="#">
                  <div><img src="https://claro360.ml/plataforma360/resources/local_v3/images/iconosHeader/gobierno/40/Monitoreo_Unidades-Gobierno_40X40.png"></div>
                  <label for="">Monitoreo de Unidades y Elementos</label>
              </a>
          </li>
      </ul> --}}
  </div>  
  <address class="cerrarSesion" id="ventanaSesion">
      <div class="tituloS">
          <h5 class="titulo-seg">360 Corporativo</h5>
      </div>
      <div class="contSesion">
          <div class="perfil">
              <div class="foto">
                  <i class="fas fa-user-circle" style="font-size: 7rem;margin-top: 5px"></i>
              </div>
              <div class="datos">
                  <div class="info">
                      <h6 class="nombre">{{
                      Auth::user()->full_name
                    }}</h6>
                      <p class="correo">{{Auth::user()->email}}</p>
                      <p class="ubicacion">Miguel Hidalgo, CDMX</p>
                  </div>
                  <div class="semaforo">
                      <div class="col-12 contenido-semaforo">Semaforo</div>
                      <div class="colorS" style="background-color: #e26800;border: 1px solid #e26800;"></div>
                  </div>
              </div>
              <div class="btn-perfil">
                  <a class="boton-perfil" href="https://claro360.ml/plataforma360/perfil/API/cuenta360/access_token/{{Session::get('claro360.id')}}/{{Session::get('claro360.token')}}">Mi Perfil 360</a>
              </div>
          </div>
          <div class="navegacion">
              <nav>
                  <ul class="menu-sesion">
                      <li class="" data-toggle="collapse" href="#collapseServicios" role="button" aria-expanded="false" aria-controls="collapseServicios" id="pcollapseServicios">MIS SERVICIOS</li>
                          <ul class="menu-servicios collapse" id="collapseServicios">
                              @include('claro360.modulos')
                          </ul>
                      <li class="" id="pcollapseSegmentos" data-toggle="collapse" href="#collapseSegmentos" role="button" aria-expanded="false" aria-controls="collapseSegmentos">360</li>
                          <ul class="menu-segmentos collapse" id="collapseSegmentos">
                              <li><a href="#">Persona</a></li>
                              <li><a href="#">Empresa</a></li>
                              <li><a href="#">Corporativo</a></li>
                              <li><a href="#">Gobierno</a></li>
                          </ul>
                      <li><a href="https://store360.ml/app">Store 360</a></li>
                  </ul>
              </nav>
          </div>
      </div>
      <div class="btn-sesion text-center">
          <!--form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form-->
          <button type="button" id="botonsesion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <strong>{{ __('Cerrar Sesión') }} </strong></button>
      </div>
  </address>
  
  {{-- <address class="cerrarSesion" id="ventanaSesion">
    <div class="tituloS">
        <h5 class="titulo-seg">360 Corporativo</h5>
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
  </address> --}}

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
    {{-- <div class="chat">
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
    </div> --}}

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
        <script>
    $('.segmentos').mouseover(function() {
        $('.servicios').addClass('d-none');
        $('.segmentos').removeClass('activo');
        $('#'+this.id).addClass('activo');
        document.getElementById("menuServicios").style.height="auto";
        document.getElementById("menuServicios").style.display="block";
        document.getElementById("ul"+this.id).classList.remove('d-none');
        setTimeout(function(){
            $('.servicios').addClass('d-none');
            $('.segmentos').removeClass('activo');
            document.getElementById("menuServicios").style.height="0px";
            document.getElementById("menuServicios").style.display="none";
        }, 10000);        
    });
    $('.segmentosV').mouseover(function() {
        $('.segmentos').removeClass('activo');
        document.getElementById("menuServicios").style.height="0px";
        document.getElementById("menuServicios").style.display="none";
    });
    $('.menuServicios').click(function() {
        $( '.servicios' ).addClass('d-none');
        $('.segmentos').removeClass('activo');
        document.getElementById("menuServicios").style.height="0px";
        document.getElementById("menuServicios").style.display="none";
    }); 
    $(document).ready(function(){
        $('#iconServ').click(function() {
            $('.servicios').addClass('d-none');
            $('.segmentos').removeClass('activo');
            //$('#'+this.id).addClass('activo');
            document.getElementById("menuServicios").style.height="auto";
            document.getElementById("menuServicios").style.display="block";
            document.getElementById("servicios").classList.remove('d-none');
            /*setTimeout(function(){
                $('.servicios').addClass('d-none');
                $('.segmentos').removeClass('activo');
                document.getElementById("menuServicios").style.height="0px";
                document.getElementById("menuServicios").style.display="none";
            }, 10000);*/
            
            //alert("CLICK ICONO SERVICIOS");
        });        
    });
</script>
    @endauth

    @yield('scripts')
</body>

</html>