@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Módulo Financiera Estudiante</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Menú Módulo Financiera Estudiante
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÓDULO FINANCIERA ESTUDIANTE</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_EST-CONSULTAR-LIQUIDACION'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('liquidacione.consultarliquidacion')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Consultar Liquidación Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-DEUDAS-ESTUDIANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('deudase.consultard')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Deudas por Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
