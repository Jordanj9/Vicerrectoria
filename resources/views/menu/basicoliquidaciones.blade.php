@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Tesorería - Menú Datos Básicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.tesoreria')}}"> Módulo Tesorería </a><span class="fa-angle-right fa"></span><a href="{{route('admin.tesoreria')}}"> Liquidaciones </a> <span class="fa-angle-right fa"></span> Datos Básicos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ DATOS BÁSICOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('tipopagoliquidacion.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Tipos de Pago de Liquidación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('desticuentbanca.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Destino de Cuenta Bancaria</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('datoscuentabanca.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos de Cuentas Bancarias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('asignardestinocuenta.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asignar Destino de Cuenta Bancaria</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('conceptomatricula.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos de Conceptos de Matrícula</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('destinocuentaproceso.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asociar Destino Cuenta a Proceso</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('conceptosextra.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Conceptos Base Para Extraordinaria</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
