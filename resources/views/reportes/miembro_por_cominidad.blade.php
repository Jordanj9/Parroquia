@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.reportes')}}">Reportes</a></li>
        <li class="active"><a href="">Miembros por Comunidad</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REPORTES - MIEMBROS POR COMUNIDAD<small>Haga clic en el botón de 3 puntos de la derecha de
                            este título para ayuda.</small>
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
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="form-line">
                                <label>Pastoral</label>
                                <select class="form-control show-tick" name="pastoral_id" id="pastoral_id"
                                        onchange="getSubpastoral()">
                                    <option value="">--seleccione una opción--</option>
                                    @foreach($realidades as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-line">
                                <label>Subpastoral</label>
                                <select class="form-control" name="subpastoral_id" id="subpastoral_id"
                                        onchange="getComunidades(0,this.id)" disabled>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-line">
                                <label id="numero_label">Comunidad <i style="color: red">*</i></label>
                                <select class="form-control" name="comunidad_id" id="comunidad_id" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-line">
                                <label>Desde</label>
                                <br/><input type="date" class="form-control" name="desde" id="desde">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-line">
                                <label>Hasta</label>
                                <br/><input type="date" class="form-control" name="hasta" id="hasta">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-xs-6 col-lg-6">
                            <button type="button" onclick="getData()" class="btn bg-green btn-circle-lg waves-effect waves-circle waves-float">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                        <div class="col-md-6 col-xs-6 col-lg-6">
                            <button type="button" onclick="getMiembros()" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float">
                                <i class="material-icons">print</i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-right: -2px">
                        <table id="tabla"
                               class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable"
                               width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>DIRECCIÓN</th>
                                <th>TELEFONO</th>
                                <th>SEXO</th>
                                <th>EDAD</th>
                                <th>PASTORAL</th>
                            </tr>
                            </thead>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE EL REPORTE</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Consulte los miembros por las diferentes comunidades pertenecientes a una pastoral.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        let tabla;
        let ruta;
        $(document).ready(function () {
            tabla = $('#tabla').DataTable();
        });

        function getData() {
            var comunidad = $("#comunidad_id").val();
            var desde = $("#desde").val();
            var hasta = $("#hasta").val();
            if (comunidad == null || Date.parse(desde) >= Date.parse(hasta) || comunidad.length <= 0) {
                notify("Atención!", "Debe seleccionar una comunidad y un rango de fecha correcto.", "warning");
                return;
            }
            tabla.destroy();
            if (desde.length <= 0) desde = null;
            if (hasta.length <= 0) hasta = null;
            var pdf = false;
            tabla = $('#tabla').DataTable({
                "ServiceSide": true,
                "ajax": '{{url("reportes/miembro/get/comunidad/")}}/' + comunidad + "/" + desde + "/" + hasta + "/" + pdf + "/consultar",
                "columns": [
                    {data: 'nom'},
                    {data: 'dir'},
                    {data: 'tel'},
                    {data: 'sexo'},
                    {data: 'edad'},
                    {data: 'pastoral'},
                ]
            });
        }

        function getMiembros() {
            var comunidad = $("#comunidad_id").val();
            var desde = $("#desde").val();
            var hasta = $("#hasta").val();
            if (comunidad.length <= 0 || Date.parse(desde) >= Date.parse(hasta)) {
                notify("Atención!", "Debe seleccionar un rango de fecha correcto.", "warning");
            } else {
                if (desde.length <= 0) desde = null;
                if (hasta.length <= 0) hasta = null;
                var pdf = true;
                var a = document.createElement("a");
                a.target = "_blank";
                a.href = '{{url("reportes/miembro/get/comunidad/")}}/' + comunidad + "/" + desde + "/" + hasta + "/" + pdf + "/consultar";
                a.click();
            }
        }

        function getSubpastoral() {
            var pas = $("#pastoral_id").val();
            $.ajax({
                type: 'GET',
                url: '{{url('pastoral/comunidad/get')}}/' + pas + '/subpastorales',
                data: {},
            }).done(function (msg) {
                $('#subpastoral_id option').each(function () {
                    $(this).remove();
                });
                $('#comunidad_id option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    $("#subpastoral_id").removeAttr('disabled');
                    var m = JSON.parse(msg);
                    $("#subpastoral_id").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#subpastoral_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    $("#subpastoral_id").attr('disabled', 'disabled');
                    getComunidades(pas, 'PASTORAL');
                }
            });
        }

        function getComunidades(id, modelo) {
            if (modelo != 'PASTORAL') {
                var mod = 'SUBPASTORAL';
                var val = $("#subpastoral_id").val();
            } else {
                var mod = modelo;
                var val = id;
            }
            $.ajax({
                type: 'GET',
                url: '{{url('pastoral/comunidad/get')}}/' + val + '/' + mod + '/comunidades',
                data: {},
            }).done(function (msg) {
                $('#comunidad_id option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $("#comunidad_id").append("<option value=''>" + "--Seleccione una opcción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#comunidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    notify("Atención", "No hay comunidad para los parametros seleccionados.", "warning");
                }
            });

        }
    </script>
@endsection
