@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Matrícula Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Matrícula Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE MATRÍCULA ACADÉMICA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <h4>REPORTES GENERALES</h4>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.porgenero')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados por Género</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.poredad')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados por Edades</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.procedencia')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados por Procedencia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.periodo')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados por Período Académico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.cancelarsemestre')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Cancelación de Semestre</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.sinrenovacionm')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Estudiantes sin Renovación de Matrícula</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.matprimersemestre')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados Primer Semestre</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.ubicacionsemestral')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Estudiantes con Ubicación Semestral</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.unidadregional')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados por Unidad Regional</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.porprograma')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado de Estudiantes por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.consolidadomat')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Consolidados de Matriculados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Comparativo de Matrículados Académico</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.estudiantegeneral')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado de Estudiantes General</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.cancelarmateria')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Cancelar Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.ofertamateria')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Oferta de Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Hoja de Matrícula</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.estudiantexdocente')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado de Estudiantes por Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-6"  style="margin-top: 15px;">
                                    <a class="btn ripple btn-gradient btn-danger">
                                        <div>
                                            <span>Situación de Estudiantes por Período</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.matxmateria')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Reporte de Matriculados por Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.hojadevidaest')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Hoja de Vida del Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <h4 style="margin-top: 20px">REPORTES NUMÉRICOS</h4>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.nuevos')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados - Primer Semestre</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matricula.matriculados_numericos')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matriculados - Por Periodo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
