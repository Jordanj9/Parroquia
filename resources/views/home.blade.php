@extends('layouts.admin')
@section('style')
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/css/main.min.css')}}">

    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="alert bg-blue-grey alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Bienvenid@ <strong>{{Auth::user()->nombres . ' ' . Auth::user()->apellidos}}</strong> al Sitio Oficial de la Parroquia Nuestra Señora Del Rosario. Feliz Día, El Señor te Bendiga en Abundancia!
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-zoom-effect hover-expand-effect">
                    <div class="icon">
                        <a href="{{route('usuario.vistacontrasenia')}}"><i class="material-icons">vpn_key</i></a>
                    </div>
                    <div class="content">
                        <div class="text">CAMBIAR</div>
                        <div class="number">CONTRASEÑA</div>
                    </div>
                </div>
            </div>
            @if(session()->exists('MOD_USUARIOS'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-brown hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <a href="{{route('admin.usuarios')}}"><i class="material-icons">person</i></a>
                        </div>
                        <div class="content">
                            <div class="text">ADMINISTRACIÓN DE</div>
                            <div class="number">USUARIOS</div>
                        </div>
                    </div>
                </div>
            @endif
                @if(session()->exists('MOD_GENERAL'))
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-deep-orange hover-zoom-effect hover-expand-effect">
                            <div class="icon">
                                <a href="{{route('admin.general')}}"><i class="material-icons">settings</i></a>
                            </div>
                            <div class="content">
                                <div class="text">ADMINISTRACIÓN</div>
                                <div class="number">GENERAL</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(session()->exists('MOD_PASTORAL'))
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal hover-zoom-effect hover-expand-effect">
                            <div class="icon">
                                <a href="{{route('admin.pastoral')}}"><i class="material-icons">description</i></a>
                            </div>
                            <div class="content">
                                <div class="text">ADMINISTRACIÓN</div>
                                <div class="number">PASTORAL</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(session()->exists('MOD_ADMINISTRACION'))
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box bg-indigo hover-zoom-effect hover-expand-effect">
                            <div class="icon">
                                <a href="{{route('admin.administracion')}}"><i class="material-icons">layers</i></a>
                            </div>
                            <div class="content">
                                <div class="text">GESTIÓN DE LA</div>
                                <div class="number">ADMINISTRACIÓN</div>
                            </div>
                        </div>
                    </div>
                @endif
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-zoom-effect hover-expand-effect">
                    <div class="icon">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="content">
                        <div class="text">SALIR</div>
                        <div class="number">DEL PANEL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="calendar"></div>

@endsection
@section('script')
    <script src="{{asset('plugins/fullcalendar/js/main.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('plugins/fullcalendar/js/locales-all.min.js')}}"></script>
   <script type="text/javascript">
        document.addEventListener('DOMContentLoaded',()=>{
           var calendarEl =  document.getElementById('calendar');
           var calendar =  new FullCalendar.Calendar(calendarEl,{
              locale:'es',
              themeSystem:'bootstrap',
              headerToolbar: {
                  left: 'prev,next,today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
              },
               eventClick: function(info){
                  let properties  = info.event.extendedProps;
                  div = `
                         <p><strong>Pastoral: </strong> ${ properties.pastoral}</p>
                         <p><strong>Responsable: </strong> ${properties.responsable}</p>
                         <p><strong>Lugar: </strong> ${properties.lugar}</p>
                         <p><strong>Fecha: </strong> ${ info.event.start}</p>
                        `;
                  Swal.fire({
                      title: info.event.title,
                      html:div,
                      showCloseButton: true,
                  })
              },
              height: 'auto',
              events: {
                  url: '{{route('evento.listar')}}',
              },
           });
           calendar.render();
        });
   </script>
@endsection
