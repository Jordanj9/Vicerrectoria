@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Horarios</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Menú Horarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al Módulo de Horarios, el cual permite administrar la información de tiempos de disponibilidad de docentes, horas de clase, recursos físicos (salones de clases, laboratorios, aulas de conferencia, salas de cómputo, entre otros); distribución de grupos, generación de horarios para alumnos y docentes, reutilización de horarios de semestres anteriores, gracias a las funcionalidades de copiar horarios por materia y por programa. Además, también permite crear reservas de los recursos físicos para llevar a cabo de manera sistemática y organizada la asignación de recursos, llevando a cabo todas las actividades programadas en la institución. 
            De igual manera permite reducir el tiempo de elaboración de horarios para los usuarios asignados en esta tarea, logrando llevar a cabo un proceso eficiente y eficaz que garantiza el buen uso de los recursos físicos, tecnológicos y humanos en la distribución y asignación de clases semanales.
            La descripción detallada del proceso de horarios permitirá al usuario determinar la lógica de desarrollo de cada una de las opciones internas del aplicativo y se convertirá en una herramienta valiosa para el cumplimiento de los objetivos plateados para cada periodo académico, referentes a fechas y optimización de tiempos y recursos.
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ HORARIOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.horas')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Horas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('horarioxmateria.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Horarios por Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled="disabled" href="{{route('admin.horario')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Horarios por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled="disabled" href="{{route('admin.horario')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Horarios por Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('horarioestudianteadmin.vista')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Horario Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled="disabled" href="{{route('admin.horario')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Consultar Horario por Recurso Físico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('copiargruposentreperiodos.principal')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Copiar Grupos Entre Períodos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
