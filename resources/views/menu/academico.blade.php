@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Módulo Académico</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Académico
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-raised alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Nota: </strong> Pasa el mouse sobre el icono para conocer el módulo.
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>RECURSOS ACADÉMICOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12 tabs-area">
                    <div class="liner"></div>
                    <ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
                        <li class="active">
                            <a href="#tabs-demo6-area1" data-toggle="tab" title="Carga Administrativa" aria-expanded="true">
                                <span class="round-tabs one">
                                    <i class="fa fa-address-card"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabs-demo6-area3" data-toggle="tab" title="Estructura Curricular" aria-expanded="true">
                                <span class="round-tabs three">
                                    <i class="fa fa-tasks"></i>
                                </span> </a>
                        </li>
                        <li class=""><a href="#tabs-demo6-area6" data-toggle="tab" title="Calendario Académico" aria-expanded="false">
                                <span class="round-tabs one">
                                    <i class="fa fa-calendar"></i>
                                </span> </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-v5">
                        <div class="tab-pane fade active in" id="tabs-demo6-area1">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_PERSONAS-NATURALES'))
                                <div class="col-md-4">
                                    <a href="{{route('pnaturales.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Docentes</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_CARGOS'))
                                <div class="col-md-4">
                                    <a href="{{route('cargo.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Cargos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_UNIDADES'))
                                <div class="col-md-4">
                                    <a href="{{route('admin.unidades')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Unidades</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_DOCENTES'))
                                <div class="col-md-4">
                                    <a href="{{route('docentes.index')}}" class="btn ripple btn-3d btn-success">
                                        <div>
                                            <span>Docentes en Comisión</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-demo6-area3">
                            <div class="col-md-12">
                                @if(session()->exists('PAG_METODOLOGIA-ESTUDIO'))
                                <div class="col-md-4">
                                    <a href="{{route('metodologia.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Metodología de Estudio</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_NIVEL-EDUCATIVO'))
                                <div class="col-md-4">
                                    <a href="{{route('niveleducativo.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Nivel Educativo</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_MODALIDAD-EDUCATIVA'))
                                <div class="col-md-4">
                                    <a href="{{route('modalidad.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Modalidad Educativa</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_JORNADA'))
                                <div class="col-md-4">
                                    <a href="{{route('jornada.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Jornada</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPO-PERIODO-ACADEMICO'))
                                <div class="col-md-4">
                                    <a href="{{route('tipoperiodo.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Tipo Periodo Académico</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPO-PERIODO-ACADEMICO'))
                                <div class="col-md-4">
                                    <a href="{{route('facultad.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Facultades</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                                @if(session()->exists('PAG_TIPO-PERIODO-ACADEMICO'))
                                <div class="col-md-4">
                                    <a href="{{route('departamentos.index')}}" class="btn ripple btn-3d btn-primary">
                                        <div>
                                            <span>Departamentos</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-demo6-area6">
                            @if(session()->exists('PAG_PERIODOS-ACADEMICOS'))
                            <div class="col-md-4">
                                <a href="{{route('periodoa.index')}}" class="btn ripple btn-3d btn-success">
                                    <div>
                                        <span>Periodos Académicos</span>
                                        <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                </a>
                            </div>
                            @endif
                            @if(session()->exists('PAG_PROGRAMAR-PERIODOS'))
                            <div class="col-md-4">
                                <a href="{{route('ppa.index')}}" class="btn ripple btn-3d btn-success">
                                    <div>
                                        <span>Programar Períodos Académicos</span>
                                        <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>DATOS GENERALES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                @if(session()->exists('PAG_TIPO-DOCUMENTO'))
                <div class="col-md-4" style="margin-top: 20px;">
                    <a href="{{route('tipodoc.index')}}" class="btn ripple btn-3d btn-danger">
                        <div>
                            <span>Tipos de Documentos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection