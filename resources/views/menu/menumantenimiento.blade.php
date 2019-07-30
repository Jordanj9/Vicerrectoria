@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reserva Recursos - Menú Mantenimiento</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reservarecurso')}}"> Módulo Reserva de Recursos </a><span class="fa-angle-right fa"></span> Menú Mantenimiento
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MANTENIMIENTO</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('mantenimientor.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Recurso Físico y Tecnológico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('mantenimientor.listar')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Mantenimientos Pendientes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('progpreventivo.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Programación Mant. Preventivo (Automotor)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('preventivo.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Preventivo (Recurso Automotor)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div  class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('correctivo.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Correctivo (Recurso Automotor)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
