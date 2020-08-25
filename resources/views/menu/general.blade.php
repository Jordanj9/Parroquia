@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a href="{{route('admin.general')}}">General</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        GENERAL<small>MENÚ</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="alert bg-teal alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Detalles: </strong> Gestione los programas de apoyo, los tipos de interveción grupal,
                        entre otras tareas.
                    </div>
                    <div class="button-demo">
                        @if(session()->exists('PAG_GENERAL-PARROQUIA'))
                            <a href="{{route('parroquia.index')}}" class="btn bg-deep-orange btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">view_headline</i></span>
                                    <span>PARROQUIA</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_GENERAL-ESTADO-CIVIL'))
                            <a href="{{route('estadocivil.index')}}" class="btn bg-deep-orange btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">view_headline</i></span>
                                    <span>ESTADO CIVIL</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_GENERAL-SITUACION'))
                            <a href="{{route('situacionespiritual.index')}}" class="btn bg-deep-orange btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">view_headline</i></span>
                                    <span>SITUACIÓN ESPIRITUAL</span>
                                    <span class="ink animate"></span>
                                </div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_GENERAL-SACRAMENTOS'))
                            <a href="{{route('sacramentos.index')}}" class="btn bg-deep-orange btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">view_headline</i></span>
                                    <span>SACRAMENTOS</span>
                                    <span class="ink animate"></span>
                                </div>
                            </a>
                        @endif
                        @if(session()->exists('PAG_GENERAL-OCUPACION'))
                            <a href="{{route('ocupacion.index')}}" class="btn bg-deep-orange btn-lg waves-effect">
                                <div>
                                    <span><i class="material-icons">view_headline</i></span>
                                    <span>OCUPACIONES</span>
                                    <span class="ink animate"></span>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
