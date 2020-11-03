@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.reportes')}}">Reportes</a></li>
        <li class="active"><a href="">Buscar Miembro</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REPORTES - BUSCAR MIEMBRO<small>Haga clic en el botón de 3 puntos de la derecha de
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
                        <div class="col-md-6">
                            <div class="form-line">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xs-12" style="margin-top: 20px">
                            <button type="button" onclick="getMiembros()" class="btn bg-cyan waves-effect">
                                <i class="material-icons">search</i>
                                <span>BUSCAR</span>
                            </button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="table-responsive" style="margin-right: -2px">
                        <table id="tabla"
                               class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable"
                               width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>IDENTIFICACIÓN</th>
                                <th>NOMBRE</th>
                                <th>DIRECCIÓN</th>
                                <th>TELEFONO</th>
                                <th>SEXO</th>
                                <th>EDAD</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody id="tb2">

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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE EL REPORTE</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Consulte los miembros por las diferentes ocupaciones.
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
            $(".chosen-select").chosen();
        });

        function getData() {
            var ocuapacion = $("#ocupacion_id").val();
            if (ocuapacion.length <= 0 ) {
                notify("Atención!", "Debe seleccionar una ocupación.", "warning");
                return;
            }
            tabla.destroy();
            var pdf = false;
            tabla = $('#tabla').DataTable({
                "ServiceSide": true,
                "ajax": '{{url("reportes/miembro/get/ocupacion/")}}/' + ocuapacion + "/" + pdf + "/consultar",
                "columns": [
                    {data: 'nom'},
                    {data: 'dir'},
                    {data: 'tel'},
                    {data: 'sexo'},
                    {data: 'edad'},
                    {data: 'ocupacion'},
                ]
            });
        }

        function getMiembros() {
            var nombre = $("#nombre").val();
            if (nombre.length <= 0 ) {
                notify("Atención!", "Debe seleccionar una ocupación.", "warning");
                return;
            } else {
                $.ajax({
                    type:'GET',
                    url:'{{url("reportes/miembro/get/nombre/")}}/' + nombre + "/consultar",
                    data:{},
                }).done(function (msg){
                    if(msg.status == 'ok'){
                        var html = "";
                        $.each(msg.response, function (index, item) {
                            html = html + "<tr><td>" + item.identificacion + "</td>";
                            html = html + "<td>" + item.nom + "</td>";
                            html = html + "<td>" + item.dir + "</td>";
                            html = html + "<td>" + item.tel + "</td>";
                            html = html + "<td>" + item.sexo + "</td>";
                            html = html + "<td>" + item.edad + "</td>";
                            {{--"{{url("pastoral/miembro/")}}+item.id+"
                            {{url("pastoral/miembro/")}} + "/" +item.id--}}
                            {{--url+"pastoral/miembro/"+item.id--}}
                            html = html + "<td><a class='btn bg-green waves-effect btn-xs' data-toggle='tooltip' data-placement='top' title='Ver Miembro' href='"+ url+"pastoral/miembro/"+item.id+"'><i class='material-icons'>remove_red_eye</i></a></td>";
                            +"</tr>";
                        });
                        $("#tb2").html(html);
                    }else{
                        notify("Atención!", "No hay existen miembros con el nombre ingresado.", "warning");
                    }
                });
            }
        }
    </script>
@endsection
