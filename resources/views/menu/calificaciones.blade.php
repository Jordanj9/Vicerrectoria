@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Calificaciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Calificaciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Contiene las configuraciones e información general de los procesos de calificación.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ CALIFICACIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('tipocalificaciones.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Tipo de Calificaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.sistemaevaluacion')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Sistema de Evaluación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.fechas')}}" href="{{route('admin.calificaciones')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Fechas Para Inclusión de Evaluaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
<!--                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.reglas')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Reglas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>-->
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('cierreacademico.inicio')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Cierres</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.ingresoespecial')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Ingreso Especial</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('modificarregistroa.inicio')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Modificar Registro Académico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('consultarnotasa.menu')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Consultar Notas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
