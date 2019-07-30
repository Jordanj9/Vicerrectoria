@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Estímulos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Estímulos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al módulo de Estímulos el cual permitirá determinar las reglas para los mismos, gestionarlos, asignarlos y procesarlos automáticamente. Además define las directrices que regulan los requisitos para el otorgamiento de estímulos y distinciones de los alumnos pertenecientes a la institución educativa, el manejo de estos datos requiere de un sistema de información ágil y fácil de usar que permita gestionar en forma oportuna y precisa los datos relacionados con los estímulos. Cabe resaltar que la gestión adecuada de los estímulos permite ocasionar disminuciones en los valores liquidados a los estudiantes dentro de su matrícula financiera.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ ESTÍMULOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.estimulos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Reglas Estímulos Institución</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.estimulos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Estímulos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.estimulos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asignar Estímulos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.estimulos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Procesar Estímulos Automáticos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
