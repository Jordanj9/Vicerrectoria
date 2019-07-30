@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Menú Módulo Reportes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Reportes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ REPORTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_REP-ADMISIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admisiones.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Admisiones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-LIQUIDACIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repliquidaciones')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Liquidaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-PROYECTAR-DEMANDA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repproyectardemanda')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Proyectar Demanda</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-MATRICULA-ACADEMICA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repmatacademica')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Matrícula Académica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-CALIFICACIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repcalificaciones')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Calificaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-SANCIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repsanciones')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Sanciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
<!--                @if(session()->exists('PAG_REP-ESTIMULOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled="isabled" href="{{route('admin.repestimulos')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Estímulos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif-->
                @if(session()->exists('PAG_REP-GRADOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled="isabled" href="{{route('admin.repgrados')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Grados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-CARGA-ACADEMICA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repcargaadmin')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Carga Administrativa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-ESTRUCTURA-CURRICULAR'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repestructuracurricular')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Estructura Curricular</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-RECURSOS-FISICOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.reprecursosfisicos')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Recursos Físicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-DEUDAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.repdeudas')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Deudas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-HORARIOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.rephorarios')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Horarios</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-SNIES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('snies.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Procesos SNIES y SPADIES</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_REP-JOVENES-EN-ACCION'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('jea.index')}}" class="btn ripple btn-gradient btn-danger">
                        <div>
                            <span>Jóvenes En Acción</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
