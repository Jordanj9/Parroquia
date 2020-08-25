@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.academico')}}">Academico</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ACADÉMICO<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert bg-teal alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestión de toda la información académica.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_ACADEMICO-PERIODO-ACADEMICO'))
                            <a href="{{route('periodosacademicos.index')}}" class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>PERÍODO ACADÉMICO</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="body">
                    <div class="alert bg-red alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Reportes de toda la información académica.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_CARGA-ACADEMICA'))
                            <a href="{{route('periodosacademicos.index')}}" class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>CARGA ACADÉMICA</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_NIVELES-DE-RIESGO'))
                            <a href="{{route('reportes.niveles')}}" class="btn btn-primary btn-lg bg-teal waves-effect">
                                <div>
                                    <span><i class="material-icons">view_module</i></span>
                                    <span>NIVELES DE RIESGO</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
