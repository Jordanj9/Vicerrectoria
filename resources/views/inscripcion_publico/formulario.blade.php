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
                    @if($mostrar==="SI")
                    <div class="col-md-12"  style="padding-top: 40px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>FORMULARIO DE INSCRIPCIÓN EN LÍNEA</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <form id="example1" action="{{route('inscripcion.finalizar')}}" method="POST">
                                        <input type="hidden" name="serpe" id="serpe" value="{{$serpe}}" />
                                        <input type="hidden" name="procesoa" id="procesoa" value="{{$procesoa}}" />
                                        <input type="hidden" name="serp" id="serp" value="{{$serp}}" />
                                        {{ csrf_field() }}
                                        @if($c!==null)
                                        <h3>Contrato</h3>
                                        <fieldset>
                                            <div>{!!$c->texto!!}</div>
                                            <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">Acepto los términos del contrato</label>
                                        </fieldset>
                                        @endif
                                        <h3>Información</h3>
                                        <fieldset>
                                            @if($p!==null)
                                            @if($p->usatextoantes=='1')
                                            <p>{!!$p->textoinformativo!!}</p>
                                            @endif
                                            @endif
                                            <legend>Información Básica y Pago</legend>
                                            <div class="form-group">
                                                <?php $e1 = existe($conf, 'TDIA') ?>
                                                @if($e1!==null)
                                                <div class="col-md-3">
                                                    <label>{{$e1['elemento']}}</label>
                                                    @if($e1['obligatorio']=='S')
                                                    {!! Form::select('tipodoc_id',$td,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                    @else
                                                    {!! Form::select('tipodoc_id',$td,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                    @endif
                                                </div>
                                                @endif
                                                <?php $e2 = existe($conf, 'D') ?>
                                                @if($e2!==null)
                                                <div class="col-md-3">
                                                    <label>{{$e2['elemento']}}</label>
                                                    @if($e2['obligatorio']=='S')
                                                    <input type="number" name="numero_documento" id="numero_documento" class="form-control required"/>
                                                    @else
                                                    <input type="number" name="numero_documento" id="numero_documento" class="form-control"/>
                                                    @endif
                                                </div>
                                                @endif
                                                <?php $e3 = existe($conf, 'LE') ?>
                                                @if($e3!==null)
                                                <div class="col-md-3">
                                                    <label>{{$e3['elemento']}}</label>
                                                    @if($e3['obligatorio']=='S')
                                                    <input type="text" name="lugar_expedicion" class="form-control required"/>
                                                    @else
                                                    <input type="text" name="lugar_expedicion" class="form-control"/>
                                                    @endif
                                                </div>
                                                @endif
                                                <?php $en = existe($conf, 'FEDI') ?>
                                                @if($en!==null)
                                                <div class="col-md-3">
                                                    <label>{{$en['elemento']}}</label>
                                                    @if($en['obligatorio']=='S')
                                                    <input type="date" name="fecha_expedicion" class="form-control required"/>
                                                    @else
                                                    <input type="date" name="fecha_expedicion" class="form-control"/>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group" style="margin-top: 20px;">
                                                <div class="col-md-8">
                                                    <label>Número del Pago (PIN)</label>
                                                    <input type="text" name="pin" id="pin" placeholder="Número de PIN que adquirió en el banco" class="form-control"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="btn btn-success btn-sm btn-block" style="margin-top: 20px;" onclick="validarPin()">Validar PIN</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="rtapin">

                                            </div>
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Programa al que Aspira</legend>
                                                <div class="form-group">
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
                                            </div>
                                        </fieldset>
                                        <h3>Aspirante</h3>
                                        <fieldset>
                                            @if(existePanel($conf,'Datos Personales'))
                                            <div class="col-md-12">
                                                <legend>Datos Personales</legend>
                                                <div class="form-group">
                                                    <?php $e4 = existe($conf, 'S') ?>
                                                    @if($e4!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e4['elemento']}}</label>
                                                        @if($e4['obligatorio']=='S')
                                                        {!! Form::select('sexo',['M'=>'M','F'=>'F'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('sexo',['M'=>'M','F'=>'F'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e5 = existe($conf, 'EIA') ?>
                                                    @if($e5!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e5['elemento']}} (Cms)</label>
                                                        @if($e5['obligatorio']=='S')
                                                        <input type="text" name="estatura" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="estatura" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e6 = existe($conf, 'PN') ?>
                                                    @if($e6!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e6['elemento']}}</label>
                                                        @if($e6['obligatorio']=='S')
                                                        <input type="text" name="primer_nombre" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="primer_nombre" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e7 = existe($conf, 'SNIA') ?>
                                                    @if($e7!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e7['elemento']}}</label>
                                                        @if($e7['obligatorio']=='S')
                                                        <input type="text" name="segundo_nombre" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="segundo_nombre" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e8 = existe($conf, 'PAIA') ?>
                                                    @if($e8!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e8['elemento']}}</label>
                                                        @if($e8['obligatorio']=='S')
                                                        <input type="text" name="primer_apellido" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="primer_apellido" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e9 = existe($conf, 'SA') ?>
                                                    @if($e9!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e9['elemento']}}</label>
                                                        @if($e9['obligatorio']=='S')
                                                        <input type="text" name="segundo_apellido" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="segundo_apellido" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e10 = existe($conf, 'LM') ?>
                                                    @if($e10!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e10['elemento']}} Nro.</label>
                                                        @if($e10['obligatorio']=='S')
                                                        <input type="text" name="libreta_militar" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="libreta_militar" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e11 = existe($conf, 'CLM') ?>
                                                    @if($e11!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e11['elemento']}}</label>
                                                        @if($e11['obligatorio']=='S')
                                                        {!! Form::select('clase_libreta_militar',['PRIMERA'=>'PRIMERA','SEGUNDA'=>'SEGUNDA','PROVISIONAL'=>'PROVISIONAL'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('clase_libreta_militar',['PRIMERA'=>'PRIMERA','SEGUNDA'=>'SEGUNDA','PROVISIONAL'=>'PROVISIONAL'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e12 = existe($conf, 'DM') ?>
                                                    @if($e12!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e12['elemento']}}</label>
                                                        @if($e12['obligatorio']=='S')
                                                        <input type="text" name="distrito_militar" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="distrito_militar" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e13 = existe($conf, 'ESIA') ?>
                                                    @if($e13!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e13['elemento']}}</label>
                                                        @if($e13['obligatorio']=='S')
                                                        {!! Form::select('estrato_ia',$estrato,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('estrato_ia',$estrato,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e14 = existe($conf, 'TS') ?>
                                                    @if($e14!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e14['elemento']}}</label>
                                                        @if($e14['obligatorio']=='S')
                                                        {!! Form::select('tipo_sanguineo',['A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('tipo_sanguineo',['A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e15 = existe($conf, 'EPSIA') ?>
                                                    @if($e15!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e15['elemento']}}</label>
                                                        @if($e15['obligatorio']=='S')
                                                        {!! Form::select('eps',$esalud,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','onchange'=>'mostrar()','id'=>'eps']) !!}
                                                        @else
                                                        {!! Form::select('eps',$esalud,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','onchange'=>'mostrar()','id'=>'eps']) !!}
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3" id="eps_mostrar">
                                                        <label>Otra EPS</label>
                                                        <input type="text" name="aspi_eps" id="aspi_eps" class="form-control"/>
                                                    </div>
                                                    @endif
                                                    <?php $e16 = existe($conf, 'EC') ?>
                                                    @if($e16!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e16['elemento']}}</label>
                                                        @if($e16['obligatorio']=='S')
                                                        {!! Form::select('estado_civil',$estado_civil,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('estado_civil',$estado_civil,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e17 = existe($conf, 'PO') ?>
                                                    @if($e17!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e17['elemento']}}</label>
                                                        @if($e17['obligatorio']=='S')
                                                        {!! Form::select('pais_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pais_id','onchange'=>'getEstados(this.id,"dpto_id","ciudad_id")']) !!}
                                                        @else
                                                        {!! Form::select('pais_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pais_id','onchange'=>'getEstados(this.id,"dpto_id","ciudad_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e18 = existe($conf, 'DO') ?>
                                                    @if($e18!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e18['elemento']}}</label>
                                                        @if($e18['obligatorio']=='S')
                                                        {!! Form::select('dpto_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto_id','onchange'=>'getCiudades(this.id, "ciudad_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto_id','onchange'=>'getCiudades(this.id, "ciudad_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e19 = existe($conf, 'COIA') ?>
                                                    @if($e19!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e19['elemento']}}</label>
                                                        @if($e19['obligatorio']=='S')
                                                        {!! Form::select('ciudad_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad_id']) !!}
                                                        @else
                                                        {!! Form::select('ciudad_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e20 = existe($conf, 'FN') ?>
                                                    @if($e20!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e20['elemento']}}</label>
                                                        @if($e20['obligatorio']=='S')
                                                        <input type="date" name="fecha_nacimiento" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fecha_nacimiento" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e21 = existe($conf, 'NV') ?>
                                                    @if($e21!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e21['elemento']}}</label>
                                                        @if($e21['obligatorio']=='S')
                                                        <input type="text" name="numero_visa" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="numero_visa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e22 = existe($conf, 'EV') ?>
                                                    @if($e22!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e22['elemento']}}</label>
                                                        @if($e22['obligatorio']=='S')
                                                        {!! Form::select('estado_visa',['VIGENTE'=>'VIGENTE','VENCIDA'=>'VENCIDA'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('estado_visa',['VIGENTE'=>'VIGENTE','VENCIDA'=>'VENCIDA'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e23 = existe($conf, 'FVV') ?>
                                                    @if($e23!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e23['elemento']}}</label>
                                                        @if($e23['obligatorio']=='S')
                                                        <input type="date" name="fechavence_visa" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fechavence_visa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e24 = existe($conf, 'PCMEI') ?>
                                                    @if($e24!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e24['elemento']}}</label>
                                                        @if($e24['obligatorio']=='S')
                                                        {!! Form::select('mediodivulgacion_id',$mdivulgacion,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('mediodivulgacion_id',$mdivulgacion,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e25 = existe($conf, 'NA') ?>
                                                    @if($e25!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e25['elemento']}}</label>
                                                        @if($e25['obligatorio']=='S')
                                                        {!! Form::select('nivelacademico',['BACHILLER'=>'BACHILLER','TECNICO'=>'TÉCNICO','TECNOLOGO'=>'TECNÓLOGO','PROFESIONAL'=>'PROFESIONAL'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('nivelacademico',['BACHILLER'=>'BACHILLER','TECNICO'=>'TÉCNICO','TECNOLOGO'=>'TECNÓLOGO','PROFESIONAL'=>'PROFESIONAL'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Clasificación especial por razón de residencia en un territorio, división político-administrativa, lengua, cultura u origen diferenciados, o becas.</legend>
                                                <div class="form-group">
                                                    @if($circuns!==null)
                                                    <div class="col-md-12">
                                                        {!! Form::select('circunscripcion_id',$circuns,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                    </div>
                                                    @else
                                                    <h5 style="color: red;">No Existen datos de Circunscripción para el nivel educativo del proceso de inscripción actual!</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(existePanel($conf,'Datos de Ubicación'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Datos de Ubicación</legend>
                                                <div class="form-group">
                                                    <?php $e26 = existe($conf, 'PU') ?>
                                                    @if($e26!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e26['elemento']}}</label>
                                                        @if($e26['obligatorio']=='S')
                                                        {!! Form::select('pais2_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pais2_id','onchange'=>'getEstados(this.id,"dpto2_id","ciudad2_id")']) !!}
                                                        @else
                                                        {!! Form::select('pais2_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pais2_id','onchange'=>'getEstados(this.id,"dpto2_id","ciudad2_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e27 = existe($conf, 'DU') ?>
                                                    @if($e27!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e27['elemento']}}</label>
                                                        @if($e27['obligatorio']=='S')
                                                        {!! Form::select('dpto2_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto2_id','onchange'=>'getCiudades(this.id, "ciudad2_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto2_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto2_id','onchange'=>'getCiudades(this.id, "ciudad2_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e28 = existe($conf, 'CU') ?>
                                                    @if($e28!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e28['elemento']}}</label>
                                                        @if($e28['obligatorio']=='S')
                                                        {!! Form::select('ciudad2_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad2_id','onchange'=>'sector()']) !!}
                                                        @else
                                                        {!! Form::select('ciudad2_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad2_id','onchange'=>'sector()']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e29 = existe($conf, 'SU') ?>
                                                    @if($e29!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e29['elemento']}}</label>
                                                        @if($e29['obligatorio']=='S')
                                                        {!! Form::select('sectorciudad_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'sectorciudad_id','onchange'=>'barrio()']) !!}
                                                        @else
                                                        {!! Form::select('sectorciudad_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'sectorciudad_id','onchange'=>'barrio()']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e30 = existe($conf, 'DA') ?>
                                                    @if($e30!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e30['elemento']}}</label>
                                                        @if($e30['obligatorio']=='S')
                                                        <input type="text" name="direccion_aspirante" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="direccion_aspirante" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e31 = existe($conf, 'BA') ?>
                                                    @if($e31!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e31['elemento']}}</label>
                                                        @if($e31['obligatorio']=='S')
                                                        <input type="text" name="barrio_aspirante" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="barrio_aspirante" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e32 = existe($conf, 'BAL') ?>
                                                    @if($e32!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e32['elemento']}}</label>
                                                        @if($e32['obligatorio']=='S')
                                                        {!! Form::select('barrio_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'barrio_id']) !!}
                                                        @else
                                                        {!! Form::select('barrio_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'barrio_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e33 = existe($conf, 'VA') ?>
                                                    @if($e33!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e33['elemento']}}</label>
                                                        @if($e33['obligatorio']=='S')
                                                        <input type="text" name="vereda_aspirante" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="vereda_aspirante" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e34 = existe($conf, 'ETNIA') ?>
                                                    @if($e34!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e34['elemento']}}</label>
                                                        @if($e34['obligatorio']=='S')
                                                        <input type="text" name="etnia_aspirante" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="etnia_aspirante" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e35 = existe($conf, 'TCDU') ?>
                                                    @if($e35!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e35['elemento']}}</label>
                                                        @if($e35['obligatorio']=='S')
                                                        <input type="number" name="telefono_contacto" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="telefono_contacto" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e36 = existe($conf, 'TC') ?>
                                                    @if($e36!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e36['elemento']}}</label>
                                                        @if($e36['obligatorio']=='S')
                                                        <input type="number" name="telefono_celular" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="telefono_celular" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e37 = existe($conf, 'CE') ?>
                                                    @if($e37!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e37['elemento']}}</label>
                                                        @if($e37['obligatorio']=='S')
                                                        <input type="email" name="correo" class="form-control required"/>
                                                        @else
                                                        <input type="email" name="correo" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e38 = existe($conf, 'DDS') ?>
                                                    @if($e38!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e38['elemento']}}</label>
                                                        @if($e38['obligatorio']=='S')
                                                        {!! Form::select('dpto3_id',$dptos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto3_id','onchange'=>'getCiudades(this.id, "ciudad3_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto3_id',$dptos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto3_id','onchange'=>'getCiudades(this.id, "ciudad3_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e39 = existe($conf, 'CDS') ?>
                                                    @if($e39!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e39['elemento']}}</label>
                                                        @if($e39['obligatorio']=='S')
                                                        {!! Form::select('ciudad3_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad3_id']) !!}
                                                        @else
                                                        {!! Form::select('ciudad3_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad3_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e40 = existe($conf, 'DEC') ?>
                                                    @if($e40!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e40['elemento']}}</label>
                                                        @if($e40['obligatorio']=='S')
                                                        <input type="text" name="direccion_ec" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="direccion_ec" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e41 = existe($conf, 'DECE') ?>
                                                    @if($e41!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e41['elemento']}}</label>
                                                        @if($e41['obligatorio']=='S')
                                                        <input type="text" name="direccion_ciudade" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="direccion_ciudade" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e42 = existe($conf, 'TECE') ?>
                                                    @if($e42!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e42['elemento']}}</label>
                                                        @if($e42['obligatorio']=='S')
                                                        <input type="number" name="telefono_ciudade" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="telefono_ciudade" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        </fieldset>
                                        <h3>Estudios</h3>
                                        <fieldset>
                                            @if(existePanel($conf,'Estudios de Secundaria'))
                                            <div class="col-md-12">
                                                <legend>Estudios de Secundaria</legend>
                                                <div class="form-group">
                                                    <?php $e43 = existe($conf, 'PES') ?>
                                                    @if($e43!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e43['elemento']}}</label>
                                                        @if($e43['obligatorio']=='S')
                                                        {!! Form::select('paisn_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'paisn_id','onchange'=>'getEstados(this.id,"dpton_id","ciudadn_id")']) !!}
                                                        @else
                                                        {!! Form::select('paisn_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'paisn_id','onchange'=>'getEstados(this.id,"dpton_id","ciudadn_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e44 = existe($conf, 'DES') ?>
                                                    @if($e44!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e44['elemento']}}</label>
                                                        @if($e44['obligatorio']=='S')
                                                        {!! Form::select('dpton_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpton_id','onchange'=>'getCiudades(this.id, "ciudadn_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpton_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpton_id','onchange'=>'getCiudades(this.id, "ciudadn_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e45 = existe($conf, 'CES') ?>
                                                    @if($e45!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e45['elemento']}}</label>
                                                        @if($e45['obligatorio']=='S')
                                                        {!! Form::select('ciudadn_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudadn_id','onchange'=>'getIem(this.id,"iem_id")']) !!}
                                                        @else
                                                        {!! Form::select('ciudadn_id',['HOLA'=>'HOLA'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudadn_id','onchange'=>'getIem(this.id,"iem_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e46 = existe($conf, 'IES') ?>
                                                    @if($e46!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e46['elemento']}}</label>
                                                        @if($e46['obligatorio']=='S')
                                                        {!! Form::select('iem_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'iem_id']) !!}
                                                        @else
                                                        {!! Form::select('iem_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'iem_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e47 = existe($conf, 'EES') ?>
                                                    @if($e47!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e47['elemento']}}</label>
                                                        @if($e47['obligatorio']=='S')
                                                        {!! Form::select('enfasis',['1'=>'CLASICO','2'=>'ACADEMICO','3'=>'PEDAGOGICO','4'=>'INDUSTRIAL','5'=>'COMERCIAL','6'=>'AGROPECUARIO','7'=>'ARTES','8'=>'EN EL EXTERIOR','9'=>'OTRO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('enfasis',['1'=>'CLASICO','2'=>'ACADEMICO','3'=>'PEDAGOGICO','4'=>'INDUSTRIAL','5'=>'COMERCIAL','6'=>'AGROPECUARIO','7'=>'ARTES','8'=>'EN EL EXTERIOR','9'=>'OTRO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e48 = existe($conf, 'FT') ?>
                                                    @if($e48!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e48['elemento']}}</label>
                                                        @if($e48['obligatorio']=='S')
                                                        <input type="date" name="ft" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="ft" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e49 = existe($conf, 'FOT') ?>
                                                    @if($e49!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e49['elemento']}}</label>
                                                        @if($e49['obligatorio']=='S')
                                                        {!! Form::select('forma_obt_titulo',['REGULAR'=>'REGULAR','VALIDACION'=>'VALIDACION'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudadd_id']) !!}
                                                        @else
                                                        {!! Form::select('forma_obt_titulo',['REGULAR'=>'REGULAR','VALIDACION'=>'VALIDACION'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudadd_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e50 = existe($conf, 'VMD') ?>
                                                    @if($e50!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e50['elemento']}}</label>
                                                        @if($e50['obligatorio']=='S')
                                                        <input type="number" name="vmd" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vmd" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e51 = existe($conf, 'VPD') ?>
                                                    @if($e51!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e51['elemento']}}</label>
                                                        @if($e51['obligatorio']=='S')
                                                        <input type="number" name="vpd" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vpd" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e52 = existe($conf, 'VMU') ?>
                                                    @if($e52!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e52['elemento']}}</label>
                                                        @if($e52['obligatorio']=='S')
                                                        <input type="number" name="vmu" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vmu" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e53 = existe($conf, 'VPU') ?>
                                                    @if($e53!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e53['elemento']}}</label>
                                                        @if($e53['obligatorio']=='S')
                                                        <input type="number" name="vpu" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vpu" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e54 = existe($conf, 'LIBRO') ?>
                                                    @if($e54!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e54['elemento']}}</label>
                                                        @if($e54['obligatorio']=='S')
                                                        <input type="text" name="libro" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="libro" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e55 = existe($conf, 'FOLIO') ?>
                                                    @if($e55!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e55['elemento']}}</label>
                                                        @if($e55['obligatorio']=='S')
                                                        <input type="text" name="folio" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="folio" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e56 = existe($conf, 'SNPA') ?>
                                                    @if($e56!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e56['elemento']}} (Código Asignado por el ICFES)</label>
                                                        @if($e56['obligatorio']=='S')
                                                        <input type="text" name="snp_aspirante" placeholder="EJ: AC292 0345678" data-toggle="tooltip" data-placement="top" title="AC + código numérico (Puede ser diferente a AC)" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="snp_aspirante" placeholder="EJ: AC292 0345678" data-toggle="tooltip" data-placement="top" title="AC + código numérico (Puede ser diferente a AC)" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e57 = existe($conf, 'POES') ?>
                                                    @if($e57!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e57['elemento']}}</label>
                                                        @if($e57['obligatorio']=='S')
                                                        <input type="number" name="poes" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="poes" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e58 = existe($conf, 'DPES') ?>
                                                    @if($e58!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e58['elemento']}}</label>
                                                        @if($e58['obligatorio']=='S')
                                                        {!! Form::select('dpto5_id',$dptos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto5_id','onchange'=>'getCiudades(this.id, "ciudad5_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto5_id',$dptos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto5_id','onchange'=>'getCiudades(this.id, "ciudad5_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e59 = existe($conf, 'CPES') ?>
                                                    @if($e59!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e59['elemento']}}</label>
                                                        @if($e59['obligatorio']=='S')
                                                        {!! Form::select('ciudad5_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad5_id']) !!}
                                                        @else
                                                        {!! Form::select('ciudad5_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad5_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e60 = existe($conf, 'FPES') ?>
                                                    @if($e60!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e60['elemento']}}</label>
                                                        @if($e60['obligatorio']=='S')
                                                        <input type="date" name="fpes" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fpes" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e61 = existe($conf, 'TDCPP') ?>
                                                    @if($e61!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e61['elemento']}}</label>
                                                        @if($e61['obligatorio']=='S')
                                                        {!! Form::select('tipodoc_prueba',$td,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('tipodoc_prueba',$td,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e62 = existe($conf, 'DIPI') ?>
                                                    @if($e62!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e62['elemento']}}</label>
                                                        @if($e62['obligatorio']=='S')
                                                        <input type="number" name="dipi" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="dipi" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            <?php $e63 = existe($conf, 'LIE') ?>
                                            @if($e63!==null)
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Listado de Instituciones en las que Estudió</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb1" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Fecha Inicial</th>
                                                                    <th>Fecha Final</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e64 = existe($conf, 'PESI') ?>
                                                    @if($e64!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e64['elemento']}}</label>
                                                        @if($e64['obligatorio']=='S')
                                                        {!! Form::select('pais6_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pais6_id','onchange'=>'getEstados(this.id,"dpto6_id","ciudad6_id")']) !!}
                                                        @else
                                                        {!! Form::select('pais6_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pais6_id','onchange'=>'getEstados(this.id,"dpto6_id","ciudad6_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e65 = existe($conf, 'DESI') ?>
                                                    @if($e65!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e65['elemento']}}</label>
                                                        @if($e65['obligatorio']=='S')
                                                        {!! Form::select('dpto6_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto6_id','onchange'=>'getCiudades(this.id, "ciudad6_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto6_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto6_id','onchange'=>'getCiudades(this.id, "ciudad6_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e66 = existe($conf, 'CESI') ?>
                                                    @if($e66!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e66['elemento']}}</label>
                                                        @if($e66['obligatorio']=='S')
                                                        {!! Form::select('ciudad6_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad6_id','onchange'=>'getIem(this.id,"iem2_id")']) !!}
                                                        @else
                                                        {!! Form::select('ciudad6_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad6_id','onchange'=>'getIem(this.id,"iem2_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e67 = existe($conf, 'IESI') ?>
                                                    @if($e67!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e67['elemento']}}</label>
                                                        @if($e67['obligatorio']=='S')
                                                        {!! Form::select('iem2_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'iem2_id']) !!}
                                                        @else
                                                        {!! Form::select('iem2_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'iem2_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e68 = existe($conf, 'FIES') ?>
                                                    @if($e68!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e68['elemento']}}</label>
                                                        @if($e68['obligatorio']=='S')
                                                        <input type="date" name="fechainicial_iem" id="fechainicial_iem" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fechainicial_iem" id="fechainicial_iem" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e69 = existe($conf, 'FFES') ?>
                                                    @if($e69!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e69['elemento']}}</label>
                                                        @if($e69['obligatorio']=='S')
                                                        <input type="date" name="fechafinal_iem" id="fechafinal_iem" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fechafinal_iem" id="fechafinal_iem" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if($e64!==null)
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb1()">Agregar</p>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Estudios de Pregrado'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Estudios de Pregrado</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb2" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Programa</th>
                                                                    <th>Semestres</th>
                                                                    <th>Fecha Terminación</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e70 = existe($conf, 'PEP') ?>
                                                    @if($e70!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e70['elemento']}}</label>
                                                        @if($e70['obligatorio']=='S')
                                                        {!! Form::select('pais7_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pais7_id','onchange'=>'getEstados(this.id,"dpto7_id","ciudad7_id")']) !!}
                                                        @else
                                                        {!! Form::select('pais7_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pais7_id','onchange'=>'getEstados(this.id,"dpto7_id","ciudad7_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e71 = existe($conf, 'DEP') ?>
                                                    @if($e71!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e71['elemento']}}</label>
                                                        @if($e71['obligatorio']=='S')
                                                        {!! Form::select('dpto7_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto7_id','onchange'=>'getCiudades(this.id, "ciudad7_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto7_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto7_id','onchange'=>'getCiudades(this.id, "ciudad7_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e72 = existe($conf, 'CEPR') ?>
                                                    @if($e72!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e72['elemento']}}</label>
                                                        @if($e72['obligatorio']=='S')
                                                        {!! Form::select('ciudad7_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad7_id','onchange'=>'getIes(this.id,"ies_id")']) !!}
                                                        @else
                                                        {!! Form::select('ciudad7_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad7_id','onchange'=>'getIes(this.id,"ies_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e73 = existe($conf, 'IEPR') ?>
                                                    @if($e73!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e73['elemento']}}</label>
                                                        @if($e73['obligatorio']=='S')
                                                        {!! Form::select('ies_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ies_id']) !!}
                                                        @else
                                                        {!! Form::select('ies_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ies_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e74 = existe($conf, 'PEPR') ?>
                                                    @if($e74!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e74['elemento']}}</label>
                                                        @if($e74['obligatorio']=='S')
                                                        <input type="text" name="pepr" id="pepr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="pepr" id="pepr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e75 = existe($conf, 'SCEP') ?>
                                                    @if($e75!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e75['elemento']}}</label>
                                                        @if($e75['obligatorio']=='S')
                                                        <input type="number" name="scep" id="scep" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="scep" id="scep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e76 = existe($conf, 'FTEP') ?>
                                                    @if($e76!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e76['elemento']}}</label>
                                                        @if($e76['obligatorio']=='S')
                                                        <input type="date" name="ftep" id="ftep" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="ftep" id="ftep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e77 = existe($conf, 'NTP') ?>
                                                    @if($e77!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e77['elemento']}}</label>
                                                        @if($e77['obligatorio']=='S')
                                                        <input type="text" name="ntp" id="ntp" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ntp" id="ntp" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e78 = existe($conf, 'CREP') ?>
                                                    @if($e78!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e78['elemento']}}</label>
                                                        @if($e78['obligatorio']=='S')
                                                        <input type="text" name="crep" id="crep" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="crep" id="crep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e79 = existe($conf, 'EECAES') ?>
                                                    @if($e79!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e79['elemento']}}</label>
                                                        @if($e79['obligatorio']=='S')
                                                        {!! Form::select('eecaes',['NO PRESENTO'=>'NO PRESENTO','PRESENTO'=>'PRESENTO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'eecaes']) !!}
                                                        @else
                                                        {!! Form::select('eecaes',['NO PRESENTO'=>'NO PRESENTO','PRESENTO'=>'PRESENTO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'eecaes']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e80 = existe($conf, 'RECAES') ?>
                                                    @if($e80!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e80['elemento']}}</label>
                                                        @if($e80['obligatorio']=='S')
                                                        <input type="text" name="recaes" id="recaes" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="recaes" id="recaes" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e81 = existe($conf, 'PECAES') ?>
                                                    @if($e81!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e81['elemento']}}</label>
                                                        @if($e81['obligatorio']=='S')
                                                        <input type="number" name="pecaes" id="pecaes" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pecaes" id="pecaes" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if($e70!==null)
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb2()">Agregar</p>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Estudios de Postgrado'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Estudios de Postgrado</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb3" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Programa</th>
                                                                    <th>Fecha Terminación</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e82 = existe($conf, 'PESP') ?>
                                                    @if($e82!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e82['elemento']}}</label>
                                                        @if($e82['obligatorio']=='S')
                                                        {!! Form::select('pais8_id',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pais8_id','onchange'=>'getEstados(this.id,"dpto8_id","ciudad8_id")']) !!}
                                                        @else
                                                        {!! Form::select('pais8_id',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pais8_id','onchange'=>'getEstados(this.id,"dpto8_id","ciudad8_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e83 = existe($conf, 'DEPO') ?>
                                                    @if($e83!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e83['elemento']}}</label>
                                                        @if($e83['obligatorio']=='S')
                                                        {!! Form::select('dpto8_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto8_id','onchange'=>'getCiudades(this.id, "ciudad8_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto8_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto8_id','onchange'=>'getCiudades(this.id, "ciudad8_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e84 = existe($conf, 'CEPO') ?>
                                                    @if($e84!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e84['elemento']}}</label>
                                                        @if($e84['obligatorio']=='S')
                                                        {!! Form::select('ciudad8_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad8_id','onchange'=>'getIes(this.id,"ies2_id")']) !!}
                                                        @else
                                                        {!! Form::select('ciudad8_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad8_id','onchange'=>'getIes(this.id,"ies2_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e85 = existe($conf, 'IEPO') ?>
                                                    @if($e85!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e85['elemento']}}</label>
                                                        @if($e85['obligatorio']=='S')
                                                        {!! Form::select('ies2_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ies2_id']) !!}
                                                        @else
                                                        {!! Form::select('ies2_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ies2_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e86 = existe($conf, 'TEP') ?>
                                                    @if($e86!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e86['elemento']}}</label>
                                                        @if($e86['obligatorio']=='S')
                                                        <input type="text" name="tep" id="tep" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="tep" id="tep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e87 = existe($conf, 'FTEPO') ?>
                                                    @if($e87!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e87['elemento']}}</label>
                                                        @if($e87['obligatorio']=='S')
                                                        <input type="date" name="ftepo" id="ftepo" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="ftepo" id="ftepo" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if($e82!==null)
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb3()">Agregar</p>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Cursos Realizados'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Cursos Realizados</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb4" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Título Obtenido</th>
                                                                    <th>Institución</th>
                                                                    <th>Fecha Terminación</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e88 = existe($conf, 'ICR') ?>
                                                    @if($e88!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e88['elemento']}}</label>
                                                        @if($e88['obligatorio']=='S')
                                                        <input type="text" name="icr" id="icr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="icr" id="icr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e89 = existe($conf, 'TCR') ?>
                                                    @if($e89!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e89['elemento']}}</label>
                                                        @if($e89['obligatorio']=='S')
                                                        <input type="text" name="tcr" id="tcr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="tcr" id="tcr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e90 = existe($conf, 'FTCR') ?>
                                                    @if($e90!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e90['elemento']}}</label>
                                                        @if($e90['obligatorio']=='S')
                                                        <input type="date" name="ftcr" id="ftcr" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="ftcr" id="ftcr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb4()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Publicaciones'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Publicaciones</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb5" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre de la Publicación</th>
                                                                    <th>Tipo de Obra</th>
                                                                    <th>Año</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e91 = existe($conf, 'NDLP') ?>
                                                    @if($e91!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e91['elemento']}}</label>
                                                        @if($e91['obligatorio']=='S')
                                                        <input type="text" name="ndlp" id="ndlp" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ndlp" id="ndlp" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e92 = existe($conf, 'TOP') ?>
                                                    @if($e92!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e92['elemento']}}</label>
                                                        @if($e92['obligatorio']=='S')
                                                        <input type="text" name="top" id="top" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="top" id="top" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e93 = existe($conf, 'AP') ?>
                                                    @if($e93!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e93['elemento']}}</label>
                                                        @if($e93['obligatorio']=='S')
                                                        <input type="number" name="ap" id="ap" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ap" id="ap" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e94 = existe($conf, 'EAP') ?>
                                                    @if($e94!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e94['elemento']}}</label>
                                                        @if($e94['obligatorio']=='S')
                                                        <input type="text" name="eap" id="eap" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="eap" id="eap" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb5()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </fieldset>
                                        <h3>Familiar</h3>
                                        <fieldset>
                                            @if(existePanel($conf,'Información Familiar'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Información Familiar</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb6" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cédula</th>
                                                                    <th>Nombre</th>
                                                                    <th>Parentesco</th>
                                                                    <th>Ocupación</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e95 = existe($conf, 'PIF') ?>
                                                    @if($e95!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e95['elemento']}}</label>
                                                        @if($e95['obligatorio']=='S')
                                                        {!! Form::select('pif',$parent,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pif']) !!}
                                                        @else
                                                        {!! Form::select('pif',$parent,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pif']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e96 = existe($conf, 'CDF') ?>
                                                    @if($e96!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e96['elemento']}}</label>
                                                        @if($e96['obligatorio']=='S')
                                                        <input type="number" name="cdf" id="cdf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="cdf" id="cdf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e97 = existe($conf, 'NAC') ?>
                                                    @if($e97!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e97['elemento']}}</label>
                                                        @if($e97['obligatorio']=='S')
                                                        <input type="text" name="nac" id="nac" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="nac" id="nac" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e98 = existe($conf, 'VIF') ?>
                                                    @if($e98!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e98['elemento']}}</label>
                                                        @if($e98['obligatorio']=='S')
                                                        {!! Form::select('vif',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'vif']) !!}
                                                        @else
                                                        {!! Form::select('vif',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'vif']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e99 = existe($conf, 'OIF') ?>
                                                    @if($e99!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e99['elemento']}}</label>
                                                        @if($e99['obligatorio']=='S')
                                                        <input type="text" name="oif" id="oif" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="oif" id="oif" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e100 = existe($conf, 'PIFA') ?>
                                                    @if($e100!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e100['elemento']}}</label>
                                                        @if($e100['obligatorio']=='S')
                                                        <input type="text" name="pifa" id="pifa" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="pifa" id="pifa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e101 = existe($conf, 'EDAD') ?>
                                                    @if($e101!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e101['elemento']}}</label>
                                                        @if($e101['obligatorio']=='S')
                                                        <input type="number" name="edad" id="edad" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="edad" id="edad" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e102 = existe($conf, 'NEIF') ?>
                                                    @if($e102!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e102['elemento']}}</label>
                                                        @if($e102['obligatorio']=='S')
                                                        {!! Form::select('neif',['PRIMARIA'=>'PRIMARIA','SECUNDARIA'=>'SECUNDARIA','UNIVERSIDAD'=>'UNIVERSIDAD'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'neif']) !!}
                                                        @else
                                                        {!! Form::select('neif',['PRIMARIA'=>'PRIMARIA','SECUNDARIA'=>'SECUNDARIA','UNIVERSIDAD'=>'UNIVERSIDAD'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'neif']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e103 = existe($conf, 'IMF') ?>
                                                    @if($e103!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e103['elemento']}}</label>
                                                        @if($e103['obligatorio']=='S')
                                                        <input type="number" name="imf" id="imf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="imf" id="imf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e104 = existe($conf, 'IMDF') ?>
                                                    @if($e104!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e104['elemento']}} (SMLV)</label>
                                                        @if($e104['obligatorio']=='S')
                                                        {!! Form::select('imdf',$rangos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'imdf']) !!}
                                                        @else
                                                        {!! Form::select('imdf',$rangos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'imdf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e105 = existe($conf, 'LEE') ?>
                                                    @if($e105!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e105['elemento']}}</label>
                                                        @if($e105 ['obligatorio']=='S')
                                                        {!! Form::select('lee',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'lee']) !!}
                                                        @else
                                                        {!! Form::select('lee',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'lee']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e106 = existe($conf, 'DIF') ?>
                                                    @if($e106!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e106['elemento']}}</label>
                                                        @if($e106 ['obligatorio']=='S')
                                                        {!! Form::select('dpto9_id',$dptos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dpto9_id','onchange'=>'getCiudades(this.id,"ciudad9_id")']) !!}
                                                        @else
                                                        {!! Form::select('dpto9_id',$dptos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dpto9_id','onchange'=>'getCiudades(this.id,"ciudad9_id")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e107 = existe($conf, 'CR') ?>
                                                    @if($e107!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e107['elemento']}}</label>
                                                        @if($e107 ['obligatorio']=='S')
                                                        {!! Form::select('ciudad9_id',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad9_id']) !!}
                                                        @else
                                                        {!! Form::select('ciudad9_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudad9_id']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e108 = existe($conf, 'DRIF') ?>
                                                    @if($e108!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e108['elemento']}}</label>
                                                        @if($e108['obligatorio']=='S')
                                                        <input type="text" name="drif" id="drif" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="drif" id="drif" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e109 = existe($conf, 'TCIF') ?>
                                                    @if($e109!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e109['elemento']}}</label>
                                                        @if($e109['obligatorio']=='S')
                                                        <input type="number" name="tcif" id="tcif" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="tcif" id="tcif" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e110 = existe($conf, 'PAISIF') ?>
                                                    @if($e110!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e110['elemento']}}</label>
                                                        @if($e110 ['obligatorio']=='S')
                                                        {!! Form::select('paisif',$paises,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'paisif','onchange'=>'getEstados(this.id,"dtif","cte")']) !!}
                                                        @else
                                                        {!! Form::select('paisif',$paises,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'paisif','onchange'=>'getEstados(this.id,"dtif","cte")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e111 = existe($conf, 'DTIF') ?>
                                                    @if($e111!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e111['elemento']}}</label>
                                                        @if($e111 ['obligatorio']=='S')
                                                        {!! Form::select('dtif',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'dtif','onchange'=>'getCiudades(this.id,"cte")']) !!}
                                                        @else
                                                        {!! Form::select('dtif',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dtif','onchange'=>'getCiudades(this.id,"cte")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e112 = existe($conf, 'CTE') ?>
                                                    @if($e112!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e112['elemento']}}</label>
                                                        @if($e112 ['obligatorio']=='S')
                                                        {!! Form::select('cte',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'cte']) !!}
                                                        @else
                                                        {!! Form::select('cte',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cte']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e113 = existe($conf, 'STE') ?>
                                                    @if($e113!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e113['elemento']}}</label>
                                                        @if($e113['obligatorio']=='S')
                                                        <input type="text" name="ste" id="ste" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ste" id="ste" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e114 = existe($conf, 'TTIF') ?>
                                                    @if($e114!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e114['elemento']}}</label>
                                                        @if($e114['obligatorio']=='S')
                                                        <input type="number" name="ttif" id="ttif" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ttif" id="ttif" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e115 = existe($conf, 'CIF') ?>
                                                    @if($e115!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e115['elemento']}}</label>
                                                        @if($e115['obligatorio']=='S')
                                                        <input type="text" name="cif" id="cif" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cif" id="cif" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e116 = existe($conf, 'DE') ?>
                                                    @if($e116!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e116['elemento']}}</label>
                                                        @if($e116['obligatorio']=='S')
                                                        <input type="text" name="de" id="de" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="de" id="de" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e117 = existe($conf, 'IDE') ?>
                                                    @if($e117!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e117['elemento']}}</label>
                                                        @if($e117['obligatorio']=='S')
                                                        <input type="text" name="ide" id="ide" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ide" id="ide" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e118 = existe($conf, 'NC') ?>
                                                    @if($e118!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e118['elemento']}}</label>
                                                        @if($e118['obligatorio']=='S')
                                                        <input type="number" name="nc" id="nc" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="nc" id="nc" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb6()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Información Socioeconómica'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Información Socioeconómica</legend>
                                                <div class="form-group">
                                                    <?php $e119 = existe($conf, 'SDLP') ?>
                                                    @if($e119!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e119['elemento']}}</label>
                                                        @if($e119 ['obligatorio']=='S')
                                                        {!! Form::select('sdlp',['VIVOS Y CONVIVEN'=>'VIVOS Y CONVIVEN','VIVOS Y SEPARADOS'=>'VIVOS Y SEPARADOS','PADRE VIVO - MADRE DIFUNTA'=>'PADRE VIVO - MADRE DIFUNTA','MADRE VIVA - PADRE DIFUNTO'=>'MADRE VIVA - PADRE DIFUNTO','DIFUNTOS'=>'DIFUNTOS'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'sdlp']) !!}
                                                        @else
                                                        {!! Form::select('sdlp',['VIVOS Y CONVIVEN'=>'VIVOS Y CONVIVEN','VIVOS Y SEPARADOS'=>'VIVOS Y SEPARADOS','PADRE VIVO - MADRE DIFUNTA'=>'PADRE VIVO - MADRE DIFUNTA','MADRE VIVA - PADRE DIFUNTO'=>'MADRE VIVA - PADRE DIFUNTO','DIFUNTOS'=>'DIFUNTOS'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'sdlp']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e120 = existe($conf, 'NMF') ?>
                                                    @if($e120!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e120['elemento']}}</label>
                                                        @if($e120['obligatorio']=='S')
                                                        <input type="number" name="nmf" id="nmf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="nmf" id="nmf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e121 = existe($conf, 'PQT') ?>
                                                    @if($e121!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e121['elemento']}}</label>
                                                        @if($e121['obligatorio']=='S')
                                                        <input type="number" name="pqt" id="pqt" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pqt" id="pqt" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e122 = existe($conf, 'NHISE') ?>
                                                    @if($e122!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e122['elemento']}}</label>
                                                        @if($e122['obligatorio']=='S')
                                                        <input type="number" name="nhise" id="nhise" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="nhise" id="nhise" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e123 = existe($conf, 'PELH') ?>
                                                    @if($e123!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e123['elemento']}}</label>
                                                        @if($e123['obligatorio']=='S')
                                                        <input type="number" name="pelh" id="pelh" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pelh" id="pelh" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e124 = existe($conf, 'IMAF') ?>
                                                    @if($e124!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e124['elemento']}}</label>
                                                        @if($e124['obligatorio']=='S')
                                                        <input type="number" name="imaf" id="imaf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="imaf" id="imaf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e125 = existe($conf, 'EMAF') ?>
                                                    @if($e125!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e125['elemento']}}</label>
                                                        @if($e125['obligatorio']=='S')
                                                        <input type="number" name="emaf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="emaf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e126 = existe($conf, 'NHEU') ?>
                                                    @if($e126!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e126['elemento']}}</label>
                                                        @if($e126['obligatorio']=='S')
                                                        <input type="number" name="nheu" id="nheu" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="nheu" id="nheu" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e127 = existe($conf, 'VCSF') ?>
                                                    @if($e127!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e127['elemento']}}</label>
                                                        @if($e127 ['obligatorio']=='S')
                                                        {!! Form::select('vcsf',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'vcsf']) !!}
                                                        @else
                                                        {!! Form::select('vcsf',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'vcsf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e128 = existe($conf, 'NHCEU') ?>
                                                    @if($e128!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e128['elemento']}}</label>
                                                        @if($e128['obligatorio']=='S')
                                                        <input type="number" name="nhceu" id="nhceu" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="nhceu" id="nhceu" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e129 = existe($conf, 'CDSE') ?>
                                                    @if($e129!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e129['elemento']}}</label>
                                                        @if($e129 ['obligatorio']=='S')
                                                        {!! Form::select('cdse',['USTED MISMO'=>'USTED MISMO','PADRES'=>'PADRES','OTROS FAMILIARES'=>'OTROS FAMILIARES','BECA'=>'BECA','CREDITO EDUCATIVO'=>'CRÉDITO EDUCATIVO','EMPRESA'=>'EMPRESA','OTRO'=>'OTRO',],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'cdse']) !!}
                                                        @else
                                                        {!! Form::select('cdse',['USTED MISMO'=>'USTED MISMO','PADRES'=>'PADRES','OTROS FAMILIARES'=>'OTROS FAMILIARES','BECA'=>'BECA','CREDITO EDUCATIVO'=>'CRÉDITO EDUCATIVO','EMPRESA'=>'EMPRESA','OTRO'=>'OTRO',],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cdse']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e130 = existe($conf, 'EDR') ?>
                                                    @if($e130!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e130['elemento']}}</label>
                                                        @if($e130['obligatorio']=='S')
                                                        <input type="text" name="edr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="edr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e131 = existe($conf, 'EISE') ?>
                                                    @if($e131!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e131['elemento']}}</label>
                                                        @if($e131 ['obligatorio']=='S')
                                                        {!! Form::select('eise',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('eise',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e132 = existe($conf, 'SE') ?>
                                                    @if($e132!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e132['elemento']}}</label>
                                                        @if($e132 ['obligatorio']=='S')
                                                        {!! Form::select('se',['DEPENDIENTE'=>'DEPENDIENTE','IDENPENDIENTE'=>'IDENPENDIENTE','EMPLEADO'=>'EMPLEADO','OTRO'=>'OTRO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('se',['DEPENDIENTE'=>'DEPENDIENTE','IDENPENDIENTE'=>'IDENPENDIENTE','EMPLEADO'=>'EMPLEADO','OTRO'=>'OTRO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e133 = existe($conf, 'SELUE') ?>
                                                    @if($e133!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e133['elemento']}}</label>
                                                        @if($e133 ['obligatorio']=='S')
                                                        {!! Form::select('selue',['S'=>'SI','N'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('selue',['S'=>'SI','N'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e134 = existe($conf, 'RG') ?>
                                                    @if($e134!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e134['elemento']}}</label>
                                                        @if($e134['obligatorio']=='S')
                                                        <input type="number" name="rg" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="rg" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e135 = existe($conf, 'PG') ?>
                                                    @if($e135!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e135['elemento']}}</label>
                                                        @if($e135['obligatorio']=='S')
                                                        <input type="number" name="pg" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pg" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e136 = existe($conf, 'IYR') ?>
                                                    @if($e136!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e136['elemento']}}</label>
                                                        @if($e136['obligatorio']=='S')
                                                        <input type="number" name="iyr" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="iyr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e137 = existe($conf, 'TSISE') ?>
                                                    @if($e137!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e137['elemento']}}</label>
                                                        @if($e137 ['obligatorio']=='S')
                                                        {!! Form::select('tsise',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('tsise',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Nivel del SISBEN</label>
                                                        {!! Form::select('nivelsisben',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                    </div>
                                                    @endif
                                                    <?php $e138 = existe($conf, 'CCF') ?>
                                                    @if($e138!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e138['elemento']}}</label>
                                                        @if($e138 ['obligatorio']=='S')
                                                        {!! Form::select('ccf',$caja,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('ccf',$caja,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e139 = existe($conf, 'ING') ?>
                                                    @if($e139!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e139['elemento']}}</label>
                                                        @if($e139['obligatorio']=='S')
                                                        <input type="number" name="ing" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ing" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e140 = existe($conf, 'PB') ?>
                                                    @if($e140!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e140['elemento']}}</label>
                                                        @if($e140['obligatorio']=='S')
                                                        <input type="number" name="pb" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pb" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e141 = existe($conf, 'IB') ?>
                                                    @if($e141!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e141['elemento']}}</label>
                                                        @if($e141['obligatorio']=='S')
                                                        <input type="number" name="ib" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ib" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e142 = existe($conf, 'RNG') ?>
                                                    @if($e142!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e142['elemento']}}</label>
                                                        @if($e142['obligatorio']=='S')
                                                        <input type="number" name="rng" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="rng" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e143 = existe($conf, 'IG') ?>
                                                    @if($e143!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e143['elemento']}}</label>
                                                        @if($e143['obligatorio']=='S')
                                                        <input type="number" name="ig" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ig" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Posesión de Residencia'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Posesión de Residencia</legend>
                                                <h5>Escoja y rellene una de las opciones (propia, Propia Pagándose por Cuotas, Arrendada o Anticresada, Ninguna de las Anteriores)</h5>
                                                <div class="form-group">
                                                    <?php $e144 = existe($conf, 'PROPIA') ?>
                                                    @if($e144!==null)
                                                    <div class="col-md-12">
                                                        <label>{{$e144['elemento']}}</label>
                                                        @if($e144 ['obligatorio']=='S')
                                                        {!! Form::select('PROPIA',['PROPIA'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('PROPIA',['PROPIA'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e145 = existe($conf, 'PPPC') ?>
                                                    @if($e145!==null)
                                                    <div class="col-md-12">
                                                        <label>{{$e145['elemento']}}</label>
                                                        @if($e145 ['obligatorio']=='S')
                                                        {!! Form::select('pppc',['CASA PROPIA'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('pppc',['CASA PROPIA'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e146 = existe($conf, 'DDLV') ?>
                                                    @if($e146!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e146['elemento']}}</label>
                                                        @if($e146['obligatorio']=='S')
                                                        <input type="text" name="ddlv" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ddlv" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e147 = existe($conf, 'VMC') ?>
                                                    @if($e147!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e147['elemento']}}</label>
                                                        @if($e147['obligatorio']=='S')
                                                        <input type="number" name="vmc" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vmc" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e148 = existe($conf, 'NDC') ?>
                                                    @if($e148!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e148['elemento']}}</label>
                                                        @if($e148['obligatorio']=='S')
                                                        <input type="number" name="ndc" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ndc" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e149 = existe($conf, 'DDIH') ?>
                                                    @if($e149!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e149['elemento']}}</label>
                                                        @if($e149['obligatorio']=='S')
                                                        <input type="text" name="ddih" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ddih" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e150 = existe($conf, 'AOA') ?>
                                                    @if($e150!==null)
                                                    <div class="col-md-12">
                                                        <label>{{$e150['elemento']}}</label>
                                                        @if($e150 ['obligatorio']=='S')
                                                        {!! Form::select('aoa',['ARRENDADA'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('aoa',['ARRENDADA'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e151 = existe($conf, 'VMA') ?>
                                                    @if($e151!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e151['elemento']}}</label>
                                                        @if($e151['obligatorio']=='S')
                                                        <input type="number" name="vma" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vma" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e152 = existe($conf, 'VDAC') ?>
                                                    @if($e152!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e152['elemento']}}</label>
                                                        @if($e152['obligatorio']=='S')
                                                        <input type="number" name="vdac" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="vdac" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e153 = existe($conf, 'NDA') ?>
                                                    @if($e153!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e153['elemento']}}</label>
                                                        @if($e153['obligatorio']=='S')
                                                        <input type="text" name="nda" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="nda" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e154 = existe($conf, 'CDA') ?>
                                                    @if($e154!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e154['elemento']}}</label>
                                                        @if($e154['obligatorio']=='S')
                                                        <input type="text" name="cda" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cda" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e155 = existe($conf, 'DDA') ?>
                                                    @if($e155!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e155['elemento']}}</label>
                                                        @if($e155['obligatorio']=='S')
                                                        <input type="text" name="dda" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="dda" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e156 = existe($conf, 'TDA') ?>
                                                    @if($e156!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e156['elemento']}}</label>
                                                        @if($e156['obligatorio']=='S')
                                                        <input type="number" name="tda" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="tda" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e157 = existe($conf, 'NDLA') ?>
                                                    @if($e157!==null)
                                                    <div class="col-md-12">
                                                        <label>{{$e157['elemento']}}</label>
                                                        @if($e157 ['obligatorio']=='S')
                                                        {!! Form::select('ndla',['NINGUNA POSESION'=>'NINGUNA DE LAS ANTERIORES','NO'=>'SI TIENE TIPO DE POSESIÓN'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('ndla',['NINGUNA POSESION'=>'NINGUNA DE LAS ANTERIORES','NO'=>'SI TIENE TIPO DE POSESIÓN'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Jefes de Familia'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Jefes de Familia</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb7" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cédula</th>
                                                                    <th>Nombre</th>
                                                                    <th>Tipo Documento</th>
                                                                    <th>Empresa</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e301 = existe($conf, 'TDJF') ?>
                                                    @if($e301!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e301['elemento']}}</label>
                                                        @if($e301['obligatorio']=='S')
                                                        {!! Form::select('tdjf',$td,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'tdjf']) !!}
                                                        @else
                                                        {!! Form::select('tdjf',$td,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'tdjf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e302 = existe($conf, 'CJFA') ?>
                                                    @if($e302!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e302['elemento']}}</label>
                                                        @if($e302['obligatorio']=='S')
                                                        <input type="number" name="cjfa" id="cjfa" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="cjfa" id="cjfa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e158 = existe($conf, 'NCJF') ?>
                                                    @if($e158!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e158['elemento']}}</label>
                                                        @if($e158['obligatorio']=='S')
                                                        <input type="text" name="ncjf" id="ncjf" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ncjf" id="ncjf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e159 = existe($conf, 'EDT') ?>
                                                    @if($e159!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e159['elemento']}}</label>
                                                        @if($e159['obligatorio']=='S')
                                                        <input type="text" name="edt" id="edt" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="edt" id="edt" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e160 = existe($conf, 'CJF') ?>
                                                    @if($e160!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e160['elemento']}}</label>
                                                        @if($e160['obligatorio']=='S')
                                                        <input type="text" name="cjf" id="cjf" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cjf" id="cjf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e161 = existe($conf, 'TDSJF') ?>
                                                    @if($e161!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e161['elemento']}}</label>
                                                        @if($e161['obligatorio']=='S')
                                                        <input type="text" name="tdsjf" id="tdsjf" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="tdsjf" id="tdsjf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e162 = existe($conf, 'SUELDO') ?>
                                                    @if($e162!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e162['elemento']}}</label>
                                                        @if($e162['obligatorio']=='S')
                                                        <input type="number" name="sueldo" id="sueldo" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="sueldo" id="sueldo" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e163 = existe($conf, 'JIJF') ?>
                                                    @if($e163!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e163['elemento']}}</label>
                                                        @if($e163['obligatorio']=='S')
                                                        <input type="text" name="jijf" id="jijf" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="jijf" id="jijf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e164 = existe($conf, 'ADDJF') ?>
                                                    @if($e164!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e164['elemento']}}</label>
                                                        @if($e164['obligatorio']=='S')
                                                        <input type="text" name="addjf" id="addjf" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="addjf" id="addjf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e165 = existe($conf, 'TTJF') ?>
                                                    @if($e165!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e165['elemento']}}</label>
                                                        @if($e165['obligatorio']=='S')
                                                        <input type="number" name="ttjf" id="ttjf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ttjf" id="ttjf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e166 = existe($conf, 'PAC') ?>
                                                    @if($e166!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e166['elemento']}}</label>
                                                        @if($e166['obligatorio']=='S')
                                                        <input type="number" name="pac" id="pac" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="pac" id="pac" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e167 = existe($conf, 'QEJF') ?>
                                                    @if($e167!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e167['elemento']}}</label>
                                                        @if($e167['obligatorio']=='S')
                                                        {!! Form::select('qejf',['1'=>'PADRE','2'=>'MADRE','0'=>'NINGUNO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'qejf']) !!}
                                                        @else
                                                        {!! Form::select('qejf',['1'=>'PADRE','2'=>'MADRE','0'=>'NINGUNO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'qejf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e168 = existe($conf, 'DJF') ?>
                                                    @if($e168!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e168['elemento']}}</label>
                                                        @if($e168 ['obligatorio']=='S')
                                                        {!! Form::select('djf',$dptos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'djf','onchange'=>'getCiudades(this.id,"mc")']) !!}
                                                        @else
                                                        {!! Form::select('djf',$dptos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'djf','onchange'=>'getCiudades(this.id,"mc")']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e169 = existe($conf, 'MC') ?>
                                                    @if($e169!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e169['elemento']}}</label>
                                                        @if($e169['obligatorio']=='S')
                                                        {!! Form::select('mc',[],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'mc']) !!}
                                                        @else
                                                        {!! Form::select('mc',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'mc']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e170 = existe($conf, 'DJFA') ?>
                                                    @if($e170!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e170['elemento']}}</label>
                                                        @if($e170['obligatorio']=='S')
                                                        <input type="text" name="djfa" id="djfa" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="djfa" id="djfa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e171 = existe($conf, 'PJF') ?>
                                                    @if($e171!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e171['elemento']}}</label>
                                                        @if($e171['obligatorio']=='S')
                                                        {!! Form::select('pjf',$parent,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pjf']) !!}
                                                        @else
                                                        {!! Form::select('pjf',$parent,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pjf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e172 = existe($conf, 'CELULAR') ?>
                                                    @if($e172!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e172['elemento']}}</label>
                                                        @if($e172['obligatorio']=='S')
                                                        <input type="number" name="celular" id="celular" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="celular" id="celular" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e173 = existe($conf, 'NEJF') ?>
                                                    @if($e173!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e173['elemento']}}</label>
                                                        @if($e173['obligatorio']=='S')
                                                        {!! Form::select('nejf',['NINGUNO'=>'NINGUNO','PRIMARIA'=>'PRIMARIA','SECUNDARIA'=>'SECUNDARIA','TECNICO'=>'TECNICO','UNIVERSITARIO'=>'UNIVERSITARIO','POSTGRADO'=>'POSTGRADO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'nejf']) !!}
                                                        @else
                                                        {!! Form::select('nejf',['NINGUNO'=>'NINGUNO','PRIMARIA'=>'PRIMARIA','SECUNDARIA'=>'SECUNDARIA','TECNICO'=>'TECNICO','UNIVERSITARIO'=>'UNIVERSITARIO','POSTGRADO'=>'POSTGRADO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'nejf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e174 = existe($conf, 'OJF') ?>
                                                    @if($e174!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e174['elemento']}}</label>
                                                        @if($e174['obligatorio']=='S')
                                                        {!! Form::select('ojf',$ocpl,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'ojf']) !!}
                                                        @else
                                                        {!! Form::select('ojf',$ocpl,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ojf']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb7()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </fieldset>
                                        <h3>Laboral</h3>
                                        <fieldset>
                                            @if(existePanel($conf,'Experiencia Profesional'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Experiencia Profesional</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb8" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Cargo</th>
                                                                    <th>Fecha Ingreso</th>
                                                                    <th>Fecha Retiro</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e175 = existe($conf, 'IEP') ?>
                                                    @if($e175!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e175['elemento']}}</label>
                                                        @if($e175['obligatorio']=='S')
                                                        <input type="text" name="iep" id="iep" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="iep" id="iep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e176 = existe($conf, 'CEP') ?>
                                                    @if($e176!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e176['elemento']}}</label>
                                                        @if($e176['obligatorio']=='S')
                                                        <input type="text" name="cep" id="cep" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cep" id="cep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e177 = existe($conf, 'SM') ?>
                                                    @if($e177!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e177['elemento']}}</label>
                                                        @if($e177['obligatorio']=='S')
                                                        {!! Form::select('sm',$rangos,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'sm']) !!}
                                                        @else
                                                        {!! Form::select('sm',$rangos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'sm']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e178 = existe($conf, 'FI') ?>
                                                    @if($e178!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e178['elemento']}}</label>
                                                        @if($e178['obligatorio']=='S')
                                                        <input type="date" name="fi" id="fi" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fi" id="fi" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e179 = existe($conf, 'FR') ?>
                                                    @if($e179!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e179['elemento']}}</label>
                                                        @if($e179['obligatorio']=='S')
                                                        <input type="date" name="fr" id="fr" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fr" id="fr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e180 = existe($conf, 'TTEP') ?>
                                                    @if($e180!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e180['elemento']}}</label>
                                                        @if($e180['obligatorio']=='S')
                                                        <input type="number" name="ttep" id="ttep" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="ttep" id="ttep" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb8()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Experiencia Docente'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Experiencia Docente</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb9" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Nivel</th>
                                                                    <th>Área o Asignatura</th>
                                                                    <th>Tiempo de Servicio</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e181 = existe($conf, 'IED') ?>
                                                    @if($e181!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e181['elemento']}}</label>
                                                        @if($e181['obligatorio']=='S')
                                                        <input type="text" name="ied" id="ied" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ied" id="ied" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e182 = existe($conf, 'NED') ?>
                                                    @if($e182!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e182['elemento']}}</label>
                                                        @if($e182['obligatorio']=='S')
                                                        <input type="text" name="ned" id="ned" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ned" id="ned" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e183 = existe($conf, 'AA') ?>
                                                    @if($e183!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e183['elemento']}}</label>
                                                        @if($e183['obligatorio']=='S')
                                                        <input type="text" name="aa" id="aa" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="aa" id="aa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e184 = existe($conf, 'TSED') ?>
                                                    @if($e184!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e184['elemento']}}</label>
                                                        @if($e184['obligatorio']=='S')
                                                        <input type="text" name="tsed" id="tsed" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="tsed" id="tsed" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb9()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Experiencia en Investigación'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Experiencia en Investigación</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb10" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Proyecto</th>
                                                                    <th>Cargo</th>
                                                                    <th>Año</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e185 = existe($conf, 'IEI') ?>
                                                    @if($e185!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e185['elemento']}}</label>
                                                        @if($e185['obligatorio']=='S')
                                                        <input type="text" name="iei" id="iei" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="iei" id="iei" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e186 = existe($conf, 'PEI') ?>
                                                    @if($e186!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e186['elemento']}}</label>
                                                        @if($e186['obligatorio']=='S')
                                                        <input type="text" name="pei" id="pei" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="pei" id="pei" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e187 = existe($conf, 'CEI') ?>
                                                    @if($e187!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e187['elemento']}}</label>
                                                        @if($e187['obligatorio']=='S')
                                                        <input type="text" name="cei" id="cei" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cei" id="cei" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e188 = existe($conf, 'AEI') ?>
                                                    @if($e188!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e188['elemento']}}</label>
                                                        @if($e188['obligatorio']=='S')
                                                        <input type="text" name="aei" id="aei" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="aei" id="aei" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb10()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Referencias'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Referencias</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb11" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Dirección</th>
                                                                    <th>Teléfono</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e189 = existe($conf, 'NR') ?>
                                                    @if($e189!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e189['elemento']}}</label>
                                                        @if($e189['obligatorio']=='S')
                                                        <input type="text" name="nr" id="nr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="nr" id="nr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e190 = existe($conf, 'DR') ?>
                                                    @if($e190!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e190['elemento']}}</label>
                                                        @if($e190['obligatorio']=='S')
                                                        <input type="text" name="dr" id="dr" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="dr" id="dr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e191 = existe($conf, 'TR') ?>
                                                    @if($e191!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e191['elemento']}}</label>
                                                        @if($e191['obligatorio']=='S')
                                                        <input type="number" name="tr" id="tr" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="tr" id="tr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb11()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </fieldset>
                                        <h3>Más Info</h3>
                                        <fieldset>
                                            @if(existePanel($conf,'Asociaciones Científicas, Sociales y Culturales'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Asociaciones Científicas, Sociales y Culturales</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb12" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Objeto Social</th>
                                                                    <th>Fecha Ingreso</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e192 = existe($conf, 'NACSC') ?>
                                                    @if($e192!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e192['elemento']}}</label>
                                                        @if($e192['obligatorio']=='S')
                                                        <input type="text" name="nacsc" id="nacsc" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="nacsc" id="nacsc" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e193 = existe($conf, 'OS') ?>
                                                    @if($e193!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e193['elemento']}}</label>
                                                        @if($e193['obligatorio']=='S')
                                                        <input type="text" name="os" id="os" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="os" id="os" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e194 = existe($conf, 'FIACSC') ?>
                                                    @if($e194!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e194['elemento']}}</label>
                                                        @if($e194['obligatorio']=='S')
                                                        <input type="date" name="fiacsc" id="fiacsc" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fiacsc" id="fiacsc" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb12()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Idiomas'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Idiomas</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb13" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Idioma</th>
                                                                    <th>Comprende al Oír</th>
                                                                    <th>Habla</th>
                                                                    <th>Lee</th>
                                                                    <th>Escribe</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e195 = existe($conf, 'I') ?>
                                                    @if($e195!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e195['elemento']}}</label>
                                                        @if($e195['obligatorio']=='S')
                                                        {!! Form::select('i',$idiomas,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'i']) !!}
                                                        @else
                                                        {!! Form::select('i',$idiomas,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'i']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e196 = existe($conf, 'CO') ?>
                                                    @if($e196!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e196['elemento']}}</label>
                                                        @if($e196['obligatorio']=='S')
                                                        {!! Form::select('co',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'co']) !!}
                                                        @else
                                                        {!! Form::select('co',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'co']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e197 = existe($conf, 'H') ?>
                                                    @if($e197!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e197['elemento']}}</label>
                                                        @if($e197['obligatorio']=='S')
                                                        {!! Form::select('h',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'h']) !!}
                                                        @else
                                                        {!! Form::select('h',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'h']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e198 = existe($conf, 'L') ?>
                                                    @if($e198!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e198['elemento']}}</label>
                                                        @if($e198['obligatorio']=='S')
                                                        {!! Form::select('l',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'l']) !!}
                                                        @else
                                                        {!! Form::select('l',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'l']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e199 = existe($conf, 'E') ?>
                                                    @if($e199!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e199['elemento']}}</label>
                                                        @if($e196['obligatorio']=='S')
                                                        {!! Form::select('e',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'e']) !!}
                                                        @else
                                                        {!! Form::select('e',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'e']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb13()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Pasatiempos'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Pasatiempos</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb14" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Patatiempo de Preferencia</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e200 = existe($conf, 'PP') ?>
                                                    @if($e200!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e200['elemento']}}</label>
                                                        @if($e200['obligatorio']=='S')
                                                        {!! Form::select('pp',$pasat,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pp']) !!}
                                                        @else
                                                        {!! Form::select('pp',$pasat,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pp']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb14()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Información de Caracterización'))
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Información de Caracterización</legend>
                                                <div class="form-group">
                                                    <?php $e201 = existe($conf, 'PD') ?>
                                                    @if($e201!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e201['elemento']}}</label>
                                                        @if($e201['obligatorio']=='S')
                                                        {!! Form::select('pd',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'pd']) !!}
                                                        @else
                                                        {!! Form::select('pd',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'pd']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e202 = existe($conf, 'CD') ?>
                                                    @if($e202!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e202['elemento']}}</label>
                                                        @if($e202['obligatorio']=='S')
                                                        <input type="text" name="cd" id="cd" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="cd" id="cd" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e203 = existe($conf, 'FP') ?>
                                                    @if($e203!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e203['elemento']}}</label>
                                                        @if($e203['obligatorio']=='S')
                                                        <input type="text" name="fp" id="fp" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="fp" id="fp" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e204 = existe($conf, 'FLP') ?>
                                                    @if($e204!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e204['elemento']}}</label>
                                                        @if($e204['obligatorio']=='S')
                                                        {!! Form::select('flp',['HOBBIE'=>'HOBBIE','COMPETITIVO'=>'COMPETITIVO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'flp']) !!}
                                                        @else
                                                        {!! Form::select('flp',['HOBBIE'=>'HOBBIE','COMPETITIVO'=>'COMPETITIVO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'flp']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e205 = existe($conf, 'PNPD') ?>
                                                    @if($e205!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e205['elemento']}}</label>
                                                        @if($e205['obligatorio']=='S')
                                                        <input type="text" name="pnpd" id="pnpd" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="pnpd" id="pnpd" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e206 = existe($conf, 'ECP') ?>
                                                    @if($e206!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e206['elemento']}}</label>
                                                        @if($e206['obligatorio']=='S')
                                                        <input type="text" name="ecp" id="ecp" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ecp" id="ecp" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e207 = existe($conf, 'FCA') ?>
                                                    @if($e207!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e207['elemento']}}</label>
                                                        @if($e207['obligatorio']=='S')
                                                        <input type="text" name="fca" id="fca" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="fca" id="fca" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e208 = existe($conf, 'PAA') ?>
                                                    @if($e208!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e208['elemento']}}</label>
                                                        @if($e208['obligatorio']=='S')
                                                        {!! Form::select('paa',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'paa']) !!}
                                                        @else
                                                        {!! Form::select('paa',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'paa']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e209 = existe($conf, 'CAA') ?>
                                                    @if($e209!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e209['elemento']}}</label>
                                                        @if($e209['obligatorio']=='S')
                                                        <input type="text" name="caa" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="caa" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e210 = existe($conf, 'FELP') ?>
                                                    @if($e210!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e210['elemento']}}</label>
                                                        @if($e210['obligatorio']=='S')
                                                        {!! Form::select('felp',['AFICCIONADO'=>'AFICCIONADO','PROFESIONAL'=>'PROFESIONAL'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'felp']) !!}
                                                        @else
                                                        {!! Form::select('felp',['AFICCIONADO'=>'AFICCIONADO','PROFESIONAL'=>'PROFESIONAL'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'felp']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e211 = existe($conf, 'EOTL') ?>
                                                    @if($e211!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e211['elemento']}}</label>
                                                        @if($e211['obligatorio']=='S')
                                                        <input type="text" name="eotl" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="eotl" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e212 = existe($conf, 'F') ?>
                                                    @if($e212!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e212['elemento']}}</label>
                                                        @if($e212['obligatorio']=='S')
                                                        {!! Form::select('f',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'f']) !!}
                                                        @else
                                                        {!! Form::select('f',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'f']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e213 = existe($conf, 'CCPD') ?>
                                                    @if($e213!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e213['elemento']}}</label>
                                                        @if($e213['obligatorio']=='S')
                                                        <input type="text" name="ccpd" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ccpd" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e214 = existe($conf, 'CL') ?>
                                                    @if($e214!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e214['elemento']}}</label>
                                                        @if($e214['obligatorio']=='S')
                                                        {!! Form::select('cl',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'cl']) !!}
                                                        @else
                                                        {!! Form::select('cl',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cl']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e215 = existe($conf, 'CQFCL') ?>
                                                    @if($e215!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e215['elemento']}}</label>
                                                        @if($e215['obligatorio']=='S')
                                                        {!! Form::select('cqfcl',['DIARIO'=>'DIARIO','SEMANAL'=>'SEMANAL','OCASIONAL'=>'OCASIONAL'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'cqfcl']) !!}
                                                        @else
                                                        {!! Form::select('cqfcl',['DIARIO'=>'DIARIO','SEMANAL'=>'SEMANAL','OCASIONAL'=>'OCASIONAL'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cqfcl']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e216 = existe($conf, 'CSSA') ?>
                                                    @if($e216!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e216['elemento']}}</label>
                                                        @if($e216['obligatorio']=='S')
                                                        {!! Form::select('cssa',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'cssa']) !!}
                                                        @else
                                                        {!! Form::select('cssa',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cssa']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e217 = existe($conf, 'CQFCSSA') ?>
                                                    @if($e217!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e217['elemento']}}</label>
                                                        @if($e217['obligatorio']=='S')
                                                        {!! Form::select('cqfcssa',['DIARIO'=>'DIARIO','SEMANAL'=>'SEMANAL','OCASIONAL'=>'OCASIONAL'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('cqfcssa',['DIARIO'=>'DIARIO','SEMANAL'=>'SEMANAL','OCASIONAL'=>'OCASIONAL'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e218 = existe($conf, 'HTRS') ?>
                                                    @if($e218!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e218['elemento']}}</label>
                                                        @if($e218['obligatorio']=='S')
                                                        {!! Form::select('htrs',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('htrs',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e219 = existe($conf, 'EPR') ?>
                                                    @if($e219!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e219['elemento']}}</label>
                                                        @if($e219['obligatorio']=='S')
                                                        <input type="number" name="epr" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="epr" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e220 = existe($conf, 'MA') ?>
                                                    @if($e220!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e220['elemento']}}</label>
                                                        @if($e220['obligatorio']=='S')
                                                        <input type="text" name="ma" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ma" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e221 = existe($conf, 'NH') ?>
                                                    @if($e221!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e221['elemento']}}</label>
                                                        @if($e221['obligatorio']=='S')
                                                        <input type="text" name="nh" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="nh" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e222 = existe($conf, 'GASM') ?>
                                                    @if($e222!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e222['elemento']}}</label>
                                                        @if($e222['obligatorio']=='S')
                                                        {!! Form::select('gasm',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('gasm',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e223 = existe($conf, 'SDSM') ?>
                                                    @if($e223!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e223['elemento']}}</label>
                                                        @if($e218['obligatorio']=='S')
                                                        {!! Form::select('sdsm',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('sdsm',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e224 = existe($conf, 'GCC') ?>
                                                    @if($e224!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e224['elemento']}}</label>
                                                        @if($e224['obligatorio']=='S')
                                                        {!! Form::select('gcc',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('gcc',['ALTO'=>'ALTO','MEDIO'=>'MEDIO','BAJO'=>'BAJO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if(existePanel($conf,'Información Adicional'))
                                            <!--<div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Información Adicional</legend>
                                                <div class="form-group">
                                                    <p style="color:red;">No se encontraron preguntas abiertas.</p>
                                                </div>
                                            </div>-->
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Instituciones Donde ha Solicitado Admisión</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb15" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Institución</th>
                                                                    <th>Programa</th>
                                                                    <th>Año</th>
                                                                    <th>Aceptado</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <label>Departamento</label>
                                                        {!! Form::select('dptola',$dptos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'dptola','onchange'=>'getCiudades(this.id,"ciudadla")']) !!}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Ciudad</label>
                                                        {!! Form::select('ciudadla',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'ciudadla','onchange'=>'getIes(this.id,"iesla")']) !!}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Institución</label>
                                                        {!! Form::select('iesla',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'iesla']) !!}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Programa</label>
                                                        <input type="text" name="prla" id="prla" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Año</label>
                                                        <input type="number" name="aniola" id="aniola" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Aceptado</label>
                                                        {!! Form::select('aceptadola',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'aceptadola']) !!}
                                                    </div>
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb15()">Agregar</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </fieldset>
                                        @if(existePanel($conf,'Datos de Discapacitados'))
                                        <h3>Discapacidades</h3>
                                        <fieldset>
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Datos de Discapacitados</legend>
                                                <div class="col-md-12">
                                                    <div class="responsive-table">
                                                        <table id="tb16" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>Nombre</th>
                                                                    <th>Fecha de Diagnóstico</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php $e225 = existe($conf, 'TDI') ?>
                                                    @if($e225!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e225['elemento']}}</label>
                                                        @if($e225['obligatorio']=='S')
                                                        {!! Form::select('tdi',$tdisc,null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --','id'=>'tdi']) !!}
                                                        @else
                                                        {!! Form::select('tdi',$tdisc,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'tdi']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e226 = existe($conf, 'NDLD') ?>
                                                    @if($e226!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e226['elemento']}}</label>
                                                        @if($e226['obligatorio']=='S')
                                                        <input type="text" name="ndld" id="ndld" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="ndld" id="ndld" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e227 = existe($conf, 'FDI') ?>
                                                    @if($e227!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e227['elemento']}}</label>
                                                        @if($e227['obligatorio']=='S')
                                                        <input type="date" name="fdi" id="fdi" class="form-control required"/>
                                                        @else
                                                        <input type="date" name="fdi" id="fdi" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if($e225!==null)
                                                    <div class="col-md-3" style="margin-top: 20px;">
                                                        <p class="btn btn-success btn-block btn-sm" onclick="agregarTb16()">Agregar</p>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <legend>Otros Datos</legend>
                                                <div class="form-group">
                                                    <?php $e228 = existe($conf, 'TIENEHIJOS') ?>
                                                    @if($e228!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e228['elemento']}}</label>
                                                        @if($e228['obligatorio']=='S')
                                                        {!! Form::select('tienehijos',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('tienehijos',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e229 = existe($conf, 'CHDI') ?>
                                                    @if($e229!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e229['elemento']}}</label>
                                                        @if($e229['obligatorio']=='S')
                                                        <input type="number" name="chdi" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="chdi" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e230 = existe($conf, 'SISBEN') ?>
                                                    @if($e230!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e230['elemento']}}</label>
                                                        @if($e230['obligatorio']=='S')
                                                        {!! Form::select('sisben',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('sisben',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e231 = existe($conf, 'DESPLAZADO') ?>
                                                    @if($e231!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e231['elemento']}}</label>
                                                        @if($e231['obligatorio']=='S')
                                                        {!! Form::select('desplazado',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('desplazado',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e232 = existe($conf, 'LABORA') ?>
                                                    @if($e232!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e232['elemento']}}</label>
                                                        @if($e232['obligatorio']=='S')
                                                        {!! Form::select('labora',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('labora',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e233 = existe($conf, 'TCS') ?>
                                                    @if($e233!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e233['elemento']}}</label>
                                                        @if($e233['obligatorio']=='S')
                                                        <input type="number" name="tcs" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="tcs" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e234 = existe($conf, 'CEC') ?>
                                                    @if($e234!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e234['elemento']}}</label>
                                                        @if($e234['obligatorio']=='S')
                                                        <input type="email" name="cec" class="form-control required"/>
                                                        @else
                                                        <input type="email" name="cec" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e235 = existe($conf, 'CPTGF') ?>
                                                    @if($e235!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e235['elemento']}}</label>
                                                        @if($e235['obligatorio']=='S')
                                                        <input type="number" name="cptgf" class="form-control required"/>
                                                        @else
                                                        <input type="number" name="cptgf" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e236 = existe($conf, 'CCEC') ?>
                                                    @if($e236!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e236['elemento']}}</label>
                                                        @if($e236['obligatorio']=='S')
                                                        {!! Form::select('ccec',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control required','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @else
                                                        {!! Form::select('ccec',['SI'=>'SI','NO'=>'NO'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <?php $e237 = existe($conf, 'EAIE') ?>
                                                    @if($e237!==null)
                                                    <div class="col-md-3">
                                                        <label>{{$e237['elemento']}}</label>
                                                        @if($e237['obligatorio']=='S')
                                                        <input type="text" name="eaie" class="form-control required"/>
                                                        @else
                                                        <input type="text" name="eaie" class="form-control"/>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </fieldset>
                                        @endif
                                        @if($p!==null)
                                        <h3>Finalizar</h3>
                                        <fieldset>
                                            @if($p->usatextodespues=='1')
                                            <p>{!!$p->textodespues!!}</p>
                                            @endif
                                        </fieldset>
                                        @endif
                                    </form>                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                                                                $("#eps_mostrar").hide();
                                                                $("#rtapin").hide();
                                                                var form = $("#example1").show();

                                                                form.steps({
                                                                    headerTag: "h3",
                                                                    bodyTag: "fieldset",
                                                                    transitionEffect: "slideLeft",
                                                                    onStepChanging: function (event, currentIndex, newIndex)
                                                                    {
                                                                        // Allways allow previous action even if the current form is not valid!
                                                                        if (currentIndex > newIndex)
                                                                        {
                                                                            return true;
                                                                        }
                                                                        // Forbid next action on "Warning" step if the user is to young
                                                                        if (newIndex === 3 && Number($("#age-2").val()) < 18)
                                                                        {
                                                                            return false;
                                                                        }
                                                                        // Needed in some cases if the user went back (clean up)
                                                                        if (currentIndex < newIndex)
                                                                        {
                                                                            // To remove error styles
                                                                            form.find(".body:eq(" + newIndex + ") label.error").remove();
                                                                            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                                                                        }
                                                                        form.validate().settings.ignore = ":disabled,:hidden";
                                                                        return form.valid();
                                                                    },
                                                                    onFinishing: function (event, currentIndex)
                                                                    {
                                                                        form.validate().settings.ignore = ":disabled";
                                                                        return form.valid();
                                                                    },
                                                                    onFinished: function (event, currentIndex)
                                                                    {
                                                                        form.submit();
                                                                    }
                                                                }).validate({
                                                                    errorPlacement: function errorPlacement(error, element) {
                                                                        element.before(error);
                                                                    },
                                                                    rules: {
                                                                        confirm: {
                                                                            equalTo: "#password-2"
                                                                        }
                                                                    }
                                                                });
                                                            });

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

                                                            function mostrar() {
                                                                if ($("#eps").val() === "OTRA") {
                                                                    $("#eps_mostrar").fadeIn();
                                                                    $("#aspi_eps").val($("#eps").val());
                                                                }
                                                            }

                                                            function getEstados(name, dpto, ciudad) {
                                                                var id = $("#" + name).val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "paisp/" + id + "/estados",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#' + dpto + ' option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    $('#' + ciudad + ' option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $.each(m, function (index, item) {
                                                                            $("#" + dpto).append("<option value='" + item.id + "'>" + item.value + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'El País seleccionado no posee información de estados.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function getCiudades(name, ciudad) {
                                                                var id = $("#" + name).val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "estadop/" + id + "/ciudades",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#' + ciudad + ' option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $.each(m, function (index, item) {
                                                                            $("#" + ciudad).append("<option value='" + item.id + "'>" + item.value + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'El Estado seleccionado no posee información de ciudades.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function notify(title, text, type) {
                                                                new PNotify({
                                                                    title: title,
                                                                    text: text,
                                                                    type: type,
                                                                    styling: 'bootstrap3'
                                                                });
                                                            }

                                                            function sector() {
                                                                var id = $("#ciudad2_id").val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "ciudadp/" + id + "/sectores",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#sectorciudad_id option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $("#sectorciudad_id").append("<option value='0'>-- Seleccione opción --</option>");
                                                                        $.each(m, function (index, item) {
                                                                            $("#sectorciudad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'La ciudad seleccionada no posee información de sectores.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function barrio() {
                                                                var id = $("#sectorciudad_id").val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "sectorp/" + id + "/barrios",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#barrio_id option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $("#barrio_id").append("<option value='0'>-- Seleccione opción --</option>");
                                                                        $.each(m, function (index, item) {
                                                                            $("#barrio_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'El sector seleccionado no posee información de barrios.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function getIem(ciudad, iem) {
                                                                var id = $("#" + ciudad).val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "iemp/" + id + "/instituciones",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#' + iem + ' option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $("#" + iem).append("<option value='0'>-- Seleccione opción --</option>");
                                                                        $.each(m, function (index, item) {
                                                                            $("#" + iem).append("<option value='" + index + "'>" + item + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'La ciudad seleccionada no posee información de instituciones.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function getIes(ciudad, ies) {
                                                                var id = $("#" + ciudad).val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "iesp/" + id + "/instituciones",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    $('#' + ies + ' option').each(function () {
                                                                        $(this).remove();
                                                                    });
                                                                    if (msg !== "null") {
                                                                        var m = JSON.parse(msg);
                                                                        $("#" + ies).append("<option value='0'>-- Seleccione opción --</option>");
                                                                        $.each(m, function (index, item) {
                                                                            $("#" + ies).append("<option value='" + index + "'>" + item + "</option>");
                                                                        });
                                                                    } else {
                                                                        notify('Atención', 'La ciudad seleccionada no posee información de instituciones.', 'error');
                                                                    }
                                                                });
                                                            }

                                                            function validarAspirante() {
                                                                var sp = $("#serp").val();
                                                                var nd = $("#numero_documento").val();
                                                                var pin = $("#pin").val();
                                                                var serpe = $("#serpe").val();
                                                                var procesoa = $("#procesoa").val();
                                                                var n = "{{$nivelid}}";
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "inscripcion/" + sp + "/" + nd + "/validaraspirante",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    if (msg !== "NO") {
                                                                        if (confirm('Usted ya realizó el proceso de inscripción para un programa académico en éste período. Si desea inscribirse en otro programa además del ya inscrito presione Aceptar, de lo contrario presione Cancelar')) {
                                                                            location.href = url + "inscripciones/" + msg + "/" + sp + "/" + pin + "/" + n + "/" + serpe + "/" + procesoa + "/inscripcion2";
                                                                        }
                                                                    }
                                                                });
                                                            }

                                                            function validarPin() {
                                                                var nd = $("#numero_documento").val();
                                                                if (nd.length == 0) {
                                                                    notify('Alerta', 'No puede verificar el pin sin el número de documento de identidad.', 'error');
                                                                    return;
                                                                }
                                                                var pin = $("#pin").val();
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: url + "pinp/" + pin + "/validarpin",
                                                                    data: {},
                                                                }).done(function (msg) {
                                                                    if (msg === "YA") {
                                                                        $("#rtapin").html("</br><p style='font-size:20px; color:red;'>El PIN ingresado ya fue usado por un aspirante para su inscripción, no puede continuar con el proceso de inscripción. Si continua, la información no será guardada. <b>NOTA:</b> Si usted adquirió el pin y no lo ha usado, dirijase a la oficina de Registro y Control Académico para verificar su situación.</p>");
                                                                        $("#rtapin").fadeIn();
                                                                    }
                                                                    if (msg === "SI") {
                                                                        $("#rtapin").html("</br><p style='font-size:20px; color:green;'>PIN válido, puede continuar con el proceso de inscripción.</p>");
                                                                        $("#rtapin").fadeIn();
                                                                        validarAspirante();
                                                                    }
                                                                    if (msg === "NO") {
                                                                        $("#rtapin").html("</br><p style='font-size:20px; color:red;'>PIN inválido, no puede continuar con el proceso de inscripción. Si continua, la información no será guardada.</p>");
                                                                        $("#rtapin").fadeIn();
                                                                    }
                                                                });
                                                            }

                                                            $(document).on('click', '.tb1Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb2Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb3Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb4Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb5Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb6Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb7Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb8Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb9Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb10Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb11Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb12Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });
                                                            $(document).on('click', '.tb13Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });
                                                            $(document).on('click', '.tb14Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });
                                                            $(document).on('click', '.tb15Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            $(document).on('click', '.tb16Clear', function (event) {
                                                                event.preventDefault();
                                                                $(this).closest('tr').remove();
                                                            });

                                                            function agregarTb1() {
                                                                var inst = 0;
                                                                var instn = "";
                                                                var f1 = null;
                                                                var f2 = null;
                                                                if (existeEl("iem2_id")) {
                                                                    inst = $("#iem2_id").val();
                                                                    instn = $("#iem2_id option:selected").text();
                                                                    if (existeEl("fechainicial_iem")) {
                                                                        f1 = $("#fechainicial_iem").val();
                                                                    }
                                                                    if (existeEl("fechafinal_iem")) {
                                                                        f2 = $("#fechafinal_iem").val();
                                                                    }
                                                                    $("#tb1").append("<tr><input name='tb1[]' type='hidden' value='" + inst + ";" + f1 + ";" + f2 + "'><td>" + instn + "</td><td>" + f1 + "</td><td>" + f2 + "</td><td><button type='button' class='tb1Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                                } else {
                                                                    notify('Alerta', 'No hay Institución válida para agregar.', 'error');
                                                                }
                                                            }

                                                            function agregarTb2() {
                                                                var inst = 0;
                                                                var instn = "";
                                                                var pepr = "";
                                                                var scep = "";
                                                                var ftep = null;
                                                                var ntp = "";
                                                                var crep = "";
                                                                var eecaes = "";
                                                                var recaes = "";
                                                                var pecaes = "";
                                                                if (existeEl("ies_id")) {
                                                                    inst = $("#ies_id").val();
                                                                    instn = $("#ies_id option:selected").text();
                                                                    if (existeEl("pepr")) {
                                                                        pepr = $("#pepr").val();
                                                                    }
                                                                    if (existeEl("scep")) {
                                                                        scep = $("#scep").val();
                                                                    }
                                                                    if (existeEl("ftep")) {
                                                                        ftep = $("#ftep").val();
                                                                    }
                                                                    if (existeEl("ntp")) {
                                                                        ntp = $("#ntp").val();
                                                                    }
                                                                    if (existeEl("crep")) {
                                                                        crep = $("#crep").val();
                                                                    }
                                                                    if (existeEl("eecaes")) {
                                                                        eecaes = $("#eecaes").val();
                                                                    }
                                                                    if (existeEl("recaes")) {
                                                                        recaes = $("#recaes").val();
                                                                    }
                                                                    if (existeEl("pecaes")) {
                                                                        pecaes = $("#pecaes").val();
                                                                    }
                                                                    $("#tb2").append("<tr><input name='tb2[]' type='hidden' value='" + inst + ";" + pepr + ";" + scep + ";" + ftep + ";" + ntp + ";" + crep + ";" + eecaes + ";" + recaes + ";" + pecaes + "'><td>" + instn + "</td><td>" + pepr + "</td><td>" + scep + "</td><td>" + ftep + "</td><td><button type='button' class='tb2Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                                } else {
                                                                    notify('Alerta', 'No hay Institución válida para agregar.', 'error');
                                                                }
                                                            }

                                                            function agregarTb3() {
                                                                var inst = 0;
                                                                var instn = "";
                                                                var tep = "";
                                                                var ftepo = null;
                                                                if (existeEl("ies2_id")) {
                                                                    inst = $("#ies2_id").val();
                                                                    instn = $("#ies2_id option:selected").text();
                                                                    if (existeEl("tep")) {
                                                                        tep = $("#tep").val();
                                                                    }
                                                                    if (existeEl("ftepo")) {
                                                                        ftepo = $("#ftepo").val();
                                                                    }
                                                                    $("#tb3").append("<tr><input name='tb3[]' type='hidden' value='" + inst + ";" + tep + ";" + ftepo + "'><td>" + tep + "</td><td>" + ftepo + "</td><td><button type='button' class='tb4Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                                } else {
                                                                    notify('Alerta', 'No hay Institución válida para agregar.', 'error');
                                                                }
                                                            }

                                                            function agregarTb4() {
                                                                var icr = "";
                                                                var tcr = "";
                                                                var ftcr = null;
                                                                if (existeEl("icr")) {
                                                                    icr = $("#icr").val();
                                                                }
                                                                if (existeEl("tcr")) {
                                                                    tcr = $("#tcr").val();
                                                                }
                                                                if (existeEl("ftcr")) {
                                                                    ftcr = $("#ftcr").val();
                                                                }
                                                                $("#tb4").append("<tr><input name='tb4[]' type='hidden' value='" + tcr + ";" + icr + ";" + ftcr + "'><td>" + tcr + "</td><td>" + icr + "</td><td>" + ftcr + "</td><td><button type='button' class='tb4Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb5() {
                                                                var ndlp = "";
                                                                var top = "";
                                                                var ap = "";
                                                                var eap = "";
                                                                if (existeEl("ndlp")) {
                                                                    ndlp = $("#ndlp").val();
                                                                }
                                                                if (existeEl("top")) {
                                                                    top = $("#top").val();
                                                                }
                                                                if (existeEl("ap")) {
                                                                    ap = $("#ap").val();
                                                                }
                                                                if (existeEl("eap")) {
                                                                    eap = $("#eap").val();
                                                                }
                                                                $("#tb5").append("<tr><input name='tb5[]' type='hidden' value='" + ndlp + ";" + top + ";" + ap + ";" + eap + "'><td>" + ndlp + "</td><td>" + top + "</td><td>" + ap + "</td><td><button type='button' class='tb5Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb6() {
                                                                var ste = "", cte = "", dtif = "", paisif = "", pif = "", cdf = "", nac = "", vif = "", oif = "", pifa = "", edad = "";
                                                                var neif = "", imf = "", imdf = "", lee = "", dpto9_id = "", ciudad9_id = "", drif = "", tcif = "", cif = "", de = "", nc = "";
                                                                if (existeEl("ste")) {
                                                                    ste = $("#ste").val();
                                                                }
                                                                if (existeEl("cte")) {
                                                                    cte = $("#cte").val();
                                                                }
                                                                if (existeEl("dtif")) {
                                                                    dtif = $("#dtif").val();
                                                                }
                                                                if (existeEl("paisif")) {
                                                                    paisif = $("#paisif").val();
                                                                }
                                                                if (existeEl("pif")) {
                                                                    pif = $("#pif").val();
                                                                }
                                                                if (existeEl("cdf")) {
                                                                    cdf = $("#cdf").val();
                                                                }
                                                                if (existeEl("nac")) {
                                                                    nac = $("#nac").val();
                                                                }
                                                                if (existeEl("vif")) {
                                                                    vif = $("#vif").val();
                                                                }
                                                                if (existeEl("oif")) {
                                                                    oif = $("#oif").val();
                                                                }
                                                                if (existeEl("pifa")) {
                                                                    pifa = $("#pifa").val();
                                                                }
                                                                if (existeEl("edad")) {
                                                                    edad = $("#edad").val();
                                                                }
                                                                if (existeEl("neif")) {
                                                                    neif = $("#neif").val();
                                                                }
                                                                if (existeEl("imf")) {
                                                                    imf = $("#imf").val();
                                                                }
                                                                if (existeEl("imdf")) {
                                                                    imdf = $("#imdf").val();
                                                                }
                                                                if (existeEl("lee")) {
                                                                    lee = $("#lee").val();
                                                                }
                                                                if (existeEl("dpto9_id")) {
                                                                    dpto9_id = $("#dpto9_id").val();
                                                                }
                                                                if (existeEl("ciudad9_id")) {
                                                                    ciudad9_id = $("#ciudad9_id").val();
                                                                }
                                                                if (existeEl("drif")) {
                                                                    drif = $("#drif").val();
                                                                }
                                                                if (existeEl("tcif")) {
                                                                    tcif = $("#tcif").val();
                                                                }
                                                                if (existeEl("cif")) {
                                                                    cif = $("#cif").val();
                                                                }
                                                                if (existeEl("de")) {
                                                                    de = $("#de").val();
                                                                }
                                                                if (existeEl("nc")) {
                                                                    nc = $("#nc").val();
                                                                }
                                                                var html = "<tr><input name='tb6[]' type='hidden' value='" + ste + ";" + cte + ";" + dtif + ";" + paisif + ";" + pif + ";" + cdf + ";" + nac + ";" + vif;
                                                                html = html + ";" + oif + ";" + pifa + ";" + edad + ";" + neif + ";" + imf + ";" + imdf + ";" + lee + ";" + dpto9_id + ";" + ciudad9_id + ";" + drif + ";" + tcif + ";" + cif + ";" + de + ";" + nc + "'>";
                                                                html = html + "<td>" + cdf + "</td><td>" + nac + "</td><td>" + pif + "</td><td>" + oif + "</td><td><button type='button' class='tb6Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>";
                                                                $("#tb6").append(html);
                                                            }

                                                            function agregarTb7() {
                                                                var tdjf2 = "", ncjf = "", edt = "", cjf = "", tdsjf = "", sueldo = "", jijf = "", addjf = "", ttjf = "", pac = "", qejf = "", djf = "";
                                                                var mc = "", djfa = "", pjf = "", celular = "", nejf = "", ojf = "", tdjf = "", cjfa = "";
                                                                if (existeEl("ncjf")) {
                                                                    ncjf = $("#ncjf").val();
                                                                }
                                                                if (existeEl("edt")) {
                                                                    edt = $("#edt").val();
                                                                }
                                                                if (existeEl("cjf")) {
                                                                    cjf = $("#cjf").val();
                                                                }
                                                                if (existeEl("tdsjf")) {
                                                                    tdsjf = $("#tdsjf").val();
                                                                }
                                                                if (existeEl("sueldo")) {
                                                                    sueldo = $("#sueldo").val();
                                                                }
                                                                if (existeEl("jijf")) {
                                                                    jijf = $("#jijf").val();
                                                                }
                                                                if (existeEl("addjf")) {
                                                                    addjf = $("#addjf").val();
                                                                }
                                                                if (existeEl("ttjf")) {
                                                                    ttjf = $("#ttjf").val();
                                                                }
                                                                if (existeEl("pac")) {
                                                                    pac = $("#pac").val();
                                                                }
                                                                if (existeEl("qejf")) {
                                                                    qejf = $("#qejf").val();
                                                                }
                                                                if (existeEl("djf")) {
                                                                    djf = $("#djf").val();
                                                                }
                                                                if (existeEl("mc")) {
                                                                    mc = $("#mc").val();
                                                                }
                                                                if (existeEl("djfa")) {
                                                                    djfa = $("#djfa").val();
                                                                }
                                                                if (existeEl("pjf")) {
                                                                    pjf = $("#pjf").val();
                                                                }
                                                                if (existeEl("celular")) {
                                                                    celular = $("#celular").val();
                                                                }
                                                                if (existeEl("nejf")) {
                                                                    nejf = $("#nejf").val();
                                                                }
                                                                if (existeEl("ojf")) {
                                                                    ojf = $("#ojf").val();
                                                                }
                                                                if (existeEl("tdjf")) {
                                                                    tdjf = $("#tdjf").val();
                                                                    tdjf2 = $("#tdjf option:selected").text();
                                                                }
                                                                if (existeEl("cjfa")) {
                                                                    cjfa = $("#cjfa").val();
                                                                }
                                                                var html = "<tr><input name='tb7[]' type='hidden' value='" + ncjf + ";" + edt + ";" + cjf + ";" + tdsjf + ";" + sueldo + ";" + jijf + ";" + addjf + ";" + ttjf;
                                                                html = html + ";" + pac + ";" + qejf + ";" + djf + ";" + mc + ";" + djfa + ";" + pjf + ";" + celular + ";" + nejf + ";" + ojf + ";" + tdjf + ";" + cjfa + "'>";
                                                                html = html + "<td>" + cjfa + "</td><td>" + ncjf + "</td><td>" + tdjf2 + "</td><td>" + edt + "</td><td><button type='button' class='tb7Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>";
                                                                $("#tb7").append(html);
                                                            }

                                                            function agregarTb8() {
                                                                var iep = "", cep = "", sm = "", fi = null, fr = null, ttep = "";
                                                                if (existeEl("iep")) {
                                                                    iep = $("#iep").val();
                                                                }
                                                                if (existeEl("cep")) {
                                                                    cep = $("#cep").val();
                                                                }
                                                                if (existeEl("sm")) {
                                                                    sm = $("#sm").val();
                                                                }
                                                                if (existeEl("fi")) {
                                                                    fi = $("#fi").val();
                                                                }
                                                                if (existeEl("fr")) {
                                                                    fr = $("#fr").val();
                                                                }
                                                                if (existeEl("ttep")) {
                                                                    ttep = $("#ttep").val();
                                                                }
                                                                $("#tb8").append("<tr><input name='tb8[]' type='hidden' value='" + iep + ";" + cep + ";" + sm + ";" + fi + ";" + fr + ";" + ttep + "'><td>" + iep + "</td><td>" + cep + "</td><td>" + fi + "</td><td>" + fr + "</td><td><button type='button' class='tb8Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb9() {
                                                                var ied = "", ned = "", aa = "", tsed = "";
                                                                if (existeEl("ied")) {
                                                                    ied = $("#ied").val();
                                                                }
                                                                if (existeEl("ned")) {
                                                                    ned = $("#ned").val();
                                                                }
                                                                if (existeEl("aa")) {
                                                                    aa = $("#aa").val();
                                                                }
                                                                if (existeEl("tsed")) {
                                                                    tsed = $("#tsed").val();
                                                                }
                                                                $("#tb9").append("<tr><input name='tb9[]' type='hidden' value='" + ied + ";" + ned + ";" + aa + ";" + tsed + "'><td>" + ied + "</td><td>" + ned + "</td><td>" + aa + "</td><td>" + tsed + "</td><td><button type='button' class='tb9Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb10() {
                                                                var iei = "", pei = "", cei = "", aei = "";
                                                                if (existeEl("iei")) {
                                                                    iei = $("#iei").val();
                                                                }
                                                                if (existeEl("pei")) {
                                                                    pei = $("#pei").val();
                                                                }
                                                                if (existeEl("cei")) {
                                                                    cei = $("#cei").val();
                                                                }
                                                                if (existeEl("aei")) {
                                                                    aei = $("#aei").val();
                                                                }
                                                                $("#tb10").append("<tr><input name='tb10[]' type='hidden' value='" + iei + ";" + pei + ";" + cei + ";" + aei + "'><td>" + iei + "</td><td>" + pei + "</td><td>" + cei + "</td><td>" + aei + "</td><td><button type='button' class='tb10Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb11() {
                                                                var nr = "", dr = "", tr = "";
                                                                if (existeEl("nr")) {
                                                                    nr = $("#nr").val();
                                                                }
                                                                if (existeEl("dr")) {
                                                                    dr = $("#dr").val();
                                                                }
                                                                if (existeEl("tr")) {
                                                                    tr = $("#tr").val();
                                                                }
                                                                $("#tb11").append("<tr><input name='tb11[]' type='hidden' value='" + nr + ";" + dr + ";" + tr + "'><td>" + nr + "</td><td>" + dr + "</td><td>" + tr + "</td><td><button type='button' class='tb11Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb12() {
                                                                var nacsc = "", os = "", fiacsc = "";
                                                                if (existeEl("nacsc")) {
                                                                    nacsc = $("#nacsc").val();
                                                                }
                                                                if (existeEl("os")) {
                                                                    os = $("#os").val();
                                                                }
                                                                if (existeEl("fiacsc")) {
                                                                    fiacsc = $("#fiacsc").val();
                                                                }
                                                                $("#tb12").append("<tr><input name='tb12[]' type='hidden' value='" + nacsc + ";" + os + ";" + fiacsc + "'><td>" + nacsc + "</td><td>" + os + "</td><td>" + fiacsc + "</td><td><button type='button' class='tb12Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb13() {
                                                                var i = "", co = "", h = "", l = "", e = "", text = "";
                                                                if (existeEl("i")) {
                                                                    i = $("#i").val();
                                                                    text = $("#i option:selected").text();
                                                                }
                                                                if (existeEl("co")) {
                                                                    co = $("#co").val();
                                                                }
                                                                if (existeEl("h")) {
                                                                    h = $("#h").val();
                                                                }
                                                                if (existeEl("l")) {
                                                                    l = $("#l").val();
                                                                }
                                                                if (existeEl("e")) {
                                                                    e = $("#e").val();
                                                                }
                                                                $("#tb13").append("<tr><input name='tb13[]' type='hidden' value='" + i + ";" + co + ";" + h + ";" + l + ";" + e + "'><td>" + text + "</td><td>" + co + "</td><td>" + h + "</td><td>" + l + "</td><td>" + e + "</td><td><button type='button' class='tb13Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb14() {
                                                                var pp = "", text = "";
                                                                if (existeEl("pp")) {
                                                                    pp = $("#pp").val();
                                                                    text = $("#pp option:selected").text();
                                                                }
                                                                $("#tb14").append("<tr><input name='tb14[]' type='hidden' value='" + pp + "'><td>" + text + "</td><td><button type='button' class='tb14Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb15() {
                                                                var iesla = "", text1 = "", prla = "", aniola = "", aceptadola = "", text2 = "";
                                                                iesla = $("#iesla").val();
                                                                text1 = $("#iesla option:selected").text();
                                                                prla = $("#prla").val();
                                                                aniola = $("#aniola").val();
                                                                aceptadola = $("#aceptadola").val();
                                                                text2 = $("#aceptadola option:selected").text();
                                                                $("#tb15").append("<tr><input name='tb15[]' type='hidden' value='" + iesla + ";" + prla + ";" + aniola + ";" + aceptadola + "'><td>" + text1 + "</td><td>" + prla + "</td><td>" + aniola + "</td><td>" + text2 + "</td><td><button type='button' class='tb15Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function agregarTb16() {
                                                                var tdi = "", ndld = "", fdi = null, text = "";
                                                                if (existeEl("tdi")) {
                                                                    tdi = $("#tdi").val();
                                                                    text = $("#tdi option:selected").text();
                                                                }
                                                                if (existeEl("ndld")) {
                                                                    ndld = $("#ndld").val();
                                                                }
                                                                if (existeEl("fdi")) {
                                                                    fdi = $("#fdi").val();
                                                                }
                                                                $("#tb16").append("<tr><input name='tb16[]' type='hidden' value='" + tdi + ";" + ndld + ";" + fdi + "'><td>" + text + "</td><td>" + ndld + "</td><td>" + fdi + "</td><td><button type='button' class='tb16Clear btn btn-xs btn-danger'><i class='fa fa-remove'></i></button></td></tr>");
                                                            }

                                                            function existeEl(elem) {
                                                                if ($("#" + elem).length > 0) {
                                                                    return true;
                                                                } else {
                                                                    return false;
                                                                }
                                                            }
        </script>
        <!-- end: Javascript -->
    </body>
</html>

<?php

function existe($coleccion, $valor) {
    if (count($coleccion) > 0) {
        foreach ($coleccion as $value) {
            if ($value["items"] !== null) {
                foreach ($value["items"] as $i) {
                    if ($i["nomenclatura"] == $valor) {
                        return $i;
                    }
                }
            }
        }
        return null;
    } else {
        return null;
    }
}

function existePanel($coleccion, $valor) {
    if (count($coleccion) > 0) {
        foreach ($coleccion as $value) {
            if ($value["panel"] == $valor) {
                return true;
            }
        }
        return false;
    } else {
        return false;
    }
}
