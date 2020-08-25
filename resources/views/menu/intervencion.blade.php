@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.intervencion')}}">Intervenciones</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INTERVENCIONES<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert alert-dismissible" role="alert" style="background-color: rgb(23, 128, 62)">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestione las solicitudes de intervenciones individuales,
                        intervenciones grupales, asignación de citas, entre otras tareas.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_INTERVENCION-INDIVIDUAL-ADMIN'))
                            <a href="{{route('individualadmin.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">folder_shared</i></span>
                                    <span>INTERVENCIÓN INDIVIDUAL</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_INTERVENCION-TUTORIAS'))
                            <a href="{{route('tutoria.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">folder_shared</i></span>
                                    <span>TUTORIAS</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
