@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('subpastoral.index')}}">Subpastorales</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL - SUBPASTORALES<small>Haga clic en el botón de 3 puntos de la derecha de
                            este título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('subpastoral.create') }}">Agregar Nueva Subpastoral</a></li>
                                <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla"
                               class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable"
                               width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>PASTORAL</th>
                                <th>ACCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subs as $sub)
                                @foreach($sub as $i)
                                    <tr>
                                        <td>{{$i->nombre}}</td>
                                        <td>{{$i->descripcion}}</td>
                                        <td>{{$i->pastoral->nombre}}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('subpastoral.edit',$i->id)}}"
                                               class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                               data-placement="top" title="Editar Subpastoral"><i
                                                    class="material-icons">mode_edit</i></a>
                                            <a href="#" onclick="eliminar(event,{{$i->id}})"
                                               class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                               data-placement="top" title="Eliminar Subpastoral"><i
                                                    class="material-icons">delete</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LAS SUBPASTORALES</h4>
                </div>
                <div class="modal-body">
                    <strong>Detalles: </strong>Gestione la información de las subpastorales pertenecientes a una
                    pastoral.
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
        $(document).ready(function () {
            $('#tabla').DataTable();
        });

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
                    let url = 'subpastoral/' + id;
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
    </script>
@endsection
