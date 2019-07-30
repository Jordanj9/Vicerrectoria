@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Reportes de Grados</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Menú Reportes de Grados
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES DE GRADOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Listado de Graduados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Puesto Graduación General</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Puesto Graduación por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Certificado de Título</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Puesto Ubicación Recurso Físico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Registro Título Académico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Ácta de Grado General</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Posibles Graduandos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
