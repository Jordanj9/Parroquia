@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('empleado.index')}}">Empleados</a></li>
        <li class="active"><a>Crear</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADMINISTRACIÓN - EMPLEADOS
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
                    <h1 class="card-inside-title">DATOS DEL EMPLEADO</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('empleado.store')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Cargo</label>
                                                <br/><select class="form-control show-tick" name="cargo" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                        <option value="PÁRROCO">PÁRROCO</option>
                                                        <option value="VICARIO">VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA">SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO">EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS">OFICIOS VARIOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Tipo de Documento</label>
                                                <br/><select class="form-control show-tick" name="tipo_documento" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                        <option value="CC">CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS">PASAPORTE</option>
                                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                                        <option value="RC">REGISTRO CIVIL</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Identificación</label>
                                                <br/><input type="text" maxlength="20" class="form-control" name="identificacion" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Nombres</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Escriba los nombres del empleado" name="nombres" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Apellidos</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Escriba los apellidos del empleado" name="apellidos" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sexo</label>
                                                <br/><br/><div class="demo-radio-button">
                                                    <input name="sexo" type="radio" id="masculino" class="with-gap" value="MASCULINO"/>
                                                    <label for="masculino">Masculino</label>
                                                    <input name="sexo" type="radio" id="femenino" class="with-gap" value="FEMENINO"/>
                                                    <label for="femenino">Femenino</label>
                                                    <input name="sexo" type="radio" id="otro" class="with-gap" value="OTRO"/>
                                                    <label for="otro">Otro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Dirección</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Dirección de residencia"
                                                                 name="direccion" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Barrio</label>
                                                <br/><br/><input type="text" class="form-control" placeholder="Barrio (Opcional)"
                                                                 name="barrio"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Telefono</label>
                                                <br/><br/><input type="number" class="form-control" placeholder="Telefono (Opcional)"
                                                                 name="telefono"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Celular</label>
                                                <br/><br/><input type="number" class="form-control" placeholder="Celular (Opcional)"
                                                                 name="celular"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Email</label>
                                                <br/><br/><input type="email" class="form-control" placeholder="Correo electronico (Opcional)"
                                                                 name="correo"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Administración</label>
                                                <br/><br/><select class="form-control show-tick" name="administracion_id" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($admins as $key=>$value)
                                                        <option value="{{$key}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('empleado.index')}}" class="btn bg-red waves-effect" style="margin-bottom: 10px">Cancelar</a>
                                            <button class="btn bg-indigo waves-effect" style="margin-bottom: 10px" type="reset">Limpiar Formulario
                                            </button>
                                            <button class="btn bg-green waves-effect" style="margin-bottom: 10px" type="submit">Guardar</button>
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
                        <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS EMPLEADOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevos empleados,</strong> Gestione la información de los empleados.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
