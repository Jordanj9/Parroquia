@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('comunidad.index')}}">Comunidades</a></li>
        <li class="active"><a>Crear</a></li>
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
                    <h1 class="card-inside-title">DATOS DE LA COMUNIDAD</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('comunidad.store')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-6" id="div_pas">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Pastoral</label>
                                                <br/><select class="form-control show-tick" id="pastoral_id"
                                                             name="pastoral_id" onchange="getSubpastoral()" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($pastorales as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Subpastoral</label>
                                                <br/><select class="form-control show-tick" id="subpastoral_id" disabled
                                                             name="subpastoral_id">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label id="numero_label">Comunidad</label>
                                                <input type="number" class="form-control" id="numero-in"
                                                       placeholder="Escriba el número de la comunidad, grupo o koinonia"
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
                                                    <option value="LUNES">LUNES</option>
                                                    <option value="MARTES">MARTES</option>
                                                    <option value="MIERCOLES">MIERCOLES</option>
                                                    <option value="JUEVES">JUEVES</option>
                                                    <option value="VIERNES">VIERNES</option>
                                                    <option value="SABADO">SABADO</option>
                                                    <option value="DOMINGO">DOMINGO</option>
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
                                                        <option value="{{$value}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Sala</label>
                                                <br/><input class="form-control" name="sala" id="sala" placeholder="Escriba el lugar de la reunión.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Catequistas</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="catequistas"
                                                            placeholder="Siga el formato de Ej." name="catequistas"
                                                            required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Animadores</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="animadores"
                                                            placeholder="Siga el formato de Ej." name="animadores"
                                                            required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="div_servidores" style="display: none">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Servidores</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="servidores"
                                                            placeholder="Siga el formato de Ej." name="servidores"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="div_asesores" style="display: none">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Asesores</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="asesores"
                                                            placeholder="Siga el formato de Ej." name="asesores"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="div_lideres" style="display: none">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Lideres</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="lideres"
                                                            placeholder="Siga el formato de Ej." name="lideres"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="div_responsables" style="display: none">
                                        <div class="form-group">
                                            <div class="form-line focused demo-tagsinput-area">
                                                <label>Responsables</label>
                                                <br/><small class="h2 small"
                                                            style="font-size: 12px;margin-top: 5px;line-height: 15px;color: #999;">Ingrese
                                                    cedula y nombre completo Ej:123456-Juan perez medina Presione Enter
                                                    para agregar otro.</small>
                                                <br/><input type="text" class="form-control" data-role="tagsinput"
                                                            id="responsables"
                                                            placeholder="Siga el formato de Ej." name="responsables"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LAS COMUNIDADES</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevas comunidades,</strong> Gestione la información de las pastorales
                    pertenecientes
                    a una parroquia.
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
            $(".chosen-select").chosen();
        })

        function getSubpastoral() {
            var pas = $("#pastoral_id").val();
            var text = $("#pastoral_id").find('option:selected').text();
            var text = text.split(' ');
            $("#asesores").tagsinput('removeAll');
            $("#responsables").tagsinput('removeAll');
            $("#servidores").tagsinput('removeAll');
            $("#lideres").tagsinput('removeAll');
            switch (text[1]) {
                case 'EMAUS':
                    $("#numero_label").text('Grupo');
                    $("#numero-in").attr('placeholder', 'Escriba el número del grupo');
                    $("#div_asesores").attr('style', 'display:none');
                    $("#div_responsables").attr('style', 'display:none');
                    $("#div_lideres").attr('style', 'display:none');
                    $("#div_servidores").attr('style', 'display:none');
                    break
                case 'RENOVACIÓN':
                    $("#numero_label").text('Koinonia');
                    $("#numero-in").attr('placeholder', 'Escriba el número de la koinonia');
                    $("#div_servidores").removeAttr('style', 'display');
                    $("#div_servidores").attr('required', 'required');
                    $("#div_asesores").attr('style', 'display:none');
                    $("#div_responsables").attr('style', 'display:none');
                    $("#div_lideres").attr('style', 'display:none');
                    break
                case 'INFANTIL':
                    $("#div_asesores").removeAttr('style', 'display');
                    $("#div_responsables").attr('style', 'display:none');
                    $("#div_responsables").attr('required', 'required');
                    $("#div_lideres").attr('style', 'display:none');
                    $("#div_servidores").attr('style', 'display:none');
                    break
                case 'MINISTERIO':
                    $("#div_lideres").removeAttr('style', 'display');
                    $("#div_lideres").attr('required', 'required');
                    $("#div_asesores").attr('style', 'display:none');
                    $("#div_responsables").attr('style', 'display:none');
                    $("#div_servidores").attr('style', 'display:none');
                    break
                case 'SACRAMENTAL':
                    $("#div_responsables").removeAttr('style', 'display');
                    $("#div_responsables").attr('required', 'required');
                    $("#div_asesores").attr('style', 'display:none');
                    $("#div_lideres").attr('style', 'display:none');
                    $("#div_servidores").attr('style', 'display:none');
                    break
                default:
                    $("#div_asesores").removeAttr('required');
                    $("#div_responsables").removeAttr('required');
                    $("#div_lideres").removeAttr('required');
                    $("#div_servidores").removeAttr('required');
                    $("#div_asesores").attr('style', 'display:none');
                    $("#div_responsables").attr('style', 'display:none');
                    $("#div_lideres").attr('style', 'display:none');
                    $("#div_servidores").attr('style', 'display:none');
                    break
            }
            $.ajax({
                type: 'GET',
                url: '{{url('pastoral/comunidad/get')}}/' + pas + '/subpastorales',
                data: {},
            }).done(function (msg) {
                $('#subpastoral_id option').each(function () {
                    $(this).remove();
                });
                if (msg !== "null") {
                    $("#subpastoral_id").removeAttr('disabled');
                    $("#subpastoral_id").attr('required', 'required');
                    var m = JSON.parse(msg);
                    $("#subpastoral_id").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#subpastoral_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    $("#subpastoral_id").removeAttr('required');
                    $("#subpastoral_id").attr('disabled', 'disabled');
                }
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
