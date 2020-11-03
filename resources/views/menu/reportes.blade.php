@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.reportes')}}">Reportes</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REPORTES<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert alert-dismissible" role="alert" style="background-color: rgb(23, 128, 62)">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestione los diferentes reportes del sistema.
                    </div>
                    <div class="button-demo">
                        <a href="{{route('reportes.viewmiembroget')}}" class="btn bg-indigo btn-lg waves-effect">
                            <div>
                                <span><i class="material-icons">folder_shared</i></span>
                                <span>BUSCAR MIEMBRO</span>
                                <span class="ink animate"></span></div>
                        </a>
                        <a href="{{route('reportes.ViewMiembroPastoral')}}" class="btn bg-indigo btn-lg waves-effect">
                            <div>
                                <span><i class="material-icons">folder_shared</i></span>
                                <span>MIEMBROS POR PASTORAL</span>
                                <span class="ink animate"></span></div>
                        </a>
                        <a href="{{route('reportes.viewmiembrocomunidad')}}" class="btn bg-indigo btn-lg waves-effect">
                            <div>
                                <span><i class="material-icons">folder_shared</i></span>
                                <span>MIEMBROS POR COMUNIDAD</span>
                                <span class="ink animate"></span></div>
                        </a>
                        <a href="{{route('reportes.viewmiembroocupacion')}}" class="btn bg-indigo btn-lg waves-effect">
                            <div>
                                <span><i class="material-icons">folder_shared</i></span>
                                <span>MIEMBROS POR OCUPACIÓN</span>
                                <span class="ink animate"></span></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
