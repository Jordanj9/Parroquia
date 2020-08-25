@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('js/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('admin.academico')}}">General</a></li>
    <li class="active"><a href="{{route('periodosacademicos.index')}}">Periodos Académicos</a></li>
    <li class="active"><a>Nuevo Periodo Académico</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    ACADEMICO - PERIODOS ACADÉMICOS
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
                <h1 class="card-inside-title">DATOS DEL PERIODO ACADÉMICO</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('periodosacademicos.store')}}">
                            @csrf
                            <div class="col-md-6 col-xs-12">
                                <h2 class="card-inside-title">AÑO</h2>
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" name="anio" required class="form-control" placeholder="Año del periodo academico...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <h2 class="card-inside-title">SELECCIONÉ EL PERÍODO ACADÉMICO</h2>
                                    <div class="form-line">
                                        <select class="form-control show-tick " autocomplete="false" name="periodo" placeholder="Seleccione los Módulos a los que el Grupo Tendrá Acceso" required="" >
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <h2 class="card-inside-title">PERÍODO ACADÉMICO</h2>
                                <div class="input-daterange input-group range bs_datepicker_range_container">
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_inicio" class="form-control" placeholder="Inicio...">
                                    </div>
                                    <span class="input-group-addon">to</span>
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_fin" class="form-control" placeholder="Fin...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <h2 class="card-inside-title">PERÍODO DE CLASE</h2>
                                <div class="input-daterange input-group range bs_datepicker_range_container">
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_inicioclase" class="form-control" placeholder="Inicio de semestre...">
                                    </div>
                                    <span class="input-group-addon">to</span>
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_finclase" class="form-control" placeholder="Fin de semestre...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <h2 class="card-inside-title">PRIMER CORTE</h2>
                                <div class="input-daterange input-group range bs_datepicker_range_container">
                                    <div class="form-line">
                                        <input type="text" required name="fecha_inicio_primer_corte" autocomplete="false" class="form-control" placeholder="Fecha de inicio...">
                                    </div>
                                    <span class="input-group-addon">to</span>
                                    <div class="form-line">
                                        <input type="text" required  name="fecha_fin_primer_corte" autocomplete="false" class="form-control" placeholder="Fecha final...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <h2 class="card-inside-title">SEGUNDO CORTE</h2>
                                <div class="input-daterange input-group range bs_datepicker_range_container">
                                    <div class="form-line">
                                        <input type="text" required name="fecha_inicio_segundo_corte" autocomplete="false" class="form-control" placeholder="Fecha de inicio...">
                                    </div>
                                    <span class="input-group-addon">to</span>
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_fin_segundo_corte" class="form-control" placeholder="Fecha final...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <h2 class="card-inside-title">TERCER CORTE</h2>
                                <div class="input-daterange input-group range bs_datepicker_range_container">
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_inicio_tercer_corte" class="form-control" placeholder="Fecha de inicio...">
                                    </div>
                                    <span class="input-group-addon">to</span>
                                    <div class="form-line">
                                        <input type="text" autocomplete="false" required name="fecha_fin_tercer_corte" class="form-control" placeholder="Fecha final...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <h2 class="card-inside-title">SELECCIONÉ EL ESTADO</h2>
                                    <div class="form-line">
                                        <select class="form-control show-tick "  name="estado" required="" >
                                            <option value="activo">ACTIVO</option>
                                            <option value="inactivo">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br/><br/><a href="{{route('periodosacademicos.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Guardar</button>
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
                <strong>Agregue nuevos programas de apoyo,</strong> Gestione los diferentes programas de apoyo para los estudiantes.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded',function () {
            $('.bs_datepicker_range_container').datepicker({
                format: 'yy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
