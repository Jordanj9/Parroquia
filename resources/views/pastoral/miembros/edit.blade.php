@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.pastoral')}}">Pastoral</a></li>
        <li class="active"><a href="{{route('pastorales.index')}}">Pastorales</a></li>
        <li class="active"><a>Editar</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        PASTORAL - PASTORALES
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
                    <h1 class="card-inside-title">EDITAR DATOS DE LA PASTORAL: {{$pastoral->nombre}}</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST"
                                  action="{{route('pastorales.update',$pastoral->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Parroquia</label>
                                                <br/><select class="form-control show-tick" name="parroquia_id"
                                                             required>
                                                    @foreach($parroquias as $key=>$value)
                                                        @if($pastoral->parroquia_id == $key)
                                                            <option value="{{$key}}" selected>{{$value}}</option>
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
                                                <label>Nombre</label>
                                                <br/><br/><input type="text" class="form-control"
                                                            placeholder="Escriba el nombre de la pastoral"
                                                            name="nombre" value="{{$pastoral->nombre}}" disabled required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Descripción</label>
                                                <br/><textarea type="text" class="form-control"
                                                               placeholder="Descripción de la pastoral (Opcional)"
                                                               name="descripcion" maxlength="250"
                                                               rows="2">{{$pastoral->descripcion}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br/><br/><a href="{{route('pastorales.index')}}"
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
@endsection
