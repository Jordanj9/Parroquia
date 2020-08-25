@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('admin.academico')}}">Academico</a></li>
    <li class="active"><a href="{{route('periodosacademicos.index')}}">Periodos Académicos</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    PERIODOS ACADÉMICOS - LISTADO DE TODOS LOS PERIODOS ACADÉMICOS EN EL SISTEMA
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('periodosacademicos.create') }}">Agregar Nuevo Periodo Académico</a></li>
                            <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                 <th>ID</th>
                                 <th>DESCRIPCIÓN</th>
                                 <th>ESTADO</th>
                                 <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodos as $periodo)
                            <tr>
                                <td>{{$periodo->id}}</td>
                                <td>{{$periodo->anio}} - {{$periodo->periodo}}</td>
                                <td>@if($periodo->estado=='ACTIVO')<label class="label label-success">ACTIVO</label>@else<label class="label label-danger">INACTIVO</label>@endif</td>
                                <td>
                                    <a href="{{route('periodosacademicos.edit',$periodo->id)}}" class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Grupo de Usuario"><i class="material-icons">mode_edit</i></a>
                                    <a href="{{route('periodosacademicos.show',$periodo->id)}}" class="btn bg-green waves-effect btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Datos del Grupo de Usuario"><i class="material-icons">remove_red_eye</i></a>
                                    <a href="{{route('periodosacademicos.delete',$periodo->id)}}" class="btn bg-red waves-effect btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Grupo de Usuario"><i class="material-icons">delete</i></a>
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        //$('#tabla').DataTable();
    });
</script>
@endsection
