@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Tesorería - Menú Módulo Tesorería</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.tesoreria')}}"> Módulo Tesorería </a>
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MATRÍCULA FINANCIERA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_TES-SALARIO-MINIMO'))
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('salariominimo.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Salario Mínimo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                @if(session()->exists('PAG_TES-VALORES-SEMESTRE'))
                                <div class="col-md-4" style="margin-top: 20px;">
                                    <a href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                    <a disabled='disabled' class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Gestionar Valores de Semestre</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif-->
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>LIQUIDACIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_TES-DATOSBASICOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.basicoliquidaciones')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos Básicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                @if(session()->exists('PAG_TES-INCREMENTO-DERECHOS-MATRICULA'))
                                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a href="{{route('incrementomatricula.index')}}" class="btn ripple btn-3d btn-primary">
                                    <a disabled='disabled' class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Incremento de Derechos de Matrícula</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif-->
                @if(session()->exists('PAG_TES-PARAMETRIZAR-DESCUENTOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('descuentos.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Parametrizar Descuentos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-PARAMETRIZAR-IMPEDIMENTOS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('impedimentos.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Parametrizar Impedimentos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-FECHA-LIMITE-PAGO'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('admin.fechalimitepago')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Fecha Límite de Pago</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-LIQUIDACION-INDIVIDUAL'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('liquidacionindividual.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidación Individual</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled="disabled" href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Cargar Archivo de Pagos de Matrícula</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled="disabled" href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Consolidado Total Liquidaciones</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                @if(session()->exists('PAG_TES-PARAMETRIZAR-CUENTAS-POR-PROGRAMA'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('cuentasporprograma.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Parametrizar Cuentas por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-REVERSAR-LIQUIDACIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('liquidacionautomatico.reversarliquidacion')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Reversar Liquidaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Conceptos de Matrícula Extraordinaria</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Matrícula Extraordinaria</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled="disabled" href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Descuento Pronto Pago por Norma</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                @if(session()->exists('PAG_TES-RECARGO-POR-NORMA'))
                <div class="col-md-8"  style="margin-top: 15px;">
                    <a href="{{route('recargopornorma.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Recargos por Norma (Define los Conceptos a Cobrar en la Liquidación)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                <!--                <div class="col-md-4"  style="margin-top: 15px;">
                                    <a disabled="disabled" href="{{route('admin.tesoreria')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Verificar Pagos en Línea</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>-->
                @if(session()->exists('PAG_TES-DESCUENTOS-AUTOMATICOS-MASIVOS'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('descuentos.automaticomasivo')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Descuentos Automáticos Masivos Por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-DESCUENTOS-AUTOMATICOS-MASIVOS-OK'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('descuentos.automaticomasivoaplicar')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Aplicar Descuentos Automáticos Masivos Por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-LIQUIDACION-AUTOMATICA-MENU'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('admin.liquidacionmenu')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Generar Liquidación de Matrícula (Proceso Automático)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_TES-LIQUIDACION-PECUNIARIOS-OTROS'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a href="{{route('admin.liquidacionpecuniarios')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Liquidación de Conceptos (Pecuniarios y Otros)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>DEUDAS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12 tabs-area" style="margin-bottom: 20px;">
                    <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
                        <li role="presentation" class="">
                            <a href="#tabs-demo7-area9" id="tabs-demo6-9" role="tab" data-toggle="tab" aria-expanded="false">Información Básica</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#tabs-demo7-area10" role="tab" id="tabs-demo6-10" data-toggle="tab" aria-expanded="true">Deudas Por Estudiante</a>
                        </li>
                        <!--                        <li role="presentation" class="">
                                                    <a href="#tabs-demo7-area11" id="tabs-demo6-11" role="tab" data-toggle="tab" aria-expanded="false">Cargar Archivo Plano Deudas por Estudiante</a>
                                                </li>-->
                    </ul>
                    <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
                        <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area9" aria-labelledby="tabs-demo7-area9">
                            @if(session()->exists('PAG_TES-GRUPODEUDAS'))
                            <div class="col-md-4">
                                <a href="{{route('grupodeudas.index')}}" class="btn ripple btn-3d btn-warning">
                                    <div>
                                        <span>Grupo de Deudas</span>
                                        <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                </a>
                            </div>
                            @endif
                            @if(session()->exists('PAG_TES-TIPODEUDAS'))
                            <div class="col-md-4">
                                <a href="{{route('tipodeudas.index')}}" class="btn ripple btn-3d btn-warning">
                                    <div>
                                        <span>Tipo de Deudas</span>
                                        <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area10" aria-labelledby="tabs-demo7-area10">
                            @if(session()->exists('PAG_TES-DEUDASESTUDIANTE'))
                            <div class="col-md-4">
                                <a href="{{route('deudasestudiante.index')}}" class="btn ripple btn-3d btn-warning">
                                    <div>
                                        <span>Deudas por Estudiante</span>
                                        <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                </a>
                            </div>
                            @endif
                        </div>
                        <!--                        <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area11" aria-labelledby="tabs-demo7-area11">
                                                    @if(session()->exists('PAG_TES-ARCHIVODEUDASEST'))
                                                    <div class="col-md-12">
                                                        <a href="#" class="btn ripple btn-3d btn-warning">
                                                            <div>
                                                                <span>Cargar Archivo Plano Deudas por Estudiante</span>
                                                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
