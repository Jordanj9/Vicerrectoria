@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Matrícula Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Menú Matrícula Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al Módulo de Matrícula Académica, el cual permite determinar la lógica de desarrollo de cada una de las opciones internas del aplicativo. Se establecen las políticas de manejo del Usuario-Administrador y Estudiante, siendo el último quien gozará de la ventaja de llevar a cabo el proceso de matrícula en línea, tanto para estudiantes nuevos como antiguos, trámite de transferencias, reingresos, control de la matrícula de materias, inclusión y cancelación de las mismas, cancelación de semestre, entre otras.
            Las Instituciones Educativas adscritas al convenio, cuentan con la dependencia de Registro y Control Académico como la responsable del manejo de las políticas académicas de la institución y coordina el funcionamiento de los programas académicos de la misma, conjuntamente con los decanos y directores de departamentos.
            La matrícula en línea, se convierte en una herramienta estratégica para agilizar la matrícula de materias, la inserción y cancelación de las mismas con sus respectivos grupos y horarios; busca a través de su implementación y puesta en marcha, ofrecer un producto satisfactorio, aplicando un proceso que conduce a un resultado de alta calidad que colma las necesidades de quienes se beneficiarán con el uso del aplicativo.
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MATRÍCULA ACADÉMICA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.matriculaacademicadb')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos Básicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('homologacion.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Transferencias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a  href="{{route('matacadestudiantes.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Estudiantes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matacadestudiantes.vistaactivarmatricula')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Activar Matrícula Académica (Luego de Cancelar Semestre)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Asimilación de Pensum</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matestudiantespsemestre.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Matricular Estudiantes de Primer Período</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('matlistadef.listadefinitiva')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Generar Lista Definitiva de Estudiantes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estudiantessinrenmat.sinrenovacion')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Estudiantes sin Renovación de Matricula</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Asociar Reglas de Matricula Académica</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Gestionar Reglas de Matricula Académica</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Asociar Reglas de Cancelación de Materias</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Gestionar Reglas de Cancelación de Mat.</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Cambio de Período Matrícula</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled='disabled' href="{{route('admin.matriculaacademica')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Matrícula Académica Automática</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
