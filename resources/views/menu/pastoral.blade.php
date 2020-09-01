@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert bg-teal alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestión de toda la información sobre las pastorales.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_PASTORAL-PASTORALES'))
                            <a href="{{route('pastorales.index')}}"
                               class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>PASTORALES</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                            @if(session()->exists('PAG_PASTORAL-SUBPASTORALES'))
                                <a href="{{route('subpastoral.index')}}"
                                   class="btn btn-primary btn-lg bg-teal waves-effect">
                                    <div>
                                        <span><i class="material-icons">view_module</i></span>
                                        <span>SUBPASTORALES</span>
                                        <span class="ink animate"></span></div>
                                </a>
                            @endif
                        @if(session()->exists('PAG_PASTORAL-COMUNIDAD'))
                            <a href="{{route('comunidad.index')}}"
                               class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>COMUNIDADES</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_PASTORAL-MIEMBROS'))
                            <a href="{{route('miembro.index')}}" class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>MIEMBROS</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_PASTORAL-PLAN'))
                            <a href="{{route('reportes.niveles')}}" class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>PLAN PASTORAL</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
