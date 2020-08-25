@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.intervencion')}}">Intervención</a></li>
        <li class="active"><a href="{{route('tutoria.index')}}">Tutorias</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INTERVENCIONES - TUTORIAS<small>Haga clic en el botón de 3 puntos de la derecha de este
                            título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('tutoria.create') }}">Nueva Tutoria</a></li>
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
                                <th>DOCENTE</th>
                                <th>FECHA</th>
                                <th>SOPORTE</th>
                                <th>CREADO</th>
                                <th>MODIFICADO</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tutorias as $item)
                                <tr>
                                    <td>{{$item->docente->identificacion.' - '.$item->docente->nombres}}</td>
                                    <td>{{$item->fecha}}</td>
                                    <td><a target="_blank"
                                           href="{{asset('docs/tutorias/'.$item->soporte)}}">{{$item->soporte}}</a></td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('tutoria.show',$item->id)}}"
                                           class="btn bg-green waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver Tutoria"><i
                                                class="material-icons">visibility</i></a>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LAS TUTORIAS</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione las tutorias asignadas por dia y cargue el archivo adjunto del formato de asistencia.
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
