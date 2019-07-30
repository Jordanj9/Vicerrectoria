@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Tesorería - Menú Liquidación Automática</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.tesoreria')}}">Módulo Tesorería</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.tesoreria')}}">Liquidaciones</a> <i class="fa-angle-right fa"></i> Liquidación de Matrícula Automática
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>LIQUIDACIÓN DE MATRÍCULA FINANCIERA AUTOMÁTICA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('liquidacionautomatico.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidar Aspirantes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('liquidacionautomatico.index3')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidar Transferencia Interna</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('liquidacionautomatico.index2')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidar Transferencia Externa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('liquidacionautomatico.index4')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidar Estudiantes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
