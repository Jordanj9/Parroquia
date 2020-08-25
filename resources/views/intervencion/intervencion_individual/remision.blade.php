@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.general')}}">General</a></li>
        <li class="active"><a href="{{route('individualadmin.index')}}">Intervención Individual</a></li>
        <li class="active"><a>Remitir</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INTERVENCIONES - REMISIÓN
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
                                  action="{{route('individualadmin.guardarRemision')}}"
                                  name="formulario">
                                @csrf
                                <input type="hidden" name="intervencionindividual_id" value="{{$intervension->id}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre del Estudiante</label>
                                            <br/><input type="text" id="nombre" class="form-control" disabled
                                                        name="nombre" value="{{$intervension->estudiante->primer_nombre.' '.$intervension->estudiante->segundo_nombre.' '.$intervension->primer_apellido.' '.$intervension->estudiante->segundo_apellido}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Programa</label>
                                            <br/><input type="text" id="programa" class="form-control" disabled
                                                        name="programa" value="{{$intervension->estudiante->programa->nombre}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>No. de Identificación</label>
                                            <br/><input type="text" id="identificacion" class="form-control" disabled
                                                        name="identificacion" value="{{$intervension->estudiante->tipo_documento.'-'.$intervension->estudiante->identificacion}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Edad</label>
                                            <br/><input type="number" id="edad" class="form-control" name="edad" disabled value="{{$edad}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Semestre</label>
                                            <br/><input type="number" id="semestre" class="form-control" disabled
                                                        name="semestre" value="{{$intervension->estudiante->semestre}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Tipo de Riesgo</label>
                                            <br/><input type="text" id="riesgo" class="form-control" name="riesgo" disabled value="{{$riesgo}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Celular</label>
                                            <br/><input type="text" id="celular" class="form-control" disabled name="celular" value="{{$intervension->celular}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Correo</label>
                                            <br/><input type="email" id="correo" class="form-control" name="correo" disabled value="{{$intervension->correo}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Motivo de Solicitud de Atención</label>
                                            <br/><input type="text" id="motivo" class="form-control" name="motivo" disabled value="{{$intervension->motivo_solicitud}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Discapacitado</label>
                                            <br/><br/><input type="text" id="discapacitado" class="form-control" name="correo" disabled value="{{$intervension->discapacitado}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Cual</label>
                                            <br/><input class="form-control show-tick" name="discapacidad" value="{{$intervension->discapacidad}}" disabled
                                                        id="discapacidad"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Estado</label>
                                            <br/><input class="form-control show-tick" name="estado" disabled value="{{$intervension->estado}}"
                                                        id="estado">
                                        </div>
                                    </div>
                                </div>
                                <h1 class="card-inside-title">INFORMACIÓN DE PERMANENCIA</h1>
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
                                        <button class="btn bg-green waves-effect" type="submit">Guardar</button>
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
                    Remita la solicitud de intervención individual seleccionada hacia las diferentes areas.
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

        function getPersonal() {
            var id = $("#area").val();
            var value = $('#asignatura_id').val();
            if (id == 'ORIENTACIÓN ACADÉMICA' &&  (value == null)) {
                $('#div_pro').removeAttr('style');
                $('#div_asi').removeAttr('style');
                $('#div_apoy').attr('style','display: none');
                $('#disponibilidad').attr('required','required');
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
                    $('#disponibilidad').removeAttr('required');
                    return;
                }else{
                    $('#div_apoy').attr('style','display: none');
                    $('#disponibilidad').attr('required','required');
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
    </script>
@endsection
