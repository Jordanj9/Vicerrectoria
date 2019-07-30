@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Carga Administrativa</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Carga Administrativa
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE CARGA ADMINISTRATIVA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
<!--                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Consultar Directorio por Tipo de Unidad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('cargaadmin.docacademica')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Docentes por Unidad Académica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('cargaadmin.docregional')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Docentes por Unidad Regional</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
<!--                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Docentes por Título SNIES</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('cargaadmin.catescalafon')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Docentes por Categoría de Escalafón</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                   <a href="{{route('cargaadmin.cargaacademica')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Reporte Grupo, Docente y Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
