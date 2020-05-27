<!DOCTYPE html>
<html>
<head>
    {{-- aqui va los estilos si se usan para diferentes vistas --}}
    {{--      introducirlos en una etiqueta push o prepend      --}}
    @stack('css')
    <style type="text/css">
        body {
          font-family: 'Oswald', sans-serif !important;
        }
        {{-- separar hojas --}}
        .page-break {
            page-break-inside: avoid;
        }
        div.page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }
        .Bajo{
            border-left: 5px solid green !important;
            padding: 1px 38px !important;
        }
        .Medio{
            border-left: solid 5px #ffc300 !important;
            padding: 1px 38px !important;
        }
        .Alto{
            border-left: solid 5px #b3282d !important;
            padding: 1px 38px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap4.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema De Monitoreo y Control</title>
</head>
<body>
@yield('header')
    <nav class="navbar navbar-light bg-withe justify-content-between">
        <h3 class="align-self-center">
            Sistema De Monitoreo y Control
        </h3>
        <img src="{{ $institucion ? asset('storage/'.$institucion->path_imagen_header) : asset('images/claro.png') }}" alt="" height="50px" width="250px">
    </nav>
    <div style="top: 0px;bottom: 0px !important;">
        @yield('content')
    </div>
</body>
</html>