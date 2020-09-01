@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('comunidad.index')}}">Comunidades</a></li>
        <li class="active"><a>Ver Comunidad</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL - COMUNIDADES
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DE LA COMUNIDAD SELECCIONADO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table id="tabla" class="table table-hover">
                                <tbody>
                                <tr class="read">
                                    <td class="contact"><b>Pastoral</b></td>
                                    <td class="subject" id="pastoral">{{$comunidad->pastoral->nombre}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Subpastoral</b></td>
                                    <td class="subject">{{$comunidad->subpastoral_id != null ? $comunidad->subpastoral->nombre:'--'}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b id="numero">Comunidad</b></td>
                                    <td class="subject">{{$comunidad->numero}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Hora</b></td>
                                    <td class="subject">{{$comunidad->hora}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Día</b></td>
                                    <td class="subject">{{$comunidad->dia}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Sala</b></td>
                                    <td class="subject">{{$comunidad->sala}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Creado</b></td>
                                    <td class="subject">{{$comunidad->created_at}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Modificado</b></td>
                                    <td class="subject">{{$comunidad->updated_at}}</td>
                                </tr>
                                <table class="table table-hover">
                                    <h1 class="card-inside-title">LIDERES</h1>
                                    @foreach($array as $key => $value)
                                        <thead>
                                        <tr>
                                            <th>{{$key}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($value as $item)
                                            <tr>
                                                <td>{{$item->lider->identificacion." - ".$item->lider->nombre}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endforeach
                                </table>
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
        $(document).ready(function (){
            var text = $("#pastoral").text();
            text = text.split(' ');
            if(text[0] == 'EMAUS') $("#numero").text('Grupo');
            if(text[0] == 'RENOVACIÓN') $("#numero").text('Koinonia');
        });
    </script>
@endsection
