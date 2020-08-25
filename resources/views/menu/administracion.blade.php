@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.administracion')}}">Administración</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert alert-dismissible" role="alert" style="background-color: rgb(23, 128, 62)">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestione la administración, empleados, consejo pastoral, consejo económico y censo de la parroquia por año.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_ADMINISTRACION-ADMINISTRACION'))
                            <a href="{{route('administracion.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">folder_shared</i></span>
                                    <span>PERÍODOS DE ADMINISTRACIÓN</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_ADMINISTRACION-EMPLEADO'))
                            <a href="{{route('empleado.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">folder_shared</i></span>
                                    <span>EMPLEADOS</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                            @if(session()->exists('PAG_ADMINISTRACION-CONSEJO-PASTORAL'))
                                <a href="{{route('tutoria.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                    <div>
                                        <span><i class="material-icons">folder_shared</i></span>
                                        <span>CONSEJO PASTORAL</span>
                                        <span class="ink animate"></span></div>
                                </a>
                            @endif
                            @if(session()->exists('PAG_ADMINISTRACION-CONSEJO-ECONOMICO'))
                                <a href="{{route('tutoria.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                    <div>
                                        <span><i class="material-icons">folder_shared</i></span>
                                        <span>CONSEJO ECONÓMICO</span>
                                        <span class="ink animate"></span></div>
                                </a>
                            @endif
                            @if(session()->exists('PAG_ADMINISTRACION-CENSO-PARROQUIAL'))
                                <a href="{{route('tutoria.index')}}" class="btn bg-indigo btn-lg waves-effect">
                                    <div>
                                        <span><i class="material-icons">folder_shared</i></span>
                                        <span>CENSO PARROQUIAL</span>
                                        <span class="ink animate"></span></div>
                                </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
