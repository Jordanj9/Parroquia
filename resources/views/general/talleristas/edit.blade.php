@extends('layouts.admin')
@section('style')
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }

        table, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            width: 80px;
        }

        #label-button {
            color: white;
            position: absolute;
            height: 20px;
            width: 20px;
            top: 3px;
            right: -5px;
            border-radius: 50%;
            border: 1px solid #38A970;
            background-color: #38A970;
        }
    </style>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.general')}}">General</a></li>
        <li class="active"><a href="{{route('talleristas.index')}}">Talleristas</a></li>
        <li class="active"><a>Actualizar nuevo talleristas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        GENERAL - Talleristas
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
                    <h1 class="card-inside-title">DATOS DEL TALLERISTA</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="form-talleristas" method="PUT" action="">
                                @csrf
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">IDENTIFICACIÓN</label>
                                            <br/><input type="text" id="identificacion"  value="{{$tallerista->identificacion}}" class="form-control" placeholder="numero de identificación" name="identificacion" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">NOMBRES</label>
                                            <br/><input type="text" id="nombres" class="form-control" placeholder="Escriba el nombre completo del tallerista" name="nombres" value="{{$tallerista->nombres}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">FECHA DE NACIMIENTO</label>
                                            <br/><input type="date" class="form-control" placeholder="Escriba el nombre del programa de apoyo" name="fecha_de_nacimiento" value="{{$tallerista->fecha_de_nacimiento}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">CELULAR</label>
                                            <br/><input type="number" class="form-control" placeholder="Numero de contacto" name="celular" value="{{$tallerista->celular}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">CORREO INSTITUCIONAL</label>
                                            <br/><input type="email" class="form-control" placeholder="Correo institucional de contacto" name="correo_institucional" value="{{$tallerista->correo_institucional}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">CORREO PERSONAL</label>
                                            <br/><input type="email" class="form-control" placeholder="Correo personal de contacto" name="correo_personal" value="{{$tallerista->correo_personal}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">NUMERO DE HORAS DISPONIBLES SEMANALES</label>
                                            <br/><input type="number" min="0" max="40" class="form-control" placeholder="Correo personal de contacto" name="numero_horas_semanales" value="{{$tallerista->numero_horas_semanales}}" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">TIPO DE TALLERISTA</label>
                                            <br/>
                                            <select class="form-control" name="tipo" id="">
                                                <option value="PROFESIONAL" selected = {{$tallerista->tipo == 'PROFESIONAL' ? "true":"false"}}>PROFESIONAL</option>
                                                <option value="PRACTICANTE" selected = {{$tallerista->tipo == 'PRACTICANTE' ? "true":"false"}}>PRACTICANTE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table>
                                        <thead>
                                        <tr style="background-color: #38A970; color: white;">
                                            <td>HORAS</td>
                                            <td>LUNES</td>
                                            <td>MARTES</td>
                                            <td>MIERCOLES</td>
                                            <td>JUEVES</td>
                                            <td>VIERNES</td>
                                            <td>SABADOS</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $cont1 = $cont2 = 0; ?>
                                        @foreach($horas as $hora)
                                            <tr>
                                                <?php $cont1 = $cont1 + 1; $cont2 = 0;?>
                                                @foreach($horarios as $item)
                                                    <?php $cont2 = $cont2 + 1; ?>
                                                    @if($cont2 == 1)
                                                        <td>{{$hora}}</td>
                                                    @else
                                                        <td data-dia="{{$item}}" data-hora="{{explode(':',$hora)[0]}}"
                                                            id="{{$item.explode(':',$hora)[0]}}"
                                                            onclick="guardar_etiqueta(this)"></td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('talleristas.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                        <button class="btn bg-green waves-effect" onclick="guardar(event)">Guardar</button>
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
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS TALLERISTAS</h4>
                </div>
                <div class="modal-body">
                    <strong>Agregue nuevos talleristas,</strong> Gestione los diferentes talleristas del sistema.
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
        var horarios = [];
        var item;
        var pos;

        window.onload = function () {
            $.ajax({
                type: 'GET',
                url: '{{url('general/talleristas')}}/'+'{{$tallerista->id}}'+'/disponibilidad',
            }).done(function (msg) {
                if(msg.status == 'ok'){
                  let disponibilidad  = msg.disponibilidad;
                  disponibilidad.forEach((item)=>{
                      $('#'+item.dia+item.hora).attr('style', 'background-color: teal');
                      horarios.push({
                          'id': item.dia+item.hora,
                          'dia': item.dia,
                          'hora': item.hora,
                      });
                  });
                }
            });
        }

        function guardar_etiqueta(id) {
            let td = id;
            item = td.getAttribute('id');
            if (td.getAttribute('style') == null) {
                $("#" + td.getAttribute('id')).attr('style', 'background-color: teal');
                $("#" + td.getAttribute('id')).attr('value', '1');
                horarios.push({
                    'id': td.getAttribute('id'),
                    'dia': td.getAttribute('data-dia'),
                    'hora': td.getAttribute('data-hora'),
                });
            } else {
                $("#" + td.getAttribute('id')).removeAttr('style');
                horarios.forEach(getIndex);
                horarios.splice(pos, 1);
            }
        }

        function getIndex(element, index, array) {
            if (element.id == item) {
                pos = index;
            }
        }

        function guardar(event) {
            event.preventDefault();
            $.ajax({
                type: 'PUT',
                url: '{{route('talleristas.update',$tallerista->id)}}',
                data:
                    {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'form': $('#form-talleristas').serialize(),
                        'disponibilidad': horarios
                    }
            }).done(function (msg) {
                if (msg.status  ==  'ok') {
                    notify('Atención', 'El tallerista.' + $("#identificacion").val() + ' - ' + $("#nombres").val() + ' fue actualizado con exito.!', 'success');
                }else if(msg.status == 'error'){
                    notify('Atención', 'El tallerista.' + $("#identificacion").val() + ' - ' + $("#nombres").val() + ' no pudo ser alamacenada.', 'error');
                }else {
                    let html = '';
                    for(const prop in msg.message){
                        html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                    }
                    notify('Error', html);
                }
            });
        }

    </script>
@endsection
