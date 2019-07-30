@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Aula Virtual - Menú Del Aula Virtual</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Aula Virtual
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-raised alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Detalles: </strong> En este modulo, usted debe configurar las asignaturas del aula virtual, los grupos para los estudiantes y matricular a docentes y estudiantes en los grupos para cada período académico. Puede además gestionar preguntas y respuestas para los exámenes y por ultimo genere reportes del aula virtual.
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MATRÍCULA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_AV-ASIGNATURAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('asignatura.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Asignaturas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_AV-GRUPOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('grupoav.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Grupos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_AV-MATRICULA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matestudiantes.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Matricular Estudiantes</span>
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
            <h4>EXÁMENES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_AV-BANCO-PREGUNTAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('preguntas.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Banco de Preguntas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>REPORTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_AV-REPORTES-ASIGNATURAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admisiones.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Asignaturas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>-->
@endsection
