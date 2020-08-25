@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.general')}}">General</a></li>
        <li class="active"><a href="{{route('sacramentos.index')}}">Sacramentos</a></li>
        <li class="active"><a>Crear Sacramento</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        GENERAL - SACRAMENTOS
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DEL SACRAMENTO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('sacramentos.store')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <br/><input type="text" class="form-control"
                                                        placeholder="Escriba el nombre del sacramento" name="nombre"
                                                        required="required"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <br/><textarea type="text" class="form-control"
                                                      placeholder="Descripción del sacramento (Opcional)"
                                                      name="descripcion" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('sacramentos.index')}}"
                                                     class="btn bg-red waves-effect">Cancelar</a>
                                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario
                                        </button>
                                        <button class="btn bg-green waves-effect" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS SACRAMENTOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevos sacramentos,</strong> Gestione la información de los diferentes
                    sacramentos de la iglesia.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
