@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Módulo Matrícula Estudiante</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Menú Módulo Matrícula Estudiante
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÓDULO MATRÍCULA ESTUDIANTE</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_EST-REALIZAR-MATRICULA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.enlinea')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Realizar Matrícula en Línea</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-CONSULTAR-MATRICULA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.consultarmatricula')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Consultar Matrícula Académica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-HORARIO-ESTUDIANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.consultarhorario')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Horario Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-CANCELAR-MATERIA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.cancelarmateriainicio')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Cancelar Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-INCLUIR-MATERIA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.adicionarmateriainicio')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Incluir Materia</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_EST-DEMANDA-ESTUDIANTE'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('matriculae.demandaest')}}" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Demanda De Materias</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
