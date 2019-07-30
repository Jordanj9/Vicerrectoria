@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Evaluación Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite gestionar todo lo referente a los procesos de evaluación académica: auto-evaluación y hetero-evaluación.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ EVALUACIÓN ACADÉMICA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_EVALUACION-VALORACION-EA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('valoracion.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Valoraciones Cualitativa/Cuantitativa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-CRITERIO'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('criterioe.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Criterio General de Evaluación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-INDICADOR'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('indicador.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Indicadores de Criterios</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-EVALUACION'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('evaluacionaah.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Formularios de Evaluación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-JEFE-DEPARTAMENTO'))
                <div class="col-md-5"  style="margin-top: 15px;">
                                        <a href="{{route('jefedepartamento.index')}}" class="btn ripple btn-gradient btn-success">
<!--                    <a class="btn ripple btn-gradient btn-success" disabled="disabled">-->
                        <div>
                            <span>Configurar Encargados de Departamentos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-JEFE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                                        <a href="{{route('aplicacionjefe.inicio')}}" class="btn ripple btn-gradient btn-success">
<!--                    <a class="btn ripple btn-gradient btn-success" disabled="disabled">-->
                        <div>
                            <span>Aplicación Encargados de Departamento</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-DOCENTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('aplicaciondocente.inicio')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Aplicación Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-ESTUDIANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('aplicacionestudiante.inicio')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Aplicación Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-RESULTADOS'))
                <div class="col-md-3"  style="margin-top: 15px;">
                                        <a href="{{route('resultadosea.inicio')}}" class="btn ripple btn-gradient btn-success">
<!--                    <a class="btn ripple btn-gradient btn-success" disabled="disabled">-->
                        <div>
                            <span>Resultados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-FECHAS-APLICACION-EVALUACION-ACADEMICA'))
                <div class="col-md-5"  style="margin-top: 15px;">
                    <a  href="{{route('fechaaplicacion.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Fechas Aplicación de Evaluación Academica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-AUTORIZAR-EVALUACION'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a  href="{{route('autorizarevaluacion.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Autorizar Evaluación Academica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EVALUACION-CONFIGURAR-DOCENTE'))
                <div class="col-md-3"  style="margin-top: 15px;">
                                        <a  href="{{route('asignarpar.index')}}" class="btn ripple btn-gradient btn-success">
<!--                    <a class="btn ripple btn-gradient btn-success" disabled="disabled">-->
                        <div>
                            <span>Asignar Pares</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                @if(session()->exists('PAG_EVALUACION-RESULTADOS-DOCENTE'))
                                <div class="col-md-3"  style="margin-top: 15px;">
                                    <a  href="{{route('resultadosea.resultadosdocenteindex')}}" class="btn ripple btn-gradient btn-success">
                                        <div>
                                            <span>Resultados</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif-->
            </div>
        </div>
    </div>
</div>
@endsection