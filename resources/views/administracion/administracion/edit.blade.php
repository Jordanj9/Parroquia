@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('administracion.index')}}">Períodos de Administración</a></li>
        <li class="active"><a>Editar</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN - PERÍODO ADMINISTRATIVO
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
                    <h1 class="card-inside-title">EDITAR DATOS DEL
                        PERÍODO: {{$admin->fecha_inicio." - ".$admin->fecha_fin}}</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST"
                                  action="{{route('administracion.update',$admin->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Fecha Inicial</label>
                                                <input type="date" class="form-control" name="fecha_inicio"
                                                       value="{{$admin->fecha_inicio}}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Fecha Final</label>
                                                <input type="date" class="form-control" name="fecha_fin"
                                                       value="{{$admin->fecha_fin}}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Parroquia</label>
                                                <br/><select class="form-control show-tick" name="parroquia_id"
                                                             required>
                                                    @foreach($parroquias as $key=>$value)
                                                        @if($admin->parroquia_id == $key)
                                                            <option value="{{$key}}" selected>{{$value}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Estado</label>
                                                <br/><select class="form-control show-tick" name="estado" required>
                                                    @if($admin->estado == 'ACTIVO')
                                                        <option value="ACTIVO" selected>ACTIVO</option>
                                                        <option value="INACTIVO">INACTIVO</option>
                                                    @else
                                                        <option value="ACTIVO">ACTIVO</option>
                                                        <option value="INACTIVO" selected>INACTIVO</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Nombre</label>
                                                <br/><input type="text" class="form-control"
                                                                 placeholder="Escriba el nombre de la administración (Opcional)"
                                                                 name="nombre" value="{{$admin->nombre}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Descripción</label>
                                                <br/><textarea type="text" class="form-control"
                                                               placeholder="Descripción de la administración (Opcional)"
                                                               name="descripcion" maxlength="250"
                                                               rows="2">{{$admin->descripcion}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('administracion.index')}}"
                                                         class="btn bg-red waves-effect" style="margin-bottom: 10px">Cancelar</a>
                                            <button class="btn bg-indigo waves-effect" style="margin-bottom: 10px" type="reset">Limpiar Formulario
                                            </button>
                                            <button class="btn bg-green waves-effect" style="margin-bottom: 10px" type="submit">Guardar</button>
                                        </div>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS PERÍODOS ADMINISTRATIVOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Edite los datos del perído seleccionado,</strong> Gestione la información de los períodos de administracion de la parroquia
                    con el cual luego podrá gestionar las demás funcionabilidades del modulo.
                    <br/><strong>Nota: </strong>Tenga en cuenta que solo un período puede estar activo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
