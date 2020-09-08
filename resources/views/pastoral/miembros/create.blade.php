@extends('layouts.admin')
@section('style')
    <!-- Sweet Alert Css -->
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet"/>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('miembro.index')}}">Miembros</a></li>
        <li class="active"><a>Crear</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL - MIEMBROS
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
                    <h1 class="card-inside-title">DATOS DEL MIEMBRO</h1>
                    <small><strong>Todos los campos con <i style="color: red">*</i> son requeridos.</strong></small>
                    <br/><br/>
                    <form id="wizard_with_validation" method="POST" action="{{route('miembro.store')}}">
                        @csrf
                        <h3>Información personal</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Tipo de documento <i style="color: red">*</i></label>
                                        <br/><select class="form-control show-tick" name="tipo_documento"
                                                     id="tipo_documento" required>
                                            <option value="">--Seleccione una opción--</option>
                                            <option value="CC">CEDULA DE CIUDADANÍA</option>
                                            <option value="CE">CEDULA DE EXTRANJERÍA</option>
                                            <option value="PS">PASAPORTE</option>
                                            <option value="TI">TARJETA DE IDENTIDAD</option>
                                            <option value="RC">REGISTRO CIVIL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Identificación <i style="color: red">*</i></label>
                                        <br/><input type="text" maxlength="20" class="form-control"
                                                    name="identificacion" id="identificacion"
                                                    placeholder="Numero de documento" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Nombres <i style="color: red">*</i></label>
                                        <br/><input type="text" maxlength="80" class="form-control"
                                                    name="nombres" id="nombres"
                                                    placeholder="Nombres de la persona" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Apellidos <i style="color: red">*</i></label>
                                        <br/><input type="text" maxlength="80" class="form-control"
                                                    name="apellidos" placeholder="Apellidos de la persona"
                                                    id="apellidos" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-6">
                                    <label>Sexo <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="sexo" type="radio" id="masculino" class="with-gap"
                                               value="MASCULINO"/>
                                        <label style="min-width: 90px" for="masculino">Masculino</label>
                                        <input name="sexo" type="radio" id="femenino" class="with-gap"
                                               value="FEMENINO"/>
                                        <label style="min-width: 90px" for="femenino">Femenino</label>
                                        <input name="sexo" type="radio" id="otro" class="with-gap"
                                               value="OTRO"/>
                                        <label style="min-width: 60px" for="otro">Otro</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-line">
                                        <label>Fecha de nacimiento</label>
                                        <br/><input type="date" class="form-control" name="fechanacimiento"
                                                    id="fechanacimiento">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Dirección <i style="color: red">*</i></label>
                                        <input type="text" maxlength="100" class="form-control"
                                               placeholder="Dirección de residencia" name="direccion"
                                               id="direccion" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Barrio <i style="color: red">*</i></label>
                                        <input type="text" maxlength="80" class="form-control"
                                               placeholder="Barrio de residencia" name="barrio" id="barrio"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Correo</label>
                                        <input type="email" maxlength="150" class="form-control"
                                               placeholder="Correo electronico" name="correo" id="correo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-line">
                                        <label>Celular</label>
                                        <input type="number" class="form-control"
                                               placeholder="Número de celular" name="celular" id="celular">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Telefono</label>
                                        <input type="number" class="form-control" placeholder="Número fijo"
                                               name="telefono" id="telefono">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Trabaja</label>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="trabaja" id="trabaja">
                                        <label for="trabaja"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-line">
                                        <label>Empresa</label>
                                        <input type="text" class="form-control" placeholder="Empresa donde labora"
                                               name="empresa" id="empresa">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-12">
                                    <label>Ocupación</label>
                                    <select data-placeholder="Seleccione la ocupacion" class="chosen-select"
                                            tabindex="-1" name="ocupacion" id="ocupacion">
                                        <option value="">--seleccione una opción--</option>
                                        @foreach($ocupaciones as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <h3>Información Religiosa</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="col-md-12">
                                    <label>Realidades donde colabora</label>
                                    <select class="form-control chosen-select" name="realidades[]"
                                            placeholder="Seleccione las pastorales donde colabora"
                                            id="realidades" multiple>
                                        @foreach($realidades as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-12">
                                    <label>Comunidades a las que a pertenecido</label>
                                    <select class="form-control chosen-select" name="comunidades[]"
                                            placeholder="Seleccione las pastorales donde colabora"
                                            id="comunidades" multiple>
                                        @foreach($comunidades as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="col-md-12">
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <label>Sacramentos</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="material-icons">verified_user</i></span>
                                                <div class="form-line"><select class="form-control show-tick"
                                                                               name="situacionesp[]" id="situacionesp">
                                                        <option value="">--seleccione una opción--</option>
                                                        @foreach($sacramentos as $key=>$value)
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endforeach
                                                    </select></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group" style="margin-top: 25px">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="lugar[]" id="lugar">
                                                </div>
                                                <span class="input-group-addon">
                                                <a
                                                    class="btn bg-light-blue btn-circle btn-xs waves-effect waves-circle waves-float"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Agregar Sacramento" onclick="agregar()">
                                                    <i class="material-icons" style="margin-top: 10px">library_add</i>
                                                </a>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Sacramento</th>
                                                    <th>Lugar</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tb2">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h3>Finish</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Pastoral <i style="color: red">*</i></label>
                                        <select class="form-control show-tick" name="pastoral_id" id="pastoral_id"
                                                onchange="getSubpastoral()" required>
                                            <option value="">--seleccione una opción--</option>
                                            @foreach($realidades as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Subpastoral <i style="color: red">*</i></label>
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
                            <div class="form-group form-float infantil" style="display: none">
                                <div class="col-md-4" id="div_categoria" style="display: none">
                                    <label>Categoria <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="categoria" type="radio" id="verde" class="with-gap"
                                               value="TRIGO VERDE"/>
                                        <label style="min-width: 90px" for="verde">Trigo Verde</label>
                                        <input name="categoria" type="radio" id="maduro" class="with-gap"
                                               value="TRIGO MADURO"/>
                                        <label style="min-width: 90px" for="maduro">Trigo Maduro</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Representante</label>
                                        <input type="text" class="form-control"
                                               placeholder="Representante o acudiente del menor" name="representante"
                                               id="representante">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Con quien vive</label>
                                        <select class="form-control" name="vivecon" id="vivecon">
                                            <option value="">--Seleccione una Opción--</option>
                                            <option value="PAPA">PAPA</option>
                                            <option value="MAMA">MAMA</option>
                                            <option value="ABUELOS">ABUELOS</option>
                                            <option value="FAMILIARES">FAMILIARES</option>
                                            <option value="PADRES">PADRES</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Colegio</label>
                                        <input type="text" class="form-control"
                                               placeholder="Colegio donde estudia el menor"
                                               name="colegio" id="colegio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Grado</label>
                                        <input type="number" class="form-control" placeholder="Grado que cursael menor"
                                               name="grado" id="grado">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-line">
                                        <label>Numero de Hermanos</label>
                                        <input type="number" class="form-control" placeholder="Número total de hermanos"
                                               name="num_hermanos" id="num_hermanos">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float vocacional" style="display: none">
                                <div class="col-md-4" id="div_aporte">
                                    <div class="form-line">
                                        <label>Aporte mensual</label>
                                        <input type="number" class="form-control" name="aporte_mensual"
                                               id="aporte_mensual" placeholder="Ingrese el valor del aporte">
                                    </div>
                                </div>
                                <div class="col-md-8" id="div_aporte-para">
                                    <label>Aporte para</label>
                                    <div class="demo-radio-button">
                                        <input name="aporte_para" type="radio" id="seminario" class="with-gap"
                                               value="SEMINARIO"/>
                                        <label style="min-width: 90px" for="seminario">Seminario</label>
                                        <input name="aporte_para" type="radio" id="catedral" class="with-gap"
                                               value="CATEDRAL"/>
                                        <label style="min-width: 90px" for="catedral">Catedral</label>
                                        <input name="aporte_para" type="radio" id="parroquia" class="with-gap"
                                               value="PARROQUIA"/>
                                        <label style="min-width: 60px" for="parroquia">Parroquia</label>
                                        <input name="aporte_para" type="radio" id="otroa" class="with-gap"
                                               value="OTRO"/>
                                        <label style="min-width: 90px" for="otroa">Otro</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float salud" style="display: none">
                                <div class="col-md-2">
                                    <label>Con quien vive <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="conquienvive" type="radio" id="familia" class="with-gap"
                                               value="FAMILIA"/>
                                        <label style="min-width: 90px" for="familia">Familia</label>
                                        <input name="conquienvive" type="radio" id="amigos" class="with-gap"
                                               value="AMIGOS"/>
                                        <label style="min-width: 90px" for="amigos">Amigos</label>
                                        <input name="conquienvive" type="radio" id="solo" class="with-gap"
                                               value="SOLO"/>
                                        <label style="min-width: 60px" for="solo">Solo</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Habitación <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="habitacion" type="radio" id="propia" class="with-gap"
                                               value="PROPIA"/>
                                        <label style="min-width: 90px" for="propia">Propia</label>
                                        <input name="habitacion" type="radio" id="arriendo" class="with-gap"
                                               value="ARRIENDO"/>
                                        <label style="min-width: 90px" for="arriendo">Arriendo</label>
                                        <input name="habitacion" type="radio" id="dada" class="with-gap"
                                               value="DADA A CUIDAR"/>
                                        <label style="min-width: 60px" for="dada">Dada a Cuidar</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Entorno Material <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="entorno_material" type="radio" id="material" class="with-gap"
                                               value="MATERIAL"/>
                                        <label style="min-width: 90px" for="material">De Material</label>
                                        <input name="entorno_material" type="radio" id="barro" class="with-gap"
                                               value="BARRO"/>
                                        <label style="min-width: 90px" for="barro">Barro</label>
                                        <input name="entorno_material" type="radio" id="notiene" class="with-gap"
                                               value="NO TIENE CASA"/>
                                        <label style="min-width: 60px" for="notiene">No Tiene Casa</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Servicios Publicos <i style="color: red">*</i></label>
                                    <div class="demo-checkbox">
                                        <input name="acueducto" type="checkbox" id="acueducto" class="filled-in"/>
                                        <label style="min-width: 90px" for="acueducto">Acueducto</label>
                                        <input name="alcantarillado" type="checkbox" id="alcantarillado"
                                               class="filled-in"/>
                                        <label style="min-width: 90px" for="alcantarillado">Alcantarillado</label>
                                        <input name="luz" type="checkbox" id="luz" class="filled-in"/>
                                        <label style="min-width: 90px" for="luz">Luz</label>
                                        <input name="luz" type="checkbox" id="gas" class="filled-in"/>
                                        <label style="min-width: 90px" for="gas">Gas</label>
                                        <input name="tel" type="checkbox" id="tel" class="filled-in"/>
                                        <label style="min-width: 90px" for="tel">Telefono</label>
                                        <input name="sanitario" type="checkbox" id="sanitario" class="filled-in"/>
                                        <label style="min-width: 90px" for="sanitario">Sanitario</label>
                                        <input name="letrina" type="checkbox" id="letrina" class="filled-in"/>
                                        <label style="min-width: 90px" for="letrina">Letrina</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Estado Anímico <i style="color: red">*</i></label>
                                    <div class="demo-radio-button">
                                        <input name="estado_animico" type="radio" id="alegre" class="with-gap"
                                               value="ALEGRE"/>
                                        <label style="min-width: 90px" for="alegre">Alegre</label>
                                        <input name="estado_animico" type="radio" id="optimista" class="with-gap"
                                               value="OPTIMISTA"/>
                                        <label style="min-width: 90px" for="optimista">Optimista</label>
                                        <input name="estado_animico" type="radio" id="decaido" class="with-gap"
                                               value="DECAÍDO"/>
                                        <label style="min-width: 60px" for="decaido">Decaído</label>
                                        <input name="estado_animico" type="radio" id="triste" class="with-gap"
                                               value="TRISTE"/>
                                        <label style="min-width: 90px" for="triste">Triste</label>
                                        <input name="estado_animico" type="radio" id="decepcionado" class="with-gap"
                                               value="DECEPCIONADO"/>
                                        <label style="min-width: 60px" for="decepcionado">Decepcionado</label>
                                        <input name="estado_animico" type="radio" id="pesimista" class="with-gap"
                                               value="PESIMISTA"/>
                                        <label style="min-width: 90px" for="pesimista">Pesimista</label>
                                        <input name="estado_animico" type="radio" id="otroe" class="with-gap"
                                               value="OTRO"/>
                                        <label style="min-width: 60px" for="otroe">Otro</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float salud" style="display: none">
                                <div class="col-md-6">
                                    <label>Situación Espiritual <i style="color: red">*</i></label>
                                    <select class="form-control chosen-select" name="situaciones[]" id="situaciones"
                                            multiple>
                                        @foreach($situaciones as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-line">
                                        <label>Fecha del Censo <i style="color: red">*</i></label>
                                        <input type="date" class="form-control" name="fecha_cesnso_salud"
                                               id="fecha_censo_salud">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <label>Antecedentes</label>
                                        <textarea type="text" class="form-control"
                                                  placeholder="Breve reseña del estado de salud (Opcional)"
                                                  name="antecedentes" id="antecedentes" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS MIEMBROS</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevos miembros,</strong> Gestione la información de los miembros pertenecientes a
                    las diferentes comunidades.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('css/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen();
        });

        var situacionest = [];
        var item;
        var pos = false;

        function getSubpastoral() {
            var pas = $("#pastoral_id").val();
            var text = $("#pastoral_id").find('option:selected').text();
            var text = text.split(' ');
            limpiar();
            switch (text[1]) {
                case 'EMAUS':
                    $(".infantil").attr('style', 'display:none');
                    $(".vocacional").attr('style', 'display:none');
                    $(".salud").attr('style', 'display:none');
                    saludrequerido(false);
                    vocacionalrequerido(false);
                    infantilrequerido(false);
                    $("#numero_label").text('Grupo');
                    break
                case 'RENOVACIÓN':
                    $(".infantil").attr('style', 'display:none');
                    $(".vocacional").attr('style', 'display:none');
                    $(".salud").attr('style', 'display:none');
                    saludrequerido(false);
                    vocacionalrequerido(false);
                    infantilrequerido(false);
                    $("#numero_label").text('Koinonia');
                    break
                case 'INFANTIL':
                    $(".vocacional").attr('style', 'display:none');
                    $(".salud").attr('style', 'display:none');
                    $(".infantil").removeAttr('style', 'display');
                    infantilrequerido(true);
                    saludrequerido(false);
                    vocacionalrequerido(false);
                    break
                case 'VOCACIONAL':
                    $(".infantil").attr('style', 'display:none');
                    $(".salud").attr('style', 'display:none');
                    $(".vocacional").removeAttr('style', 'display');
                    vocacionalrequerido(true);
                    infantilrequerido(false);
                    saludrequerido(false);
                    break
                case 'SALUD':
                    $(".infantil").attr('style', 'display:none');
                    $(".vocacional").attr('style', 'display:none');
                    $(".salud").removeAttr('style', 'display');
                    saludrequerido(true);
                    vocacionalrequerido(false);
                    infantilrequerido(false);
                    break
                default:
                    $(".infantil").attr('style', 'display:none');
                    $(".vocacional").attr('style', 'display:none');
                    $(".salud").attr('style', 'display:none');
                    saludrequerido(false);
                    vocacionalrequerido(false);
                    infantilrequerido(false);
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
                $('#comunidad_id option').each(function () {
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
                    getComunidades(pas, 'PASTORAL');
                }
            });

        }

        function infantilrequerido(bandera) {
            if (bandera) {
                $("#verde").attr('checked');
                $("#representante").attr('required');
                $("#vivecon").attr('required');
            } else {
                $("#verde").removeAttr('checked');
                $("#representante").removeAttr('required');
                $("#vivecon").removeAttr('required');
            }
        }

        function vocacionalrequerido(bandera) {
            if (bandera) {
                $("#aporte_mensual").attr('required');
                $("#seminario").attr('checked');
            } else {
                $("#aporte_mensual").removeAttr('required');
                $("#seminario").removeAttr('checked');
            }
        }

        function saludrequerido(bandera) {
            if (bandera) {
                $("#familia").attr('checked');
                $("#arriendo").attr('checked');
                $("#material").attr('checked');
                $("#alegre").attr('checked');
                $("#situaciones").attr('required');
                $("#fecha_censo_salud").attr('required');
            } else {
                $("#familia").removeAttr('checked');
                $("#arriendo").removeAttr('checked');
                $("#material").removeAttr('checked');
                $("#alegre").removeAttr('checked');
                $("#situaciones").removeAttr('required')
                $("#fecha_censo_salud").removeAttr('required');
            }
        }

        function getComunidades(id, modelo) {
            if (modelo != 'PASTORAL') {
                var mod = 'SUBPASTORAL';
                var val = $("#subpastoral_id").val();
                var text = $("#subpastoral_id").find('option:selected').text();
                if (text == 'INFANCIA MISIONERA') {
                    $("#div_categoria").removeAttr('style', 'display');
                } else {
                    $("#div_categoria").attr('style', 'display:none');
                }
            } else {
                var mod = modelo;
                var val = id;
                $("#div_categoria").attr('style', 'display:none');
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
                    $("#comunidad_id").append("<option value=''>" + "--Seleccione una opción--" + "</option>");
                    $.each(m, function (index, item) {
                        $("#comunidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    });
                } else {
                    notify("Atención", "No hay comunidad para los parametros seleccionados por favor primero agregue la comunidad en " +
                        "<a href='{{route('comunidad.create')}}'>Crear Comunidad.</a>", "warning");
                }
            });

        }

        function limpiar() {
            $("#aporte_mensual").val("");
            $("#catedral").removeAttr('checked');
            $("#parroquia").removeAttr('checked');
            $("#seminario").removeAttr('checked');
            $("#otroa").removeAttr('checked');
            $("#verde").removeAttr('checked');
            $("#maduro").removeAttr('checked');
            $("#representante").val("");
            $("#colegio").val("");
            $("#grado").val("");
            $("#num_hermanos").val("");
            $("#vivecon").val("");
            $("#familia").removeAttr('checked');
            $("#amigos").removeAttr('checked');
            $("#solo").removeAttr('checked');
            $("#propia").removeAttr('checked');
            $("#arriendo").removeAttr('checked');
            $("#dada").removeAttr('checked');
            $("#material").removeAttr('checked');
            $("#barro").removeAttr('checked');
            $("#notiene").removeAttr('checked');
            $("#acueducto").removeAttr('checked');
            $("#luz").removeAttr('checked');
            $("#alcantarillado").removeAttr('checked');
            $("#telefono").removeAttr('checked');
            $("#sanitario").removeAttr('checked');
            $("#letrina").removeAttr('checked');
            $("#gas").removeAttr('checked');
            $("#optimista").removeAttr('checked');
            $("#pesimista").removeAttr('checked');
            $("#decaido").removeAttr('checked');
            $("#decepcionado").removeAttr('checked');
            $("#alegre").removeAttr('checked');
            $("#triste").removeAttr('checked');
            $("#otro").removeAttr('checked');
            $("#situaciones").val("");
            $("#fecha_censo_salud").val("");
            $("#antecedentes").val("");
        }

        function agregar() {
            if ($("#lugar").val().length <= 0 || $("#situacionesp").val() == '') {
                notify('Atención', 'Debe completar los dos campos para continuar.', 'warning');
            } else {
                item = $("#situacionesp").val();
                console.log([situacionest, item]);
                situacionest.forEach(getIndex);
                if (pos == true) {
                    notify('Atención', 'El sacramento seleccionado ya fue agregado.', 'warning');
                    pos = false;
                } else {
                    situacionest.push({
                        'situacion_id': $("#situacionesp").val(),
                        'lugar': $("#lugar").val()
                    });
                    var html = "";
                    var text = $("#situacionesp").find('option:selected').text();
                    html = html + "<tr><td>" + text + "</td>";
                    html = html + "<td>" + $("#lugar").val() + "</td></tr>";
                    html = html + $("#tb2").html();
                    $("#tb2").html(html);
                    $("#situacionesp").val("");
                    $("#lugar").val("");

                }
            }
        }

        function getIndex(element, index, array) {
            if (element.situacion_id == item) {
                pos = true;
            }
        }

        function categoria(id) {

        }
    </script>
@endsection
