@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Módulo Académico Estudiante</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Menú Módulo Académico Estudiante
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÓDULO ACADÉMICO ESTUDIANTE</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_EST-HOJA-VIDA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('hojavidaestudianteest.index')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Hoja de Vida Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-OFERTA-MATERIAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled='disabled' href="{{route('admin.academicoestudiante')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Gestionar Oferta de Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
<!--                @if(session()->exists('PAG_EST-CERTIFICADO-ESTIMULOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled='disabled' href="{{route('admin.academicoestudiante')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Certificado de Estímulos de Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif-->
                @if(session()->exists('PAG_EST-CONSULTAR-PENSUM'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a  href="{{route('pm.vistaestudiantepensum')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Consultar Pensum</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-PRACTICA-EMPRESARIAL'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled='disabled' href="{{route('admin.academicoestudiante')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Práctica Empresarial</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-CALIFICACIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('academicoest.menu')}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Calificaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
