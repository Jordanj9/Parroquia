@extends('layouts.admin')
@section('style')
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }

        table, td {
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
        <li><a href="{{route('admin.general')}}">General</a></li>
        <li class="active"><a>Gestionar Disponibilidad Docente</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DOCENTES - DISPONIBILIDAD DOCENTE
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
                    <h1 class="card-inside-title">DATOS DE LA SOLICITUD</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="form-intervencion" method="POST"
                                  action="{{route('docentes.store')}}"
                                  name="formulario">
                                @csrf
                                <input type="hidden" name="docente_id" id="docente_id" required>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="documento" class="form-control"
                                                   placeholder="Escriba la identificación del docente"
                                                   name="documento"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a onclick="consultar()" class="btn waves-effect btn-block" style="background-color: #38A970; color: white"><strong>CONSULTAR
                                            USUARIO</strong></a>
                                </div>
                                <br><br>
                                <h1 class="card-inside-title" style="margin-right: 500px;margin-bottom: 30px;">DATOS DEL
                                    DOCENTE</h1>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre del Docente</label>
                                            <br/><input type="text" id="nombres" class="form-control"
                                                        name="nombres" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Programa</label>
                                            <br/><input type="text" id="programa" class="form-control"
                                                        name="programa"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>No. de Identificación</label>
                                            <br/><input type="text" id="identificacion" class="form-control"
                                                        name="identificacion"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Celular</label>
                                            <br/><input type="text" id="celular" class="form-control" name="celular"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Correo Institucional</label>
                                            <br/><input type="email" id="correo_institucional" class="form-control" name="correo_institucional"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Correo Personal</label>
                                            <br/><input type="email" id="correo_personal" class="form-control" name="correo_personal"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table>
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
                                                            onclick="guardar_etiqueta(this)"></td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('admin.general')}}"
                                                     class="btn bg-red waves-effect">Cancelar</a>
                                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario
                                        </button>
                                        <a class="btn bg-green waves-effect" onclick="guardar()">Guardar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        var horarios = [];
        var item;
        var pos;

        function consultar() {
            var doc = $("#documento").val();
            if (doc.length <= 0) {
                notify('Atención', 'Debe ingresar la identificación del docente para continuar.', 'warning')
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{url("general/get/")}}/' + doc + "/docente",
                    data: {},
                }).done(function (msg) {
                    if (msg != "null") {
                        horarios = [];
                        var m = JSON.parse(msg);
                        $("#docente_id").val(m.id);
                        $("#nombres").val(m.nombres);
                        $("#identificacion").val(m.identificacion);
                        $("#programa").val(m.programa);
                        $("#celular").val(m.celular);
                        $("#correo_institucional").val(m.correo_institucional);
                        $("#correo_personal").val(m.correo_personal);
                        let disponibilidad  = m.disponibilidad;
                        disponibilidad.forEach((item)=>{
                            $('#'+item.dia+item.hora).attr('style', 'background-color: teal');
                            horarios.push({
                                'id': item.dia+item.hora,
                                'dia': item.dia,
                                'hora': item.hora,
                            });
                        });

                    } else {
                        limpiar();
                        notify('Atención', 'El Docente consultado no esta registrado.', 'warning');
                    }
                })
            }
        }

        function limpiar() {
            $("#estudiante_id").val("");
            $("#nombres").val("");
            $("#identificacion").val("");
            $("#programa").val("");
            $("#celular").val("");
            $("#correo_institucional").val("");
            $("#correo_personal").val("");
        }

        function guardar_etiqueta(id) {
            let td = id;
            item = td.getAttribute('id');
            if (td.getAttribute('style') == null) {
                $("#" + td.getAttribute('id')).attr('style', 'background-color: teal');
                $("#" + td.getAttribute('id')).attr('value', '1');
                horarios.push({
                    'id': td.getAttribute('id'),
                    'dia': td.getAttribute('data-dia'),
                    'hora': td.getAttribute('data-hora'),
                });
            } else {
                $("#" + td.getAttribute('id')).removeAttr('style');
                horarios.forEach(getIndex);
                horarios.splice(pos, 1);
            }
        }

        function getIndex(element, index, array) {
            if (element.id == item) {
                pos = index;
            }
        }

        function guardar() {
            var id = $("#docente_id").val();
            $.ajax({
                type: 'PUT',
                url: '{{url('general/docente')}}/'+id+'/guardar_disponibilidad',
                data:
                    {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'disponibilidad': horarios
                    }
            }).done(function (msg) {
                if (msg != 'null') {
                    notify('Atención', 'La Disponibilidad del Docente.' + $("#identificacion").val() + ' - ' + $("#nombres").val() + ' fue actualizada correctamente.!', 'success');
                } else {
                    notify('Atención', 'La Disponibilidad del Docente.' + $("#identificacion").val() + ' - ' + $("#nombre").val() + ' no pudo ser alamacenada.', 'error');
                }
            });
        }

    </script>
@endsection
