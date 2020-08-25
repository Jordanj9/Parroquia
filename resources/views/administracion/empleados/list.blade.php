@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('administracion.index')}}">Empleados</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN - EMPLEADOS<small>Haga clic en el botón de 3 puntos de la derecha de
                            este título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('empleado.create') }}">Agregar Nuevo Empleado</a></li>
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
                                <th>IDENTIFICACIÓN</th>
                                <th>NOMBRE</th>
                                <th>PARROQUIA</th>
                                <th>CARGO</th>
                                <th>SEXO</th>
                                <th>ESTADO</th>
                                <th>DIRECCIÓN</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{$empleado->tipo_documento." - ".$empleado->identificacion}}</td>
                                    <td>{{$empleado->nombres." ".$empleado->apellidos}}</td>
                                    <td>{{$empleado->administracion->parroquia->nombre}}</td>
                                    <td>{{$empleado->cargo}}</td>
                                    <td>{{$empleado->sexo}}</td>
                                    <td>{{$empleado->estado}}</td>
                                    <td>{{$empleado->direccion}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('empleado.edit',$empleado->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar Empleado"><i class="material-icons">mode_edit</i></a>
                                        <a href="{{ route('empleado.show',$empleado->id)}}"
                                           class="btn bg-green waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver Empleado"><i class="material-icons">remove_red_eye</i></a>
                                        <a href="{{ route('empleado.delete',$empleado->id)}}"
                                           class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Eleminar Empleado"><i class="material-icons">delete</i></a>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS EMPLEADOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione la información de los empleados.
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
