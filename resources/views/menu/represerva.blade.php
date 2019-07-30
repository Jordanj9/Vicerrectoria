@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reserva Recurso - Reportes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.reservarecurso')}}">Módulo Reserva de Recursos</a> <i class="fa-angle-right fa"></i> Menú Reportes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>RECURSOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.recursotipo')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Por Tipo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.ocupacion')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Ocupación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.recursoestado')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Por Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>CLIENTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.listadoclientes')}}" class="btn ripple btn-3d btn-warning" target="_blank">
                        <div>
                            <span>Listado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MANTENIMIENTOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.mantrecurso')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Físicos y Tecnológicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.programados')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Programados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.preventivo')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Preventivo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('reporte.correctivo')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Correctivo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>RESERVAS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.reservaxfecha')}}" class="btn ripple btn-3d btn-danger">
                        <div>
                            <span>Por Fecha y Estado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.historicocliente')}}" class="btn ripple btn-3d btn-danger" target="_blank">
                        <div>
                            <span>Hist. Reserva por Clientes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.noaprobadas')}}" class="btn ripple btn-3d btn-danger">
                        <div>
                            <span>No Aprobadas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.liquidacion')}}" class="btn ripple btn-3d btn-danger" target="_blank">
                        <div>
                            <span>Liquidaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>CONDUCTORES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.listadoconductores')}}" class="btn ripple btn-3d btn-info" target="_blank">
                        <div>
                            <span>Listado de Conductores</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.conductoresocu')}}" class="btn ripple btn-3d btn-info" target="_blank">
                        <div>
                            <span>Conductores Ocupados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('reporte.coductotoresdes')}}" class="btn ripple btn-3d btn-info" target="_blank">
                        <div>
                            <span>Conductores Desocupados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
    @endsection