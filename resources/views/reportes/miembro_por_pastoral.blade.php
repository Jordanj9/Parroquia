@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.reportes')}}">Reportes</a></li>
        <li class="active"><a href="">Miembros por Pastoral</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REPORTES - MIEMBROS POR PASTORAL<small>Haga clic en el botón de 3 puntos de la derecha de
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
                                <label>Pastoral</label>
                                <br/><select class="form-control show-tick" name="pastoral_id" id="pastoral_id">
                                    <option value="TODO">TODO</option>
                                    @foreach($pastorales as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label>Desde</label>
                                <br/><input type="date" class="form-control" name="desde" id="desde">
                            </div>
                        </div>
                        <div class="col-md-3">
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
                               class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable"
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LAS PASTORALES</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione la información de las pastorales pertenecientes a una parroquia.
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
            tabla.destroy();
            var pastoral = $("#pastoral_id").val();
            var desde = $("#desde").val();
            var hasta = $("#hasta").val();
            if (pastoral.length <= 0 || Date.parse(desde) >= Date.parse(hasta)) {
                notify("Atención!", "Debe seleccionar un rango de fecha correcto.", "warning");
            }
            if (desde.length <= 0) desde = null;
            if (hasta.length <= 0) hasta = null;
            var pdf = false;
            tabla = $('#tabla').DataTable({
                "ServiceSide": true,
                "ajax": '{{url("reportes/miembro/pastoral/")}}/' + pastoral + "/" + desde + "/" + hasta + "/" + pdf + "/consultar",
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

        function eliminar(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Estas seguro(a)?',
                text: "no podras revertilo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: 'cancelar'
            }).then((result) => {
                if (result.value) {
                    let url = 'pastorales/' + id;
                    axios.delete(url).then(result => {
                        let data = result.data;
                        if (data.status == 'ok') {
                            Swal.fire(
                                'Eliminado!',
                                data.message,
                                'success'
                            ).then(result => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'danger'
                            ).then(result => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }

        function getMiembros() {
            var pastoral = $("#pastoral_id").val();
            var desde = $("#desde").val();
            var hasta = $("#hasta").val();
            if (pastoral.length <= 0 || Date.parse(desde) >= Date.parse(hasta)) {
                notify("Atención!", "Debe seleccionar un rango de fecha correcto.", "warning");
            } else {
                if (desde.length <= 0) desde = null;
                if (hasta.length <= 0) hasta = null;
                var pdf = true;
                var a = document.createElement("a");
                a.target = "_blank";
                a.href = '{{url("reportes/miembro/pastoral/")}}/' + pastoral + "/" + desde + "/" + hasta + "/" + pdf + "/consultar";
                a.click();
            }
        }
    </script>
@endsection
