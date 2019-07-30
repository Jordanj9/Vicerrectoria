@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Sistema de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.calificaciones')}}"> Calificaciones </a><span class="fa-angle-right fa"></span> Sistema de Evaluación
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar el sistema de evaluación que se aplicará en los diferentes programas de la institución. En el sistema de evaluación se determina el número de evaluaciones que conformarán el sistema, las notas de cada evaluación, se definen los valores que tomará la habilitación aprobatoria y la no aprobatoria. También se gestionará la asignación del sistema de evaluación y las notas asociadas a las evaluaciones del sistema. Consta de las siguientes funcionalidades: Sistema de Evaluación, Asignar Sistema de Evaluación y Notas.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ CALIFICACIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6" style="margin-top: 15px;">
                    <a href="{{route('sistevalu.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Sistema de Evaluación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-6" style="margin-top: 15px;">
                    <a href="{{route('sistevalu.asignarmenu')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asignar Sistema de Evaluación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
