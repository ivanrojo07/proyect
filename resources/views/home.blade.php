@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex">
    <div class="w-25 p-3 bg-dark text-white mr-3">
        <div class="card bg-secondary text-center mt-3 ">
            <div class="card-header">
                <h4>{{Auth::user()->institucion ? Auth::user()->institucion->nombre : "CLARO 360"}}</h4>
            </div>
            <div class="card-body">
                <form id="changeFecha" class="row" method="GET" action="{{ route('incidente.index') }}" >
                    <input class="form-control" type="date" name="fecha" id="fecha" value="{{Date('Y-m-d')}}" max="{{Date('Y-m-d')}}">
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.institucion.index') }}" class="btn btn-block btn-info">Instituciones</a>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-block btn-info">Usuarios</a>
                <a href="{{ route('incidente.index') }}" class="btn btn-block btn-info">Incidentes</a>
                <a href="{{ route('covid.index') }}" class="btn btn-block btn-info">Covid-19</a>
            </div>
        </div>
    </div>
    <div class="w-75">
        <div class="card">
            <div class="card-header">Bienvenido</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                Incidentes 
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