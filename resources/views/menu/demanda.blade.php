@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Proyectar Demanda</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Menú Proyectar Demanda
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La proyección de la Demanda le permite a las instituciones educativas calcular a través de un proceso automático la cantidad de materias demandadas por los estudiantes adscritos al pensum de un programa. Este cálculo evalúa el cumplimiento de los requisitos, prerrequisitos, correquisitos y créditos de requisito, establecidos en cada pensum activo y vigente de cada uno de los
            programas de la institución. Se revisan las posibilidades y condiciones académicas de los alumnos potenciales que procederán a desarrollar la respectiva matrícula académica.
            Este proceso está condicionado por las reglas establecidas en cada pensum en la estructuración de la malla curricular, permitiendo controlar la adecuada asignación de materias que el estudiante puede ver en su nuevo periodo académico.
            Para poder proyectar la demanda materias por programa o de estudiantes por materia, es necesario tener en cuenta haber creado unidades regionales, periodos, programas académicos asociados a un pensum y que este programa se encuentre activo. Igualmente debe tener materias para el periodo a proyectar. 
            La información generada por la demanda es utilizada en el Módulo Horarios al momento de generar los grupos, así como en los procesos de Prematricula, Matricula en Línea, Inclusiones y Cancelaciones. 
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ PROYECTAR DEMANDA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('demandaxlote.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Demanda por Lotes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('demandaxprograma.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Demanda de Materias por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('demandaxestudiante.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Demanda por Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
