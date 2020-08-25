@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('admin.academico')}}">Academico</a></li>
    <li class="active"><a href="">Niveles de riesgo</a></li>
</ol>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <center><p class="font-bold col-teal font-20">ESTUDIANTES CLASIFICADOS POR NIVEL DE RIESGO VS PERIODOS ACADÉMICOS</p></center>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabla_Informes">
                        <thead>
                        <tr class="bg-green">
                            <th>Periodo</th>
                            @foreach($riesgos as $riesgo)
                                <th>{{$riesgo->descripcion}}</th>
                            @endforeach
                            <th>Total General</th>
                        </tr>
                        </thead>
                        <tbody>
                         @foreach($nivelesDeRiesgoPorPeriodo as $periodo)
                             <tr>
                                 <td>{{$periodo['periodo']}}</td>
                                 @foreach($periodo['riesgos'] as $riesgo)
                                     <td><center>{{$riesgo['count']}}</center></td>
                                 @endforeach
                                 <td>{{$periodo['total']}}</td>
                             </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <center><p class="font-bold col-teal font-20">ESTUDIANTES CLASIFICADOS POR NIVEL DE RIESGO VS PROGRAMAS ACADÉMICOS</p></center>
            </div>
            <div class="body">
                <p>Utilice las siguientes opciones para filtrar su búsqueda.</p>
                <form action="{{route('reportes.niveles')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <b>Periodo</b>
                                <div class="input-group">
                                    <select name="periodo" id="" class="form-control selectpicker show-tick">
                                        <option value="">Selecione...</option>
                                        @foreach($periodos as $periodo)
                                            <option value="{{$periodo->id}}">{{$periodo->anio}}-{{$periodo->periodo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn  btn-block btn-success "><i class="material-icons">search</i><span>Filtrar</span></button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabla_Informes2">
                        <thead>
                        <tr class="bg-green">
                            <th>PROGRAMA</th>
                            @foreach($riesgos as $riesgo)
                                <th>{{$riesgo->descripcion}}</th>
                            @endforeach
                            <th>Total General</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nivelesDeRiesgoPorPrograma as $programa)
                            <tr>
                                <td>{{$programa['programa']}}</td>
                                @foreach($programa['riesgos'] as $riesgo)
                                    <td><center>{{$riesgo['count']}}</center></td>
                                @endforeach
                                <td>{{$programa['total']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Tablas-->
    <script src="{{asset('js/plugins_Tables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/plugins_Tables/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/plugins_Tables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/plugins_Tables/jszip.min.js')}}"></script>
    <script src="{{asset('js/plugins_Tables/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/plugins_Tables/vfs_fonts.js')}}"></script>
    <script>
        //Exportable table
        $(document).ready(function() {
            DataTabel('#tabla_Informes');
            DataTabel('#tabla_Informes2');
        } );

        function DataTabel($id) {
            $($id).DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    {
                        extend:     'excelHtml5',
                        text:       '<i class="material-icons">file_copy</i>',
                        titleAttr:  'Exportar a Excel',
                        className:  'btn btn-success waves-effect'

                    },
                    {
                        extend:     'pdfHtml5',
                        text:       '<i class="material-icons">picture_as_pdf</i>',
                        titleAttr:  'Exportar a PDF',
                        className:  'btn btn-danger waves-effect'

                    },
                    {
                        extend:     'print',
                        text:       '<i class="material-icons">print</i>',
                        titleAttr:  'Imprimir',
                        className:  'btn btn-info waves-effect'

                    },
                ]
            } );
        }
    </script>
@endsection('script')

