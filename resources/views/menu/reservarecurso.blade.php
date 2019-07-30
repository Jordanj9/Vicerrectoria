@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reserva Recursos - Menú Reserva Recursos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Reserva Recursos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite gestionar todo lo referente a los recursos que estarán disponibles para ser reservados y las reservas, podrá gestionar los mantenimientos a cada recurso, crear los días de inactividad en los cuales los usuarios no podrán realizar reservas.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ RESERVA RECURSOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_PAIS-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('paisr.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de País</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_DEPARTAMENTO-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('estador.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Departamentos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CIUDAD-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('ciudadr.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Ciudad/Municipio</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_LOCALIDAD-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('localidadr.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Localidad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_ESPACIOS-FISICOS-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('espaciofisicor.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Espacios Físicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CATEGORIAS-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('categoriar.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Categorías</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CLASE-VEHICULOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('clasevehiculo.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Clases de Vehículos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CLIENTES-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('cliente.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Clientes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_RECURSOS-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.menurecursos')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Recursos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_MANTENIMIENTO-RECURSOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.menumantenimiento')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Mantenimiento</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_SISTEMA-ALERTAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('preventivo.alerta','NO')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Sistema de Alertas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_CONDUCTORES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('conductor.index')}}"class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Gestión de Conductores</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_INACTIVIDAD-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('inactividadr.index')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Inactividad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_OCUPACION-ACADEMICA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('ocupacion.index')}}"  class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Ocupación Academica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                 @if(session()->exists('PAG_RESERVAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.menugestionreserva')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Reservas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REPORTES-RESERVA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.represerva')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Reportes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection