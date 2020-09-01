@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('comunidad.index')}}">Comunidades</a></li>
        <li class="active"><a>Editar</a></li>
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
                    <h1 class="card-inside-title">EDITAR DATOS DE LA COMUNIDAD</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST"
                                  action="{{route('comunidad.update',$comunidad->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <input type="hidden" name="comunidad_id" id="comunidad_id" value="{{$comunidad->id}}">
                                <div class="col-md-12">
                                    <div class="col-md-6" id="div_pas">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Pastoral</label>
                                                <br/><h5>{{$comunidad->pastoral->nombre}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Subpastoral</label>
                                                <br/>
                                                <h5>{{$comunidad->subpastoral_id != null ? $comunidad->subpastoral->nombre:"--"}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label id="numero_label">Comunidad</label>
                                                <input type="number" class="form-control" id="numero-in"
                                                       placeholder="Escriba el número de la comunidad, grupo o koinonia"
                                                       value="{{$comunidad->numero}}"
                                                       name="numero" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Día de reunión</label>
                                                <br/><select class="form-control show-tick" id="dia"
                                                             name="dia" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($dias as $value)
                                                        @if($comunidad->dia == $value)
                                                            <option value="{{$value}}" selected>{{$value}}</option>
                                                        @else
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Hora de reunión</label>
                                                <br/><select class="form-control show-tick" id="hora"
                                                             name="hora" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($horas as $value)
                                                        @if($comunidad->hora == $value)
                                                            <option value="{{$value}}" selected>{{$value}}</option>
                                                        @else
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Sala</label>
                                                <br/><input class="form-control" name="sala" id="sala"
                                                            placeholder="Escriba el lugar de la reunión."
                                                            value="{{$comunidad->sala}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            @foreach($array as $key => $value)
                                                <thead>
                                                <tr>
                                                    <th>{{$key}}</th>
                                                    <td><a href="#" id="{{$key}}" onclick="cambiar(this.id)" data-toggle="modal" data-target="#Modal"
                                                           title="Agregar otro"><i class="material-icons"
                                                                                   style="margin-left: 80%;color: blue">add_box</i></a>
                                                    </td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($value as $item)
                                                    <tr>
                                                        <td>{{$item->lider->identificacion." - ".$item->lider->nombre}}</td>
                                                        <td><a href="#" onclick="eliminar(event,{{$item->id}})"
                                                               class="btn-xs" data-toggle="tooltip" data-placement="top"
                                                               title="Quitar de la comunidad"><i class="material-icons"
                                                                                                 style="margin-left: 80%;color: red">clear</i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('comunidad.index')}}"
                                                         class="btn bg-red waves-effect" style="margin-bottom: 10px">Cancelar</a>
                                            <button class="btn bg-indigo waves-effect" style="margin-bottom: 10px"
                                                    type="reset">Limpiar Formulario
                                            </button>
                                            <button class="btn bg-green waves-effect" style="margin-bottom: 10px"
                                                    type="submit">Guardar
                                            </button>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LAS PASTORALES</h4>
                </div>
                <div class="modal-body">
                    <strong>Edite los datos de la pastoral seleccionada,</strong> Gestione la información de las
                    pastorales pertenecientes a una parroquia.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">AGREAGAR NUEVA PERSONA</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="tipo" id="tipo">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-line">
                                <label>Identificacón</label>
                                <br/><input type="number" id="identificacion" class="form-control" name="identificacion"
                                       placeholder="Escriba la identificación de la persona">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-line">
                                <label>Nombre</label>
                                <br/><input type="text" id="nombre" class="form-control" name="nombre"
                                       placeholder="Escriba el nombre de la persona">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <br/><button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CANCELAR</button>
                    <a href="#" onclick="guardar(event)" type="button" class="btn btn-info waves-effect" data-placement="top">GUARDAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        function cambiar(id){
            $("#tipo").val(id);
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
                    let url = '../quitar/lider/' + id;
                    axios.get(url).then(result => {
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
        function guardar(event) {
            var id = $("#tipo").val();
            var comunidad = $("#comunidad_id").val();
            var nom = $("#nombre").val();
            var iden = $("#identificacion").val();
            if(nom.length <= 0 || iden.length <= 0){
                notify('Atención', 'Debe llenar todos los campos de la persona para continuar.', 'warning');
            }
            event.preventDefault();
            Swal.fire({
                title: 'Estas seguro(a)?',
                text: "se agregara esta persona como "+id,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, agregar!',
                cancelButtonText: 'cancelar'
            }).then((result) => {
                if (result.value) {
                    let url = '../guardar/lider/' + comunidad + '/' + id + '/'+ nom + '/' + iden;
                    axios.get(url).then(result => {
                        let data = result.data;
                        if (data.status == 'ok') {
                            Swal.fire(
                                'Agregado!',
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

