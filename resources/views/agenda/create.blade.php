@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('evento.index')}}">Agenda</a></li>
        <li class="active"><a>Crear</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        AGENDA - EVENTOS
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
                    <h1 class="card-inside-title">DATOS DEL EVENTO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('evento.store')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="form-line">
                                                <label>Administración</label>
                                                <br/><select class="form-control show-tick"
                                                                  name="administracion_id" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($admins as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Miembro</label>
                                            <select class="form-control chosen-select" name="persona"
                                                    placeholder="Seleccione las pastorales donde colabora"
                                                    id="persona" required>
                                                @foreach($personas as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                <label>Nombre</label>
                                                <input type="text" class="form-control" name="nombre" placeholder="Nombre del evento" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                <label>Lugar</label>
                                                <input type="text" class="form-control" name="lugar" placeholder="Lugar del evento" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                <label>Lugar</label>
                                                <input type="datetime-local" class="form-control" name="fecha" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="form-line">
                                                <label>Pastoral</label>
                                                <br/><select class="form-control show-tick" id="pastoral_id"
                                                             name="pastoral_id" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($pastorales as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-line">
                                                <label>Descripción</label>
                                                <input type="text" class="form-control" name="descripcion" placeholder="Descripción de evento(Opcional)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('evento.index')}}"
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS EVENTOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevos eventos,</strong> Gestione la información de los diferentes eventos de las pastorales para una administración.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen();
        });
    </script>
@endsection
