@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Admisiones - Menú Habilitar Pines no Usados</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.admisiones')}}"> Módulo Admisiones </a><span class="fa-angle-right fa"></span><a href="{{route('admin.admisiones')}}"> Inscripciones </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.admisiones')}}"> Pines </a><span class="fa-angle-right fa"></span> Habilitar Pines no Usados
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite habilitar los pines que no fueron usados por los aspirantes en el proceso de inscripción para ser reutilizados en períodos posteriores a su generación. </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ HABILITAR PINES NO USADOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('pin.habilitarlibres')}}" class="btn ripple btn-gradient btn-warning">
                        <div>
                            <span>Habilitar Pines Libres</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('pin.habilitarbanco')}}" class="btn ripple btn-gradient btn-warning">
                        <div>
                            <span>Habilitar Pines Banco</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
