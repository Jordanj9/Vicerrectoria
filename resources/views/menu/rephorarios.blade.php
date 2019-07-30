@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Horarios</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Horarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE HORARIOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('horarios.horario')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Horario Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
