@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Estructura Curricular</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Estructura Curricular
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE ESTRUCTURA CURRICULAR</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a target="_blank" href="{{route('estructura.listprograma_pdf')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado General de Programas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.programaxunidad')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Programas por Unidad Regional</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.programaxunda')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Programas por Unidad Académica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a target="_blank" href="{{route('estructura.listmaterias_pdf')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado General de Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.matunidad')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Materias por Unidad Académica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.contenidomat')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Contenido de Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.fundamentopro')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Fundamentación Teórica de Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('estructura.hojavidapro')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Hoja de Vida de Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a target="_blank" href="{{route('estructura.reportepensum_pdf')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Reporte de Pensum</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
<!--                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Pensum con Áreas de Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
