<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Instituto Nacional de Formación Técnico Profesional">
        <meta name="author" content="Infotep">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>UPC</title>
        <!-- start: Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/simple-line-icons.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/animate.min.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/jquery.steps.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/fullcalendar.min.css')); ?>"/>       
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/datatables.bootstrap.min.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/chosen_v1.7.0/chosen.css')); ?>"/>
        <link href="<?php echo e(asset('plugins/pnotify/dist/pnotify.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/pnotify/dist/pnotify.buttons.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/pnotify/dist/pnotify.nonblock.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
        <!-- end: Css -->
        <link rel="shortcut icon" href="<?php echo e(asset('img/upclogo.png')); ?>">
        <style type="text/css">
            .preguntas{
                -webkit-box-shadow: 0 1px 0px rgba(0,0,0,0.12), 0 1px 1px rgba(0,0,0,0.24);
                -moz-box-shadow: 0 1px 0px rgba(0,0,0,0.12), 0 1px 1px rgba(0,0,0,0.24);
                -ms-box-shadow: 0 1px 0px rgba(0,0,0,0.12), 0 1px 1px rgba(0,0,0,0.24);
                -o-box-shadow: 0 1px 0px rgba(0,0,0,0.12), 0 1px 1px rgba(0,0,0,0.24);
                box-shadow: 0 1px 0px rgba(0,0,0,0.12), 0 1px 1px rgba(0,0,0,0.24);
                border:none; 
                margin-top: 15px; 
                padding: 5px;
                color: #000000;
                background-color: #ecf0f1;
            }

            .preguntas:hover{
                background-color: #008080;
                color: #FFFFFF;
            }
        </style>
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
                    <a href="<?php echo e(route('inicio')); ?>" class="navbar-brand"> 
                        <b>UPC</b>
                    </a>
                    <ul class="nav navbar-nav navbar-right user-nav">
                        <li class="user-name"><span><?php echo e(Auth::user()->nombres); ?> <?php echo e(Auth::user()->apellidos); ?> - <?php echo e(session('ROL')); ?></span></li>
                        <li class="dropdown avatar-dropdown">
                            <img src="<?php echo e(asset('img/avatar.jpg')); ?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                            <ul class="dropdown-menu user-dropdown">
                                <li class="more">
                                    <ul>
                                        <?php if(session()->exists('MOD_INICIO')): ?>
                                        <li><a href="<?php echo e(route('inicio')); ?>"><span class="fa fa-home"></span></a></li>
                                        <?php endif; ?>
                                        <li><a href="#"><span class="fa fa-user"></span></a></li>
                                        <li>
                                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"><span class="fa fa-power-off"></span></a>
                                            <form id="logout-form2" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                <?php echo e(csrf_field()); ?>

                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li ><a href="#" class="opener-right-menu"> </a></li>
                    </ul>
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
                        <li class="header" style="background: #ecf0f1; font-size: 16px; font-weight: 600; padding: 8px 16px;">MENÚ PRINCIPAL</li>
                        <?php if(session()->exists('MOD_INICIO')): ?>
                        <?php if($location=='inicio'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('inicio')); ?>"><span class="fa fa-home"></span> Inicio</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('inicio')); ?>"><span class="fa fa-home"></span> Inicio</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_USUARIOS')): ?>
                        <?php if($location=='usuarios'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.usuarios')); ?>"><span class="fa fa-user"></span> Usuarios</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.usuarios')); ?>"><span class="fa fa-user"></span> Usuarios</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ADMISIONES')): ?>
                        <?php if($location=='admisiones'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.admisiones')); ?>"><span class="fa fa-check-circle-o"></span> Admisiones</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.admisiones')); ?>"><span class="fa fa-check-circle-o"></span> Admisiones</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-ADMINISTRADOR')): ?>
                        <?php if($location=='academico'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academico')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academico')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_TESORERIA')): ?>
                        <?php if($location=='tesoreria'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.tesoreria')); ?>"><span class="fa fa-money"></span> Tesorería & Financiera</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.tesoreria')); ?>"><span class="fa fa-money"></span> Tesorería & Financiera</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_REPORTES')): ?>
                        <?php if($location=='reportes'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.reportes')); ?>"><span class="fa fa-list"></span> Reportes</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.reportes')); ?>"><span class="fa fa-list"></span> Reportes</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-ESTUDIANTE')): ?>
                        <?php if($location=='academico-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academicoestudiante')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academicoestudiante')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_MATRICULA-ESTUDIANTE')): ?>
                        <?php if($location=='matricula-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.matricula')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.matricula')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_FINANCIERA-ESTUDIANTE')): ?>
                        <?php if($location=='financiera-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.financiera')); ?>"><span class="fa fa-dollar"></span> Financiera</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.financiera')); ?>"><span class="fa fa-dollar"></span> Financiera</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL-ESTUDIANTE')): ?>
                        <?php if($location=='aula-virtual-est'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtualest')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtualest')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-DOCENTE')): ?>
                        <?php if($location=='academico-docente'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academicodocente')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academicodocente')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_MATRICULA-DOCENTE')): ?>
                        <?php if($location=='matricula-docente'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.matriculadocente')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.matriculadocente')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL')): ?>
                        <?php if($location=='menu-aulavirtual'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtual')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtual')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL-DOCENTE')): ?>
                        <?php if($location=='menu-aulavirtual-doc'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtualdoc')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtualdoc')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <!--                        <?php if(session()->exists('MOD_RESERVA-RECURSO')): ?>
                                                <?php if($location=='reserva-recurso'): ?>
                                                <li class="active ripple"><a href="<?php echo e(route('admin.reservarecurso')); ?>"><span class="fa fa-list-alt"></span> Reserva Recursos</a></li>
                                                <?php else: ?>
                                                <li class="ripple"><a href="<?php echo e(route('admin.reservarecurso')); ?>"><span class="fa fa-list-alt"></span> Reserva Recursos</a></li>
                                                <?php endif; ?>
                                                <?php endif; ?>-->
                        <?php if(session()->exists('MOD_EVALUACION-AUTO-HETERO')): ?>
                        <?php if($location=='menu-evaluacion-auto-hetero'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"><span class="fa fa-check-circle-o"></span> Evaluación Académica</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"><span class="fa fa-check-circle-o"></span> Evaluación Académica</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <li class="ripple">
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-formn').submit();"><span class="fa fa-sign-out"></span> Salir</a>
                            <form id="logout-formn" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end: Left Menu -->
            <!-- start: content -->
            <div id="content">
                <div class="col-md-12" style="padding-top: 20px;">
                    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <!-- end: content -->
        </div>
        <!-- start: Mobile -->
        <div id="mimin-mobile" class="reverse">
            <div class="mimin-mobile-menu-list">
                <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                    <ul class="nav nav-list">
                        <?php if(session()->exists('MOD_INICIO')): ?>
                        <?php if($location=='inicio'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('inicio')); ?>"><span class="fa fa-home"></span> Inicio</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('inicio')); ?>"><span class="fa fa-home"></span> Inicio</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_USUARIOS')): ?>
                        <?php if($location=='usuarios'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.usuarios')); ?>"><span class="fa fa-user"></span> Usuarios</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.usuarios')); ?>"><span class="fa fa-user"></span> Usuarios</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ADMISIONES')): ?>
                        <?php if($location=='admisiones'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.admisiones')); ?>"><span class="fa fa-check-circle-o"></span> Admisiones</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.admisiones')); ?>"><span class="fa fa-check-circle-o"></span> Admisiones</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-ADMINISTRADOR')): ?>
                        <?php if($location=='academico'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academico')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academico')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_TESORERIA')): ?>
                        <?php if($location=='tesoreria'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.tesoreria')); ?>"><span class="fa fa-money"></span> Tesorería & Financiera</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.tesoreria')); ?>"><span class="fa fa-money"></span> Tesorería & Financiera</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_REPORTES')): ?>
                        <?php if($location=='reportes'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.reportes')); ?>"><span class="fa fa-list"></span> Reportes</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.reportes')); ?>"><span class="fa fa-list"></span> Reportes</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-ESTUDIANTE')): ?>
                        <?php if($location=='academico-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academicoestudiante')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academicoestudiante')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_MATRICULA-ESTUDIANTE')): ?>
                        <?php if($location=='matricula-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.matricula')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.matricula')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_FINANCIERA-ESTUDIANTE')): ?>
                        <?php if($location=='financiera-estudiante'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.financiera')); ?>"><span class="fa fa-dollar"></span> Financiera</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.financiera')); ?>"><span class="fa fa-dollar"></span> Financiera</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL-ESTUDIANTE')): ?>
                        <?php if($location=='aula-virtual-est'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtualest')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtualest')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_ACADEMICO-DOCENTE')): ?>
                        <?php if($location=='academico-docente'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.academicodocente')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.academicodocente')); ?>"><span class="fa fa-book"></span> Académico</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_MATRICULA-DOCENTE')): ?>
                        <?php if($location=='matricula-docente'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.matriculadocente')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.matriculadocente')); ?>"><span class="fa fa-check-circle-o"></span> Matrícula</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL')): ?>
                        <?php if($location=='menu-aulavirtual'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtual')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtual')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->exists('MOD_AULA-VIRTUAL-DOCENTE')): ?>
                        <?php if($location=='menu-aulavirtual-doc'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.aulavirtualdoc')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.aulavirtualdoc')); ?>"><span class="fa fa-cloud"></span> Aula Virtual</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <!--                        <?php if(session()->exists('MOD_RESERVA-RECURSO')): ?>
                                                <?php if($location=='reserva-recurso'): ?>
                                                <li class="active ripple"><a href="<?php echo e(route('admin.reservarecurso')); ?>"><span class="fa fa-list-alt"></span> Reserva Recursos</a></li>
                                                <?php else: ?>
                                                <li class="ripple"><a href="<?php echo e(route('admin.reservarecurso')); ?>"><span class="fa fa-list-alt"></span> Reserva Recursos</a></li>
                                                <?php endif; ?>
                                                <?php endif; ?>-->
                        <?php if(session()->exists('MOD_EVALUACION-AUTO-HETERO')): ?>
                        <?php if($location=='menu-evaluacion-auto-hetero'): ?>
                        <li class="active ripple"><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"><span class="fa fa-check-circle-o"></span> Evaluación Académica</a></li>
                        <?php else: ?>
                        <li class="ripple"><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"><span class="fa fa-check-circle-o"></span> Evaluación Académica</a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <li class="ripple">
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Salir</a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                    </ul>
                </div>
            </div>       
        </div>
        <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
            <span class="fa fa-bars"></span>
        </button>
        <!-- end: Mobile -->
        <!-- start: Javascript -->
        <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.ui.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/jquery.steps.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/jquery.validate.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/momentjs.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/jquery.nicescroll.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/jquery.datatables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/plugins/datatables.bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/chosen_v1.7.0/chosen.jquery.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/pnotify/dist/pnotify.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/pnotify/dist/pnotify.buttons.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/pnotify/dist/pnotify.nonblock.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/ckeditor/ckeditor.js')); ?>"></script>
        <!-- custom -->
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>
        <script>
                                function copiar(text) {
                                    $("body").append("<input type='text' id='temp'>");
                                    $("#temp").val(text).select();
                                    document.execCommand("copy");
                                    $("#temp").remove();
                                    notify("Información", "Ha Copiado el enlace al portapapeles", "info");
                                }

                                function notify(title, text, type) {
                                    new PNotify({
                                        title: title,
                                        text: text,
                                        type: type,
                                        styling: 'bootstrap3'
                                    });
                                }

                                var url = "<?php echo config('app.url'); ?>";
        </script>
        <?php echo $__env->yieldContent('script'); ?>
        <!-- end: Javascript -->
    </body>
</html>
