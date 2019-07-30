<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Instituto Nacional de Formación Técnico Profesional">
        <meta name="author" content="Infotep">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Infotep</title>
        <!-- start: Css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/simple-line-icons.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/animate.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/jquery.steps.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/fullcalendar.min.css')}}"/>       
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/datatables.bootstrap.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/chosen_v1.7.0/chosen.css')}}"/>
        <link href="{{asset('plugins/pnotify/dist/pnotify.css')}}" rel="stylesheet">
        <link href="{{asset('plugins/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
        <link href="{{asset('plugins/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
        <!-- end: Css -->
        <link rel="shortcut icon" href="{{asset('img/logomi.png')}}">
    </head>
    <body id="mimin" class="dashboard">
        <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
            <div class="col-md-12 nav-wrapper">
                <div class="navbar-header" style="width:100%;">
                    <div class="opener-left-menu is-open">
                        <span class="top"></span>
                        <span class="middle"></span>
                        <span class="bottom"></span>
                    </div>
                    <a href="{{ route('login') }}" class="navbar-brand"> 
                        <b>INFOTEP</b>
                    </a>
                </div>
            </div>
        </nav>
        <!-- end: Header -->

        <div class="container-fluid mimin-wrapper">
            <!-- start:Left Menu -->
            <div id="left-menu">
                <div class="sub-left-menu scroll">
                    <ul class="nav nav-list">
                        <li class="time">
                            <h1 class="animated fadeInLeft">21:00</h1>
                            <p class="animated fadeInRight">Sat,October 1st 2029</p>
                        </li>
                        <li><div class="left-bg"></div></li>
                    </ul>
                </div>
            </div>
            <!-- end: Left Menu -->
            <!-- start: content -->
            <div id="content">
                <div class="col-md-12" style="padding-top: 20px;">
                    @include('flash::message')
                </div>
                <div class="col-md-12"  style="padding-top: 40px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>RESULTADOS DE LA INSCRIPCIÓN EN LÍNEA</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                {!! $rta !!}
                            </div>
                            <div class="col-md-12">
                                @if($requisitos!==null)
                                <h4>Tenga en cuenta que para formalizar la matrícula en caso de ser admitido, deberá entregar como documentos anexos la siguiente información:</h4>
                                <ul class="list-group">
                                    <li class="list-group-item active">Documentos Anexos</li>
                                    @foreach($requisitos as $r)
                                    <li class="list-group-item">{{$r['item']." ----> OBLIGATORIO: ".$r['ob']}}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h4>Proceso de inscripción éxitoso.</h4>
                                <p><b>Nota:</b> Proceda a imprimir el formulario de inscripción que debe ser anexado a los documentos requeridos para asentar la matrícula en caso de ser admitido en la institución.</p>
                            </div>
                            <div class="col-md-12">
                                <a href="{{route('imprimir',[$doc,$sp])}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Imprimir Formulario de Inscripción</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: content -->
        </div>
        <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
            <span class="fa fa-bars"></span>
        </button>
        <!-- end: Mobile -->
        <!-- start: Javascript -->
        <script src="{{ asset('js/jquery.min.js')}}"></script>
        <script src="{{ asset('js/jquery.ui.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/plugins/jquery.steps.min.js')}}"></script>
        <script src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('js/plugins/momentjs.min.js')}}"></script>
        <script src="{{ asset('js/plugins/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('js/plugins/jquery.datatables.min.js')}}"></script>
        <script src="{{asset('js/plugins/datatables.bootstrap.min.js')}}"></script>
        <script src="{{asset('plugins/chosen_v1.7.0/chosen.jquery.js')}}"></script>
        <script src="{{ asset('plugins/pnotify/dist/pnotify.js')}}"></script>
        <script src="{{ asset('plugins/pnotify/dist/pnotify.buttons.js')}}"></script>
        <script src="{{ asset('plugins/pnotify/dist/pnotify.nonblock.js')}}"></script>
        <script src="{{ asset('plugins/ckeditor/ckeditor.js')}}"></script>
        <!-- custom -->
        <script src="{{ asset('js/main.js')}}"></script>
        <script>
var url = "<?php echo config('app.url'); ?>";
$(document).ready(function () {

});
        </script>
        <!-- end: Javascript -->
    </body>
</html>

