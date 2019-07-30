@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Calificaciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Calificaciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE CALIFICACIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.promestprog')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Promedios de Estudiantes por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.promestproga')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Promedios de Estudiantes por Programa (Período Actual)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a href="{{route('calificaciones.ponderacionacademica')}}" class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Situación del Estudiante</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.ponderacionacademica')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Ponderación Académica del Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Estado de Materias por Estudiante</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.mejorpromedio')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Mejores Promedios de Estudiantes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.mejorpromedioperiodo')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Mejores Promedios Estudiantes/Semestre</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.aprobadoreprobado')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Estudiantes Aprobados y Reprobados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Docentes que no Ingresaron Calificación</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Reporte de Promedio Semestral</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a href="{{route('calificaciones.promedioxgrupo')}}" class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Porcentaje de Notas Ingresado</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.promedioxgrupo')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Reporte Definitivo de Grupos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Notas Actuales por Programa</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Semaforo del Estudiante</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Estudiantes que Habilitan</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Notas Actuales del Docente por Programa</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.registroextendido')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Registro Extendido por Estudiante o por Pensum</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.masivocalificaciones')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Consolidado Masivo de Calificaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('calificaciones.notasparciales')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Notas Parciales Históricas del Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
