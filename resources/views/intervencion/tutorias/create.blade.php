@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.intervencion')}}">General</a></li>
        <li class="active"><a href="{{route('tutoria.index')}}">Programas de Apoyo</a></li>
        <li class="active"><a>Gestionar Tutoria</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        INTERVENCIÓN - TUTORIAS
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
                    <h1 class="card-inside-title">DATOS DE LA TUTORIA</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                  action="{{route('tutoria.store')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Fecha de las Tutorias</label>
                                                <br/><input type="date" class="form-control"
                                                            placeholder="Seleccione la fecha" name="fecha" id="fecha"
                                                            required="required" onchange="getEstudiantes()"/>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="tabla"
                                                   class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable"
                                                   width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>IDENTIFICACIÓN</th>
                                                    <th>NOMBRE</th>
                                                    <th>ASISTENCIA</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tb2">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Adjuntar el archivo de soporte</label>
                                                <br/><input type="file" class="form-control"
                                                            placeholder="Seleccione la fecha" name="soporte"
                                                            id="soporte" required="required"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('tutoria.index')}}"
                                                         class="btn bg-red waves-effect">Cancelar</a>
                                            <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario
                                            </button>
                                            <button class="btn bg-green waves-effect" type="submit">Guardar</button>
                                        </div>
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
                    <strong>Agregue nuevos programas de apoyo,</strong> Gestione los diferentes programas de apoyo para
                    los estudiantes.
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
        $(document).ready(function () {
            $('#datatables').DataTable();
        });

        function getEstudiantes() {
            $("#tb2").html("");
            var fecha = $("#fecha").val();
            $.ajax({
                type: 'GET',
                url: '{{url("intervencion/tutoria/get/")}}/' + fecha + "/remisiones",
                data: {},
            }).done(function (msg) {

                if (msg != "null") {
                    var m = JSON.parse(msg);
                    var html = "";
                    $.each(m, function (index, item) {
                        html = html + "<tr><td>" + item.identificacion + "</td>";
                        html = html + "<td>" + item.nombre + "</td>";
                        html = html + "<td style='text-align: center'><input type='checkbox' class='filled-in' name='asistencia[]' id='ig_" + item.id + "' value='" + item.id + "'><label for='ig_" + item.id + "'></label></td>";
                        +"</tr>";
                    });
                    $("#tb2").html(html);
                } else {
                    notify('Atención', 'No hay tutorias para la fecha seleccionada.', 'warning');
                    return;
                }
            });
        }
    </script>
@endsection
