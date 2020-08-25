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
        <li class="active"><a href="{{route('individualadmin.index')}}">Intervención Individual</a></li>
        <li class="active"><a>Crear Solicitud de Intervención Idividual</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INTERVENCIONES - SOLICITUD DE INTERVENCIÓN INDIVIDUAL
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
                                  action="{{route('individualadmin.store')}}"
                                  name="formulario">
                                @csrf
                                <input type="hidden" name="estudiante_id" id="estudiante_id" required>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="documento" class="form-control"
                                                   placeholder="Escriba la identificación del estudiante"
                                                   name="documento"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a onclick="consultar()" class="btn waves-effect btn-block"
                                       style="background-color: #38A970; color: white"><strong>CONSULTAR
                                            USUARIO</strong></a>
                                </div>
                                <br><br>
                                <h1 class="card-inside-title" style="margin-right: 500px;margin-bottom: 30px;">DATOS DEL
                                    ESTUDIANTE</h1>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre del Estudiante</label>
                                            <br/><input type="text" id="nombre" class="form-control"
                                                        name="nombre" required="required"/>
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
                                            <label>Edad</label>
                                            <br/><input type="number" id="edad" class="form-control" name="edad"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Semestre</label>
                                            <br/><input type="number" id="semestre" class="form-control"
                                                        name="semestre"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Tipo de Riesgo</label>
                                            <br/><input type="text" id="riesgo" class="form-control" name="riesgo"/>
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
                                            <label>Correo</label>
                                            <br/><input type="email" id="correo" class="form-control" name="correo"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Motivo de Solicitud de Atención</label>
                                            <br/><select class="form-control show-tick" name="motivo_solicitud"
                                                         id="motivo_solicitud"
                                                         required>
                                                <option value="">--Seleccione una opción--</option>
                                                <option value="ORIENTACIÓN ACADÉMICA">ORIENTACIÓN ACDÉMICA</option>
                                                <option value="ORIENTACIÓN PSICOLÓGICA">ORIENTACIÓN PSICOLÓGICA</option>
                                                <option value="ORIENTACIÓN VOCACIONAL">ORIENTACIÓN VOCACIONAL</option>
                                                <option value="TUTORIAS">TUTORIAS</option>
                                                <option value="OTRO">OTRO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table>
                                        <thead>
                                        <tr style="background-color: #38A970;text-align:center;color: white;">
                                            <td><strong>HORAS</strong></td>
                                            <td><strong>LUNES</strong></td>
                                            <td><strong>MARTES</strong></td>
                                            <td><strong>MIERCOLES</strong></td>
                                            <td><strong>JUEVES</strong></td>
                                            <td><strong>VIERNES</strong></td>
                                            <td><strong>SABADOS</strong></td>
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
                                                        <td data-dia="{{$item}}" data-hora="{{$hora}}"
                                                            id="{{$cont1.$cont2}}"
                                                            onclick="guardar_etiqueta(this)"></td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Discapacitado</label>
                                            <br/><select class="form-control show-tick" name="discapacitado" required
                                                         id="discapacitado">
                                                <option value="">--Seleccione una opción</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Cual</label>
                                            <br/><input class="form-control show-tick" name="discapacidad" required
                                                        id="discapacidad"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre y apellido de docente que orienta la solicitud</label>
                                            <br/><input class="form-control show-tick" name="docente" required
                                                        id="docente">
                                        </div>
                                    </div>
                                </div>
                                <h1 class="card-inside-title" style="margin-right: 500px;margin-bottom: 30px;">
                                    INFORMACIÓN DE PERMANENCIA</h1>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Trazabilidad</label>
                                            <br/><select class="form-control show-tick" name="area"
                                                         id="area" onchange="getPersonal()" required>
                                                <option value="">--Seleccione una opción--</option>
                                                <option value="ORIENTACIÓN ACADÉMICA">ORIENTACIÓN ACDÉMICA</option>
                                                <option value="ORIENTACIÓN PSICOLÓGICA">ORIENTACIÓN PSICOLÓGICA</option>
                                                <option value="ORIENTACIÓN VOCACIONAL">ORIENTACIÓN VOCACIONAL</option>
                                                <option value="OTRO">OTRO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: none" id="div_apoy">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Programas de Apoyo que Requiere el Estudiante</label>
                                            <br/><select class="form-control show-tick" name="programaapoyo_id"
                                                         id="programaapoyo_id">
                                                <option value="0">--Seleccione una opción</option>
                                                @foreach($programas as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none" id="div_pro">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Programa</label>
                                            <br/><select class="form-control show-tick" name="programa_id"
                                                         onchange="getAsignaturas()"
                                                         id="programa_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none" id="div_asi">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Asignatura</label>
                                            <br/><select class="form-control show-tick" name="asignatura_id"
                                                         id="asignatura_id" onchange="getPersonal()">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Personal Disponible</label>
                                            <br/><select class="form-control show-tick" name="personal"
                                                         onchange="getDisponibilidad()"
                                                         id="personal">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Disponibilidad</label>
                                            <br/><select class="form-control show-tick" name="disponibilidad"
                                                         id="disponibilidad" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('individualadmin.index')}}"
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
    <!-- Modal -->
    <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS PROGRAMAS DE APOYO</h4>
                </div>
                <div class="modal-body">
                    Gestione la información de una solictud de intervensión individual y la información de la remisión.
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

        var horarios = [];
        var item;
        var pos;

        function consultar() {
            var doc = $("#documento").val();
            if (doc.length <= 0) {
                notify('Atención', 'Debe ingresar la identificación del estudiante para continuar.', 'warning')
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{url("intervencion/individualadmin/get/")}}/' + doc + "/estudiante",
                    data: {},
                }).done(function (msg) {

                    if (msg != "null") {
                        var m = JSON.parse(msg);
                        $("#estudiante_id").val(m.id);
                        $("#nombre").val(m.nombre);
                        $("#edad").val(m.edad);
                        $("#identificacion").val(m.identificacion);
                        $("#programa").val(m.programa);
                        $("#riesgo").val(m.riesgo);
                        $("#semestre").val(m.semestre);
                        $("#celular").val(m.celular);
                        $("#correo").val(m.correo);
                        $("#nombre").attr('disabled', 'true');
                        $("#edad").attr('disabled', 'true');
                        $("#identificacion").attr('disabled', 'true');
                        $("#programa").attr('disabled', 'true');
                        $("#riesgo").attr('disabled', 'true');
                        $("#semestre").attr('disabled', 'true');
                    } else {
                        limpiar();
                        notify('Atención', 'El estudiante consultado no esta registrado.', 'warning');
                    }
                })
            }
        }

        function getPersonal() {
            var id = $("#area").val();
            var value = $('#asignatura_id').val();
            value = (value == '') ? null : value;
            if (id == 'ORIENTACIÓN ACADÉMICA' &&  (value == null)) {
                $('#div_pro').removeAttr('style');
                $('#div_asi').removeAttr('style');
                $('#div_apoy').attr('style','display: none');
                getProgramas();
            } else {
                if(id != 'ORIENTACIÓN ACADÉMICA'){
                    $('#div_pro').attr('style', 'display: none');
                    $('#div_asi').attr('style', 'display: none');
                    $('#asignatura_id').val(null);
                }
                if(id == 'OTRO'){
                    $('#div_apoy').removeAttr('style');
                    $('#personal option').each(function () {
                        $(this).remove();
                    });
                    $('#disponibilidad option').each(function () {
                        $(this).remove();
                    });
                    return;
                }else{
                    $('#div_apoy').attr('style','display: none');
                }
                $.ajax({
                    type: 'GET',
                    url: '{{url('intervencion/individualadmin/get/personal')}}/' + id+'/'+value,
                    data: {},
                }).done(function (msg) {
                    $('#personal option').each(function () {
                        $(this).remove();
                    });
                    $('#disponibilidad option').each(function () {
                        $(this).remove();
                    });
                    if (msg !== "null") {
                        var m = JSON.parse(msg);
                        $("#personal").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                        $.each(m, function (index, item) {
                            $("#personal").append("<option value='" + item.id + "'>" + item.value + "</option>");
                        });
                    } else {
                        $("#personal").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                        $("#disponibilidad").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                        notify('Atención', 'El Area seleccionada no tiene personal disponible.', 'warning');
                    }
                });
            }
        }

        function getProgramas() {
            $.ajax({
                type: 'GET',
                url: '{{url('intervencion/individualadmin/get/programas/')}}',
                data: {},
            }).done(function (msg) {
                $('#programa_id option').each(function () {
                    $(this).remove();
                });
                $('#asignatura_id option').each(function () {
                    $(this).remove();
                });
                $('#personal option').each(function () {
                    $(this).remove();
                });
                $('#disponibilidad option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $("#programa_id").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#programa_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    $("#programa_id").append("<option value=''>" + "Sin Disponibilidad" + "</option>");
                    $("#asignatura_id").append("<option value=''>" + "Sin Disponibilidad" + "</option>");
                    $("#personal").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                    $("#disponibilidad").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                    notify('Atención', 'El Area seleccionada no tiene personal disponible.', 'warning');
                }
            });
        }

        function getAsignaturas() {
            var id = $('#programa_id').val();
            $.ajax({
                type: 'GET',
                url: '{{url('intervencion/individualadmin/get/asignaturas')}}/' + id,
                data: {},
            }).done(function (msg) {
                $('#asignatura_id option').each(function () {
                    $(this).remove();
                });
                $('#personal option').each(function () {
                    $(this).remove();
                });
                $('#disponibilidad option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $("#asignatura_id").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#asignatura_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    $("#asignatura_id").append("<option value=''>" + "Sin Disponibilidad" + "</option>");
                    $("#personal").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                    $("#disponibilidad").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                    notify('Atención', 'El Programa seleccionado no tiene asignaturas relacionadas.', 'warning');
                }
            });
        }

        function getDisponibilidad() {
            var id = $("#personal").val();
            $.ajax({
                type: 'GET',
                url: '{{url('intervencion/individualadmin/get/')}}/' + id + "/disponibilidad",
                data: {},
            }).done(function (msg) {
                $('#disponibilidad option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $("#disponibilidad").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#disponibilidad").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    $("#disponibilidad").append("<option value='0'>" + "Sin Disponibilidad" + "</option>");
                    notify('Atención', 'La persona seleccionada no tiene horario disponible.', 'warning');
                }
            });
        }

        function limpiar() {
            $("#estudiante_id").val("");
            $("#nombre").val("");
            $("#edad").val("");
            $("#identificacion").val("");
            $("#programa").val("");
            $("#riesgo").val("");
            $("#semestre").val("");
            $("#celular").val("");
            $("#correo").val("");
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
                    'estudiante_id': $("#estudiante_id").val()
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
            var id = $("#estudiante_id").val();
            if (id.length <= 0 || $("#correo").val().length <= 0 || $("#motivo_solicitud").val().length <= 0 || $("#docente").val().length <= 0 || $("#discapacitado").val().length <= 0 ) {
                notify('Atención', 'Debe completar el formulario para guardar la solicitud.', 'warning');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '{{url('intervencion/individualadmin')}}',
                    data:
                        {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'form': $('#form-intervencion').serialize(),
                            'dispo': horarios
                        }
                }).done(function (msg) {
                    if (msg != 'null') {
                        notify('Atención', 'La solicitud de intevención individual para el estudiante.' + $("#identificacion").val() + ' - ' + $("#nombre").val() + ' fue creada con exito.!', 'success');
                    } else {
                        notify('Atención', 'La solicitud de intevención individual para el estudiante.' + $("#identificacion").val() + ' - ' + $("#nombre").val() + ' no pudo ser alamacenada.', 'error');
                    }
                });
            }
        }
    </script>
@endsection
