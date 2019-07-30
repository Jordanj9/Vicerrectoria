@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reserva Recursos - Menú Gestión de Reservas</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reservarecurso')}}"> Módulo Reserva de Recursos </a><span class="fa-angle-right fa"></span> Menú Gestió de Reservas
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ GESTIÓN RESERVA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('gestionreserva.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Reservar Pendientes (Aprobar/No Aprobar y Generar Pago)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('gestionreserva.index2')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Registrar Pagos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('gestionreserva.index3')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Finalizar Reservas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('gestionreserva.index4')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Históricos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
