@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('administracion.index')}}">Períodos de Administración</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN - PERÍODO ADMINISTRATIVO<small>Haga clic en el botón de 3 puntos de la derecha de
                            este
                            título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('administracion.create') }}">Agregar Nuevo Período de
                                        Administración</a></li>
                                <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla"
                               class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable"
                               width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>FECHA DE INICIO</th>
                                <th>FECHA FIN</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{$admin->fecha_inicio}}</td>
                                    <td>{{$admin->fecha_fin}}</td>
                                    <td>{{$admin->nombre}}</td>
                                    <td>{{$admin->descripcion}}</td>
                                    <td>{{$admin->estado}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('administracion.edit',$admin->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar Administración"><i class="material-icons">mode_edit</i></a>
                                        @if($admin->estado == 'ACTIVO')
                                            <a href="{{ route('administracion.delete',$admin->id)}}"
                                               class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                               data-placement="top" title="Cambiar de Estado"><i class="material-icons">delete</i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS PERÍODOS DE ADMINISTRACIÓN</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione la información de los períodos de administracion de la parroquia
                    con el cual luego podrá gestionar las demás funcionabilidades del modulo.
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
            $('#tabla').DataTable();
        });
    </script>
@endsection
