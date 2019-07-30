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
                <div id="msjpanel" class="col-md-12"  style="padding-top: 40px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>INFORMACIÓN</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="alert alert-danger col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
                                    <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                                        <span class="fa fa-remove fa-2x"></span></div>
                                    <div class="col-md-10 col-sm-10">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <p id="mensajerta"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="todo">
                    <div class="col-md-12" style="padding-top: 20px;">
                        @include('flash::message')
                    </div>
                    <div class="col-md-12"  style="padding-top: 40px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>FORMULARIO DE INSCRIPCIÓN EN LÍNEA</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <form id="example1" class="form-horizontal" action="{{route('inscripcion.finalizar2')}}" method="POST">
                                        <input type="hidden" name="aspirante_id" id="aspirante_id" value="{{$aspi->id}}" />
                                        <input type="hidden" name="servicioperiodo_id" id="serp" value="{{$aspi->speriodo}}" />
                                        <input type="hidden" name="pin" id="pin" value="{{$pin}}" />
                                        <input type="hidden" name="serpe" id="serpe" value="{{$serpe}}" />
                                        <input type="hidden" name="procesoa" id="procesoa" value="{{$procesoa}}" />
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Datos Personales</h4>
                                            <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="success">
                                                        <th>Identificación</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Fecha Expedición</th>
                                                        <th>Lugar Expedición</th>
                                                        <th>Sexo</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->numerodocumento}}</td>
                                                        <td>{{$aspi->tipodoc->descripcion}}</td>
                                                        <td>{{$aspi->fecha_expedicion}}</td>
                                                        <td>{{$aspi->lugar_expedicion}}</td>
                                                        <td>{{$aspi->sexo}}</td>
                                                    </tr>
                                                    <tr class="success">
                                                        <th>Primer Nombre</th>
                                                        <th>Segundo Nombre</th>
                                                        <th>Primer Apellido</th>
                                                        <th>Segundo Apellido</th>
                                                        <th>Teléfono Celular</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->primer_nombre}}</td>
                                                        <td>{{$aspi->segundo_nombre}}</td>
                                                        <td>{{$aspi->primer_apellido}}</td>
                                                        <td>{{$aspi->segundo_apellido}}</td>
                                                        <td>{{$aspi->telefonocelular}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Datos Generales</h4>
                                            <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="success">
                                                        <th>Libreta Militar</th>
                                                        <th>Distrito</th>
                                                        <th>Étnia</th>
                                                        <th>Tipo Sanguíneo</th>
                                                        <th>Estado Civil</th>
                                                        <th>Estrato</th>
                                                        <th>Circunscripción</th>
                                                        <th>Sisben</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->libreta_militar}}</td>
                                                        <td>{{$aspi->distrito_militar}}</td>
                                                        <td>{{$aspi->etnia}}</td>
                                                        <td>{{$aspi->tiposanguineo}}</td>
                                                        <td>{{$aspi->estadocivil->descripcion}}</td>
                                                        <td>{{$aspi->estrato->estrato}}</td>
                                                        <td>{{$aspi->circunscripcion->descripcion}}</td>
                                                        <td>{{$aspi->estrato->sisben}}</td>
                                                    </tr>
                                                    <tr class="success">
                                                        <th>Fecha de Nacimiento</th>
                                                        <th>Ciudad</th>
                                                        <th>Departamento</th>
                                                        <th>Pais</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->fecha_nacimiento}}</td>
                                                        <td>{{$aspi->cn->nombre}}</td>
                                                        <td>{{$aspi->dn->nombre}}</td>
                                                        <td>{{$aspi->pn->nombre}}</td>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Datos De Ubicación</h4>
                                            <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="success">
                                                        <th>Dirección</th>
                                                        <th>Barrio</th>
                                                        <th>Ciudad</th>
                                                        <th>Departamento</th>
                                                        <th>Pais</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->direccion_residencia}}</td>
                                                        <td>{{$aspi->barrio_residencia}}</td>
                                                        <td>{{$aspi->cr->nombre}}</td>
                                                        <td>{{$aspi->dr->nombre}}</td>
                                                        <td>{{$aspi->pr->nombre}}</td>
                                                    </tr>
                                                    <tr class="success">
                                                        <th>Teléfono Residencia</th>
                                                        <th>Teléfono Celular</th>
                                                        <th>Correo Electrónico</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                    <tr>
                                                        <td>{{$aspi->telefono_residencia}}</td>
                                                        <td>{{$aspi->telefonocelular}}</td>
                                                        <td>{{$aspi->email}}</td>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Estudios Secundarios</h4>
                                            <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="success">
                                                        <th>Código Institución</th>
                                                        <th>Nombre Institución</th>
                                                        <th>Fecha de Terminación</th>
                                                        <th>SNP Icfes</th>
                                                        <th>Tipo de Prueba</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$aspi->ess->codigo_snp}}</td>
                                                        <td>{{$aspi->inst->nombre}}</td>
                                                        <td>{{$aspi->ess->fechaterminacion}}</td>
                                                        <td>{{$aspi->ess->snp}}</td>
                                                        <td>{{$aspi->ess->tipoprueba}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Idiomas</h4>
                                                <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                    <tbody>
                                                        @foreach($aspi->idiomas as $i)
                                                        <tr>
                                                            <td>{{$i->idioma->descripcion}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Pasatiempos</h4>
                                                <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                    <tbody>
                                                        @foreach($aspi->pasa as $i)
                                                        <tr>
                                                            <td>{{$i->pasatiempo->descripcion}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Formularios Diligenciados</h4>
                                            <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="success">
                                                        <th>Formulario</th>
                                                        <th>Programa</th>
                                                        <th>Estado</th>
                                                        <th>Periodo</th>
                                                        <th>Unidad</th>
                                                        <th>Ciudad</th>
                                                    </tr>
                                                    @foreach($aspi->forms as $i)
                                                    <tr>
                                                        <td>{{$i['id']}}</td>
                                                        <td>{{$i['prog']}}</td>
                                                        <td>{{$i['estado']}}</td>
                                                        <td>{{$aspi->periodo->anio." - ".$aspi->periodo->periodo}}</td>
                                                        <td>{{$i['und']}}</td>
                                                        <td>{{$i['cd']}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <h4 style="background-color: #ed4c1b; padding: 10px; color:#ffffff;">Programa al que Aspira</h4>
                                            <div class="col-md-12">
                                                <label>Sede en la que desea Estudiar</label>
                                                {!! Form::select('unidad_id',$unds,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'unidad_id']) !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label>Metodología</label>
                                                {!! Form::select('metodologia_id',$metodologias,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'metodologia_id']) !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nivel Educativo</label>
                                                {!! Form::select('nivel_educativo_id',$nivel,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'nivel_educativo_id','onchange'=>'traerModalidad()']) !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label>Modalidad</label>
                                                {!! Form::select('modalidad_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'modalidad_id','onchange'=>'traerProgramas()']) !!}
                                            </div>
                                            <div class="col-md-12">
                                                <label>Programa al que Aspira</label>
                                                {!! Form::select('programaunidad_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'programaunidad_id','onchange'=>'verificarFechas()']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Clasificación especial por razón de residencia en un territorio, división político-administrativa, lengua, cultura u origen diferenciados, o becas.</label>
                                                @if($circuns!==null)
                                                {!! Form::select('circunscripcion_id',$circuns,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                                                @else
                                                <h5 style="color: red;">No Existen datos de Circunscripción para el nivel educativo del proceso de inscripción actual!</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-3d" value="Finalizar Proceso de Inscripción" />
                                        </div>
                                    </form>
                                </div>
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
    $("#msjpanel").hide();
});

function traerProgramas() {
    $("#programaunidad_id").empty();
    var mod = $("#modalidad_id").val();
    var met = $("#metodologia_id").val();
    var serp = $("#serp").val();
    var und = $("#unidad_id").val();
    $.ajax({
        type: 'GET',
        url: url + "convocatoriap/" + mod + "/" + met + "/" + serp + "/" + und + "/programas",
        data: {},
    }).done(function (msg) {
        if (msg !== "null") {
            var m = JSON.parse(msg);
            $("#programaunidad_id").append("<option value='0'>-- Seleccione una opción --</option>");
            $.each(m, function (index, item) {
                $("#programaunidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
            });
        } else {
            notify('Alerta', 'No existen programas ofertados para los parametros dados.', 'error');
        }
    });
}

function traerModalidad() {
    $("#modalidad_id").empty();
    var id = $("#nivel_educativo_id").val();
    $.ajax({
        type: 'GET',
        url: url + "niveleducativop/" + id + "/modalidades",
        data: {},
    }).done(function (msg) {
        var m = JSON.parse(msg);
        $("#modalidad_id").append("<option value='0'>-- Seleccione una opción --</option>");
        $.each(m, function (index, item) {
            $("#modalidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
        });
    });
}

function verificarFechas() {
    var periodo = $("#serpe").val();
    var proceso = $("#procesoa").val();
    var pro = $("#programaunidad_id").val();
    $.ajax({
        type: 'GET',
        url: url + "inscripciones/" + periodo + "/" + proceso + "/" + pro + "/validarfechas",
        data: {},
    }).done(function (msg) {
        if (msg === "NO1") {
            $("#mensajerta").html('<strong>Atención</strong> El programa seleccionado no se encuentra ofertado para éste período académico. Recargue la página y seleccione otro programa.');
            $("#todo").fadeOut();
            $("#msjpanel").fadeIn();
        } else if (msg === "NO2") {
            $("#mensajerta").html('<strong>Atención</strong> No hay fechas definidas para el proceso de inscripción en el programa seleccionado. Recargue la página y seleccione otro programa.');
            $("#todo").fadeOut();
            $("#msjpanel").fadeIn();
        } else if (msg === "NO3") {
            $("#mensajerta").html('<strong>Atención</strong> El día de hoy esta fuera de las fechas definidas para el proceso de inscripción en el programa seleccionado. Recargue la página y seleccione otro programa.');
            $("#todo").fadeOut();
            $("#msjpanel").fadeIn();
        }
    });
}
        </script>
        <!-- end: Javascript -->
    </body>
</html>

