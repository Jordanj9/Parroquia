@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.administracion')}}">Administración</a></li>
        <li class="active"><a href="{{route('empleado.index')}}">Empleados</a></li>
        <li class="active"><a>Editar</a></li>
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
                    <h1 class="card-inside-title">EDITAR DATOS DEL
                        EMPLEADO: {{$empleado->nombres." - ".$empleado->apellidos}}</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST"
                                  action="{{route('empleado.update',$empleado->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Cargo</label>
                                                <br/><select class="form-control show-tick" name="cargo" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @switch($empleado->cargo)
                                                        @case('PÁRROCO')
                                                        <option value="PÁRROCO" selected>PÁRROCO</option>
                                                        <option value="VICARIO">VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA">SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO">EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS">OFICIOS VARIOS</option>
                                                        @break
                                                        @case('VICARIO')
                                                        <option value="PÁRROCO">PÁRROCO</option>
                                                        <option value="VICARIO" selected>VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA">SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO">EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS">OFICIOS VARIOS</option>
                                                        @break
                                                        @case('SEMINARISTA')
                                                        <option value="PÁRROCO">PÁRROCO</option>
                                                        <option value="VICARIO">VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA" selected>SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO">EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS">OFICIOS VARIOS</option>
                                                        @break
                                                        @case('EMPLEADA DE SERVICIO')
                                                        <option value="PÁRROCO">PÁRROCO</option>
                                                        <option value="VICARIO">VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA">SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO" selected>EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS">OFICIOS VARIOS</option>
                                                        @break
                                                        @case('OFICIOS VARIOS')
                                                        <option value="PÁRROCO">PÁRROCO</option>
                                                        <option value="VICARIO">VICARIO</option>
                                                        <option value="DIÁCONO">DIÁCONO</option>
                                                        <option value="SEMINARISTA">SEMINARISTA</option>
                                                        <option value="EMPLEADA DE SERVICIO">EMPLEADA DE SERVICIO</option>
                                                        <option value="OFICIOS VARIOS" selected>OFICIOS VARIOS</option>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Tipo de Documento</label>
                                                <br/><select class="form-control show-tick" name="tipo_documento"required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @switch($empleado->tipo_documento)
                                                        @case('CC')
                                                        <option value="CC" selected>CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS">PASAPORTE</option>
                                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                                        <option value="RC">REGISTRO CIVIL</option>
                                                        @break
                                                        @case('CE')
                                                        <option value="CC">CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE" selected>CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS">PASAPORTE</option>
                                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                                        <option value="RC">REGISTRO CIVIL</option>
                                                        @break
                                                        @case('PS')
                                                        <option value="CC">CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS" selected>PASAPORTE</option>
                                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                                        <option value="RC">REGISTRO CIVIL</option>
                                                        @break
                                                        @case('TI')
                                                        <option value="CC">CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS">PASAPORTE</option>
                                                        <option value="TI" selected>TARJETA DE IDENTIDAD</option>
                                                        <option value="RC">REGISTRO CIVIL</option>
                                                        @break
                                                        @case('RC')
                                                        <option value="CC">CEDULA DE CIUDADANÍA</option>
                                                        <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                                        <option value="PS">PASAPORTE</option>
                                                        <option value="TI">TARJETA DE IDENTIDAD</option>
                                                        <option value="RC" selected>REGISTRO CIVIL</option>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Identificación</label>
                                                <br/><input type="text" maxlength="20" class="form-control"
                                                            name="identificacion" value="{{$empleado->identificacion}}"
                                                            required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Nombres</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Escriba los nombres del empleado"
                                                                 name="nombres" value="{{$empleado->nombres}}"
                                                                 required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Apellidos</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Escriba los apellidos del empleado"
                                                                 name="apellidos" value="{{$empleado->apellidos}}"
                                                                 required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <br/><br/>
                                            <div class="demo-radio-button">
                                                @switch($empleado->sexo)
                                                    @case('MASCULINO')
                                                    <input name="sexo" type="radio" id="masculino" class="with-gap" value="MASCULINO" checked/>
                                                    <label for="masculino">Masculino</label>
                                                    <input name="sexo" type="radio" id="femenino" class="with-gap" value="FEMENINO"/>
                                                    <label for="femenino">Femenino</label>
                                                    <input name="sexo" type="radio" id="otro" class="with-gap" value="OTRO"/>
                                                    <label for="otro">Otro</label>
                                                    @break
                                                    @case('FEMENINO')
                                                    <input name="sexo" type="radio" id="masculino" class="with-gap" value="MASCULINO"/>
                                                    <label for="masculino">Masculino</label>
                                                    <input name="sexo" type="radio" id="femenino" class="with-gap" value="FEMENINO" checked/>
                                                    <label for="femenino">Femenino</label>
                                                    <input name="sexo" type="radio" id="otro" class="with-gap" value="OTRO"/>
                                                    <label for="otro">Otro</label>
                                                    @break
                                                    @case('OTRO')
                                                    <input name="sexo" type="radio" id="masculino" class="with-gap" value="MASCULINO"/>
                                                    <label for="masculino">Masculino</label>
                                                    <input name="sexo" type="radio" id="femenino" class="with-gap" value="FEMENINO"/>
                                                    <label for="femenino">Femenino</label>
                                                    <input name="sexo" type="radio" id="otro" class="with-gap" value="OTRO" checked/>
                                                    <label for="otro">Otro</label>
                                                    @break
                                                    @default
                                                    @break
                                                @endswitch
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Dirección</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Dirección de residencia"
                                                                 name="direccion" value="{{$empleado->direccion}}"
                                                                 required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Barrio</label>
                                                <br/><br/><input type="text" class="form-control"
                                                                 placeholder="Barrio (Opcional)"
                                                                 value="{{$empleado->barrio}}" name="barrio"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Telefono</label>
                                                <br/><br/><input type="number" class="form-control"
                                                                 placeholder="Telefono (Opcional)"
                                                                 value="{{$empleado->telefono}}" name="telefono"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Celular</label>
                                                <br/><br/><input type="number" class="form-control"
                                                                 placeholder="Celular (Opcional)"
                                                                 value="{{$empleado->celular}}" name="celular"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Email</label>
                                                <br/><br/><input type="email" class="form-control"
                                                                 placeholder="Correo electronico (Opcional)"
                                                                 value="{{$empleado->correo}}" name="correo"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Administración</label>
                                                <br/><br/><select class="form-control show-tick"
                                                                  name="administracion_id" required>
                                                    <option value="">--Seleccione una opción--</option>
                                                    @foreach($admins as $key=>$value)
                                                        @if($empleado->administracion_id == $key)
                                                            <option value="{{$key}}"selected>{{$value}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Estado</label>
                                                <br/><select class="form-control show-tick" name="estado" required>
                                                    @if($empleado->estado == 'ACTIVO')
                                                        <option value="ACTIVO" selected>ACTIVO</option>
                                                        <option value="INACTIVO">INACTIVO</option>
                                                    @else
                                                        <option value="ACTIVO">ACTIVO</option>
                                                        <option value="INACTIVO" selected>INACTIVO</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('empleado.index')}}"
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS EMPLEADOS</h4>
                </div>
                <div class="modal-body">
                    <strong>Edite los datos del empleado seleccionado,</strong> Gestione la información de los empleados
                    de la parroquia.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
