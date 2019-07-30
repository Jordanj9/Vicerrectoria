@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Admisiones - Menú Módulo Admisiones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Admisiones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-raised alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Nota: </strong> Pasa el mouse sobre el icono para conocer el módulo.
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>INSCRIPCIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12 tabs-area">
                    <div class="liner"></div>
                    <ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
                        <li class="active">
                            <a href="#tabs-demo6-area6" data-toggle="tab" title="Otros..." aria-expanded="true">
                                <span class="round-tabs three">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area5" data-toggle="tab" title="Convocatoria" aria-expanded="true">
                                <span class="round-tabs five">
                                    <i class="fa fa-copyright"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area7" data-toggle="tab" title="Gestionar Inscripciones" aria-expanded="true">
                                <span class="round-tabs four">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </a>
                        </li>
                        <!--                        <li>
                                                    <a href="#tabs-demo6-area8" data-toggle="tab" title="Pruebas de Admisión" aria-expanded="true">
                                                        <span class="round-tabs two">
                                                            <i class="fa fa-file"></i>
                                                        </span>
                                                    </a>
                                                </li>-->
                        <li>
                            <a href="#tabs-demo6-area1" data-toggle="tab" title="Servicios" aria-expanded="true">
                                <span class="round-tabs one">
                                    <i class="fa fa-scribd"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area2" data-toggle="tab" title="Pines" aria-expanded="true">
                                <span class="round-tabs two">
                                    <i class="fa fa-pinterest-p"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area4" data-toggle="tab" title="Parámetros" aria-expanded="true">
                                <span class="round-tabs four">
                                    <i class="fa fa-pinterest-p"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area3" data-toggle="tab" title="Datos Básicos" aria-expanded="true">
                                <span class="round-tabs three">
                                    <i class="fa fa-tasks"></i>
                                </span> </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-v5">
                        <div class="tab-pane fade active in" id="tabs-demo6-area6">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_CIRCUNSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('circunscripcion.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Datos de Circunscripción</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPODOCANEXO'))
                                <div class="col-md-4">
                                    <a href="{{route('tipodocanexob.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Tipo de Documento Anexo</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tabs-demo6-area5">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_CONVOCATORIA'))
                                <div class="col-md-4">
                                    <a href="{{route('convocatoria.index')}}" class="btn ripple btn-gradient btn-default">
                                        <div>
                                            <span>Gestionar Convocatoria</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tabs-demo6-area7">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_GESTION-DATOS-INSCRITOS'))
                                <div class="col-md-4">
                                    <a href="{{route('datosinscritos.index')}}" class="btn  btn-3d btn-danger btn-block">
                                        <div>
                                            <span>Gestionar Datos de Inscritos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_AGREGAR-ASPIRANTE'))
                                <div class="col-md-4">
                                    <a href="{{route('datosinscritos.agregaraspirante')}}" class="btn  btn-3d btn-danger btn-block">
                                        <div>
                                            <span>Agregar Aspirante</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_INSCRITOS-PROGRAMA'))
                                <div class="col-md-4">
                                    <a href="{{route('inscritosxprograma.index')}}" class="btn  btn-3d btn-danger btn-block">
                                        <div>
                                            <span>Inscritos por Programa</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_PAGAR-TRANSFERENCIAS-REINGRESOS'))
