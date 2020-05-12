@extends('layouts.app')

@section('content')
<div class="container-fluid d-md-flex d-block">
    <div class="col-12 col-md-3 text-white">
        <div class="card bg-secondary text-center mt-3">
            <div class="card-header navbar-dark d-flex justify-content-between bg-dark">
                <h4 class="align-self-center">{{Auth::user()->institucion ? Auth::user()->institucion->nombre : "CLARO 360"}}</h4>
                <button class="btn d-md-none" type="button" data-toggle="collapse" data-target="#home-menu">
                    <span class="navbar-light"><span class="navbar-toggler-icon"></span></span>
                </button>
            </div>
            <div id="home-menu" class="collapse d-md-block">
                <div class="card-body">
                    <form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
                        <input class="form-control" type="date" name="fecha" id="fecha" value="{{Date('Y-m-d')}}" max="{{Date('Y-m-d')}}">
                    </form>
                </div>
                <div class="card-footer bg-dark">
                    <a href="{{ route('admin.institucion.index') }}" class="btn btn-block btn-info">Instituciones</a>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-block btn-info">Usuarios</a>
                    <a href="{{ route('incidente.index') }}" class="btn btn-block btn-info">Incidentes</a>
                    <a href="{{ route('covid.index') }}" class="btn btn-block btn-info">Covid-19</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9 mt-3">
        <div class="card">
            <div class="card-header ">
                Bienvenido
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <p>{{Auth::user()->full_name}}</p>
                <p>{{Auth::user()->institucion->nombre}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#fecha").change(function(){
            $("#changeFecha").submit();
        })
    </script>
@endpush