@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li><a href="{{route('miembro.index')}}">Miembros</a></li>
        <li class="active"><a>Ver Miembro</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL - MIEMBROS
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DEL MIEMBRO SELECCIONADO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table id="tabla" class="table table-hover">
                                <tbody>
                                <tr class="read">
                                    <td class="contact btn-success" colspan="2" style="border-radius: 10px;">
                                        <center><b>Datos Personales</b></center>
                                    </td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Identificación</b></td>
                                    <td class="subject">{{$miembro->tipo_documento."-".$miembro->identificacion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Nombre</b></td>
                                    <td class="subject">{{$miembro->nombres." ".$miembro->apellidos}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Sexo</b></td>
                                    <td class="subject">{{$miembro->sexo}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Fecha de Nacimiento</b></td>
                                    <td class="subject">{{$miembro->fechanacimiento}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Dirección</b></td>
                                    <td class="subject">{{$miembro->direccion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Barrio</b></td>
                                    <td class="subject">{{$miembro->barrio}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Telefono</b></td>
                                    <td class="subject">{{$miembro->telefono}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Celular</b></td>
                                    <td class="subject">{{$miembro->celular}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Correo</b></td>
                                    <td class="subject">{{$miembro->correo}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Trabaja</b></td>
                                    <td class="subject">{{$miembro->trabaja}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Empresa</b></td>
                                    <td class="subject">{{$miembro->empresa}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Ocupación</b></td>
                                    <td class="subject">{{$miembro->ocupacion->nombre}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Estado Civl</b></td>
                                    <td class="subject">{{$miembro->estadocivil->nombre}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Creado</b></td>
                                    <td class="subject">{{$miembro->created_at}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Modificado</b></td>
                                    <td class="subject">{{$miembro->updated_at}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact btn-success" colspan="2" style="border-radius: 10px;">
                                        <center><b>Información Religiosa</b></center>
                                    </td>
                                </tr>
                                @if($comunidades != null)
                                    <tr class="read">
                                        <td class="contact">
                                            <center><b>Comunidades a las que ha pertenecido</b></center>
                                        </td>
                                    </tr>
                                    @foreach($comunidades as $item)
                                        <tr class="read">
                                            <td class="contact"><b>Comunidad</b></td>
                                            <td class="subject">$item</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(count($miembro->miembropastorals) > 0)
                                    <tr class="read">
                                        <td class="contact">
                                            <center><b>Realidades en las que colabora</b></center>
                                        </td>
                                    </tr>
                                    @foreach($miembro->miembropastorals as $item)
                                        <tr class="read">
                                            <td class="contact"><b>Pastoral</b></td>
                                            <td class="subject">{{$item->pastoral->nombre}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(count($miembro->miembrocomunidads) > 0)
                                    <tr class="read">
                                        <td class="contact">
                                            <center><b>Comunidades a las que pertenece</b></center>
                                        </td>
                                    </tr>
                                    @foreach($miembro->miembrocomunidads as $item)
                                        <tr class="read">
                                            <td class="contact"><b>Comunidad</b></td>
                                            <td class="subject">
                                                N°.{{$item->comunidad->numero}}</td>
                                        </tr>
                                        <tr class="read">
                                            <td class="contact"><b>Día y Hora de Reunión</b></td>
                                            <td class="subject">
                                                {{$item->comunidad->dia." - ".$item->comunidad->hora}}</td>
                                        </tr>
                                        <tr class="read">
                                            <td class="contact"><b>Lugar de Reunión</b></td>
                                            <td class="subject">{{$item->comunidad->sala}}</td>
                                        </tr>
                                        @if($item->pastoral_id != null)
                                            <tr class="read">
                                                <td class="contact"><b>Pastoral</b></td>
                                                <td class="subject">{{$item->pastoral->nombre}}</td>
                                            </tr>
                                        @endif
                                        @if($item->subpastoral_id != null)
                                            <tr class="read">
                                                <td class="contact"><b>Subpastoral</b></td>
                                                <td class="subject">{{$item->subpastoral->nombre}}</td>
                                            </tr>
                                        @endif
                                        <tr class="read">
                                            <td class="contact"><b>Estado</b></td>
                                            <td class="subject">{{$item->estado}}</td>
                                        </tr>
                                    @endforeach
                                @endif


                                @if(count($miembro->miembrosacramentos)>0)
                                    <tr class="read">
                                        <td class="contact btn-success" colspan="2" style="border-radius: 10px;">
                                            <center><b>Sacramentos</b></center>
                                        </td>
                                    </tr>
                                    @foreach($miembro->miembrosacramentos as $item)
                                        <tr class="read">
                                            <td class="contact"><b>{{$item->sacramento->nombre}}</b></td>
                                            <td class="subject">Lugar: {{$item->sacramento->lugar}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var text = $("#pastoral").text();
            text = text.split(' ');
            if (text[0] == 'EMAUS') $("#numero").text('Grupo');
            if (text[0] == 'RENOVACIÓN') $("#numero").text('Koinonia');
        });
    </script>
@endsection
