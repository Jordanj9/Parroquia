@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('empleado.index')}}">Empleados</a></li>
        <li class="active"><a>Ver Empleado</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN - EMPLEADOS
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DEL EMPLEADO SELECCIONADO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table id="tabla" class="table table-hover">
                                <tbody>
                                <tr class="read">
                                    <td class="contact"><b>Identificaión</b></td>
                                    <td class="subject">{{$empleado->tipo_documento." - ".$empleado->identificacion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Nombre</b></td>
                                    <td class="subject">{{$empleado->nombres." ".$empleado->apellidos}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Sexo</b></td>
                                    <td class="subject">{{$empleado->sexo}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>E-mail</b></td>
                                    <td class="subject">{{$empleado->correo}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Celular</b></td>
                                    <td class="subject">{{$empleado->celular}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Telefono</b></td>
                                    <td class="subject">{{$empleado->telefono}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Dirección</b></td>
                                    <td class="subject">{{$empleado->direccion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Barrio</b></td>
                                    <td class="subject">{{$empleado->barrio}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Estado</b></td>
                                    <td class="subject">
                                        @if($empleado->estado == 'ACTIVO')
                                            <label class="label label-success">ACTIVO</label>
                                        @else
                                            <label class="label label-danger">INACTIVO</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Administración</b></td>
                                    <td class="subject">{{$empleado->administracion->fecha_inicio." - ".$empleado->administracion->fecha_fin." - ESTADO: ".$empleado->administracion->estado}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Creado</b></td>
                                    <td class="subject">{{$empleado->created_at}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Modificado</b></td>
                                    <td class="subject">{{$empleado->updated_at}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