<!--                                <div class="col-md-4">
                                    <a href="{{route('pagartyr.index')}}" class="btn  btn-3d btn-danger btn-block">
                                        <div>
                                            <span>Pagar Transferencias y Reingresos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tabs-demo6-area8">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_JORNADA-ADMISION'))
                                <div class="col-md-4">
                                    <a href="{{route('jornadaadmision.index')}}" class="btn  btn-3d btn-warning btn-block">
                                        <div>
                                            <span>Jornadas de Pruebas de Admisión</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_PRUEBAS-ADMISION'))
                                <div class="col-md-4">
                                    <a href="{{route('pruebasadmision.index')}}" class="btn  btn-3d btn-warning btn-block">
                                        <div>
                                            <span>Gestionar Pruebas de Amisión</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tabs-demo6-area1">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_SERVICIOINSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('servicioi.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Servicios</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_COSTOS-SERVICIOS'))
                                <div class="col-md-4">
                                    <a href="{{route('precios.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Precios de un Servicio</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_SERVICIO-PROGRAMA'))
                                <div class="col-md-4">
                                    <a href="{{route('servicioprograma.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Asociar Programas a Servicios</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-demo6-area2">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_PINES-GENERAR'))
                                <div class="col-md-4">
                                    <a href="{{route('pin.index')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Generar Pines</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_PINES'))
                                <div class="col-md-4">
                                    <a href="{{route('pin.banco')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Gestionar Pines Para el Banco</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_PINES-NO-USADOS'))
                                <div class="col-md-4">
                                    <a href="{{route('admin.habilitarmenu')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Habilitar Pines no Usados</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_PINES-CONSULTAR'))
                                <div class="col-md-4">
                                    <a href="{{route('pin.create')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Consultar Pines Generados</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_PINES-BANCO'))
                                <div class="col-md-4">
                                    <a href="{{route('pin.cargar')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Cargar Pines del Banco</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_PINES-USAR'))
                                <div class="col-md-4">
                                    <a href="{{route('pin.usarview')}}" class="btn ripple btn-3d btn-warning">
                                        <div>
                                            <span>Asignar Pin a Aspirante</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-demo6-area4">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_GESTION-PARAMETROS'))
                                <div class="col-md-4">
                                    <a href="{{route('parametrosins.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Gestionar Parámetros</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_PARAMETRIZAR-FORMULARIO-INSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('pfi.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Crear Formularios de Inscripción</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_CAMPOS-FORMULARIO-INSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('itemsf.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Configurar Formularios de Inscripción</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_PARAMETRIZAR-DOCS-ANEXOS'))
                                <div class="col-md-4">
                                    <a href="{{route('parametrizardocsanexos.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Parametrizar Documentos Anexos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_MEDIOS-DIVULGACION'))
                                <div class="col-md-4">
                                    <a href="{{route('mediosdivulgacion.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Medios de Divulgación</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                                @if(session()->exists('PAG_SITUACION-TIPO-INSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('situaciontipoinscripcion.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Situaciones en Tipos de Inscripción</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-demo6-area3">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_RANG-SALARIOS'))
                                <div class="col-md-4">
                                    <a href="{{route('rangosalario.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Rangos de Salario</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_OCUPACIONES-LABORALES'))
                                <div class="col-md-4">
                                    <a href="{{route('ocupacionlaboral.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Ocupaciones Laborales</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_ECAES'))
                                <div class="col-md-4">
                                    <a href="{{route('ecaes.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>ECAES</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPOS-DISCAPACIDAD'))
                                <div class="col-md-4">
                                    <a href="{{route('tipodiscapacidad.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Tipos de Discapacidad</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPO-INSCRIPCION'))
                                <div class="col-md-4">
                                    <a href="{{route('tipoi.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Tipos de Inscripción</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>SELECCIÓN</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_CRITERIOS-SELECCIÓN'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('criteriosseleccion.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Criterios de Selección</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CRITERIOS-SELECCIÓN-PROGRAMA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('criteriosseleccionprograma.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Criterios de Selección por Programas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_COMPONENTES-EXAMEN-ADMISION'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('componentesexamenadmision.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Componentes Exámen de Admisión</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_DATOS-AREAS-PRUEBAS-ESTADO'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('datosape.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Datos de Áreas Pruebas de Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_ASIGNAR-PESO-AREAS-PE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.asignarpape')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Asignar Peso Áreas Pruebas de Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_OBTENER-LISTA-SNP'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('listasnp.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Obtener Lista SNP</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CARGAR-ARCHIVO-RESULTADO-PE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('archivoresulticfes.index')}}" disabled='disabled' class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Cargar Archivo Resultado ICFES</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CARGAR-ARCHIVO-RESULTADO-P-ADMISION'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('archivoresultadmision.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Cargar Archivo Resultado Admisión</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_PARAMETRIZAR-PROCESO-SELECCIÓN'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('parametrizarseleccion.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Parametrizar Proceso de Selección</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_PARAMETRIZAR-CALIFICACION-PE'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('parametrizarpe.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Parametrizar Calificación Pruebas de Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_GESTIONAR-CRITERIOS-DESEMPATE'))
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('gcriteriosdesempate.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Gestionar Criterios de Desempate</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                @endif
                @if(session()->exists('PAG_CALIFICAR-ASPIRANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('calificaraspirantes.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Calificar Aspirantes ICFES (Manual)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CALIFICAR-ASPIRANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled='disabled' class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Calificar Aspirantes ICFES (Automático)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_SELECCIONAR-ESTUDIANTES-NUEVOS'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('seleccionarestudiantesnuevos.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Seleccionar Estudiantes Nuevos (Admitir Automático)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_GESTIONAR-DATOSDELLAMADOS'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('datosllamados.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Gestionar Datos de Llamados (Admitir Manual)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_GENERACION-MASIVADE-LLAMADOS'))
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a href="{{route('gmasivallamados.index')}}" class="btn ripple btn-gradient btn-default">
                                        <div>
                                            <span>Generación Masiva de Llamados</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                @endif
                @if(session()->exists('PAG_REGISTRO-MASIVO-ADMITIDOS'))
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a href="{{route('regmasivoadmitidos.index')}}" class="btn ripple btn-gradient btn-default">
                                        <div>
                                            <span>Registro Masivo de Admitidos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                @endif
                @if(session()->exists('PAG_ADMITIR-TRANSFERENCIA-EXTERNA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('transferencia.admisionexterna')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Transferencia Externa (Admisión)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_ELIMINAR-ADMITIDOS-NOPAGO'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('eliminaradmtsinpago.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Eliminar Admitidos Sin Liquidación Paga</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_ADMITIR-TRANSFERENCIA-INTERNA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('transferencia.admisioninterna')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Transferencia Interna (Admisión)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CONVERTIR-ADMITIDOS-EN-ESTUDIANTES'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('seleccionarestudiantesnuevos.convertir')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Convertir ADMITIDOS en ESTUDIANTES</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>INSCRIPCIÓN EN LÍNEA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_INSCRIBIRSE'))
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('admin.admisiones.inscribirse')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Inscribirse</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                @endif
                @if(session()->exists('PAG_VER-PENSUM'))
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('pensum.ver')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Consultar Pensum</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection