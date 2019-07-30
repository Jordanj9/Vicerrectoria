@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Tesorería - Menú Liquidación Pecuniarios</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.tesoreria')}}">Módulo Tesorería</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.tesoreria')}}">Liquidaciones</a> <i class="fa-angle-right fa"></i> Liquidación Pecuniarios y Otros
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permitirá al usuario gestionar liquidaciones de conceptos pecuniarios y otros conceptos para estudiantes, personas naturales y personas jurídicas. La funcionalidad permite gestionar los conceptos y tipos de conceptos, liquidar, financiar y pagar. El proceso de liquidación de los cursos vacacionales requiere que en esta funcionalidad se gestione el concepto a cobrarse en el curso.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>LIQUIDACIÓN DE CONCEPTOS PECUNIARIOS Y OTROS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('tipoconcepto.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Tipos de Conceptos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('conceptopecuniario.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Conceptos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('liquidacionconceptosp.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidar</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a disabled="disabled" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Financiar</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top: 20px;">
                    <a disabled="disabled" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Pagar</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
