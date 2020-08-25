@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.general')}}">General</a></li>
        <li class="active"><a href="{{route('talleristas.index')}}">Talleristas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        GENERAL - Talleristas<small>Haga clic en el botón de 3 puntos de la derecha de este
                            título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('talleristas.create') }}">Agregar Nuevo Tallerista</a></li>
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
                                <th>ID</th>
                                <th>NOMBRES</th>
                                <th>CELULAR</th>
                                <th>CORREO PERSONAL</th>
                                <th>TIPO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($talleristas as $tallerista)
                                <tr>
                                    <td>{{$tallerista->id}}</td>
                                    <td>{{$tallerista->nombres}}</td>
                                    <td>{{$tallerista->celular}}</td>
                                    <td>{{$tallerista->correo_personal}}</td>
                                    <td>{{$tallerista->tipo}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('talleristas.show',$tallerista->id)}}"
                                           class="btn bg-blue waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver Tallerista"><i
                                                class="material-icons">remove_red_eye</i></a>
                                        <a href="{{ route('talleristas.edit',$tallerista->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar Tallerista"><i
                                                class="material-icons">mode_edit</i></a>
                                        <a href="{{ route('talleristas.delete',$tallerista->id)}}"
                                           class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Eliminar Tallerista"><i
                                                class="material-icons">delete</i></a>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS TALLERISTAS</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione los diferentes profesionales que atienden  las intervenciones de PEBI.
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
