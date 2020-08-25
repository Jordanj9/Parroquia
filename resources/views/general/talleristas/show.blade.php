@extends('layouts.admin')
@section('style')
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }

        #horario ,#horario td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            width: 80px;
        }

        #label-button {
            color: white;
            position: absolute;
            height: 20px;
            width: 20px;
            top: 3px;
            right: -5px;
            border-radius: 50%;
            border: 1px solid #38A970;
            background-color: #38A970;
        }
    </style>
@endsection
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('talleristas.index')}}">Talleristas</a></li>
    <li class="active"><a>Ver Tallerista</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    TALLERISTAS
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <h1 class="card-inside-title">DATOS DEL TALLERISTA {{$tallerista->nombres}}</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                                <tr class="read">
                                    <td class="contact"><b>Identificación</b></td>
                                    <td class="subject">{{$tallerista->identificacion}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Nombres</b></td>
                                    <td class="subject">{{$tallerista->nombres}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Celular</b></td>
                                    <td class="subject">{{$tallerista->celular}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Correo Institucional</b></td>
                                    <td class="subject">{{$tallerista->correo_institucional}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Correo Institucional</b></td>
                                    <td class="subject">{{$tallerista->correo_personal}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Tipo de tallerista</b></td>
                                    <td class="subject">{{$tallerista->tipo}}</td>
                                </tr>
                                <tr class="read">
                                    <td class="contact"><b>Fecha de nacimiento</b></td>
                                    <td class="subject">{{$tallerista->fecha_de_nacimiento}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="col-md-12">
                            <table id="horario">
                                <thead>
                                <tr style="background-color: #38A970; color: white;">
                                    <td>HORAS</td>
                                    <td>LUNES</td>
                                    <td>MARTES</td>
                                    <td>MIERCOLES</td>
                                    <td>JUEVES</td>
                                    <td>VIERNES</td>
                                    <td>SABADOS</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $cont1 = $cont2 = 0; ?>
                                @foreach($horas as $hora)
                                    <tr>
                                        <?php $cont1 = $cont1 + 1; $cont2 = 0;?>
                                        @foreach($horarios as $item)
                                            <?php $cont2 = $cont2 + 1; ?>
                                            @if($cont2 == 1)
                                                <td>{{$hora}}</td>
                                            @else
                                                <td data-dia="{{$item}}" data-hora="{{explode(':',$hora)[0]}}"
                                                    id="{{$item.explode(':',$hora)[0]}}"
                                                    ></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        window.onload = function () {
            $.ajax({
                type: 'GET',
                url: '{{url('general/talleristas')}}/'+'{{$tallerista->id}}'+'/disponibilidad',
            }).done(function (msg) {
                if(msg.status == 'ok'){
                    let disponibilidad  = msg.disponibilidad;
                    disponibilidad.forEach((item)=>{
                        $('#'+item.dia+item.hora).attr('style', 'background-color: teal');
                    });
                }
            });
        }
    </script>
@endsection
