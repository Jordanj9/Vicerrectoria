@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Admisiones - Menú Asignar Peso Áreas Pruebas de Estado</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.admisiones')}}"> Módulo Admisiones </a><span class="fa-angle-right fa"></span><a href="{{route('admin.admisiones')}}"> Selección </a><span class="fa-angle-right fa"></span> Asignar Peso Áreas Pruebas de Estado
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad  permite al usuario gestionar las Áreas de las Pruebas de Estado Icfes con un peso específico asignado a un programa académico. Es responsabilidad del directivo correspondiente establecer las condiciones de las áreas de conocimiento de las pruebas de estado y el peso que asigna a cada una de ellas. Es de aclarar que la suma total de los pesos asignados a las áreas de Pruebas de Estado asignado a un programa académico no debe ser mayor de 100, de igual forma, hay que tener en cuenta que al agregar áreas se van totalizando estos valores, hasta alcanzar un puntaje máximo de 100.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ ASIGNAR PESO ÁREAS PRUEBAS DE ESTADO</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.asignarpape')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Exámen de Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('pesoareaicfesxprograma.index')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Definir Peso De Áras Por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <!--<div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.asignarpape')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Nomenclatura por Área</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.asignarpape')}}" class="btn ripple btn-gradient btn-default">
                        <div>
                            <span>Títulos de Áreas de Exámenes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
