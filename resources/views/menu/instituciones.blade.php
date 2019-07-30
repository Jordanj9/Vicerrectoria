@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Gestión de Instituciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Datos Generales </a><span class="fa-angle-right fa"></span> Instituciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Gestione la información de las instituciones de educación superior, instituciones de educación media, instituciones en general, instituciones extranjeras y personas jurídicas generales.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ GESTIÓN DE INSTITUCIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12 tabs-area">
                    <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">GESTIONAR INSTITUCIONES</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tabs-demo7-area2" role="tab" id="tabs-demo6-2" data-toggle="tab" aria-expanded="false">DATOS GENERALES</a>
                        </li>
                    </ul>
                    <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
                        <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
                            <div class="col-md-12">
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('ies.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Instituciones de Educación Superior</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('iem.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Instituciones de Educación Media</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('otras.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Otras Instituciones</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('extranjeras.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Instituciones Extranjeras</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area2" aria-labelledby="tabs-demo7-area2">
                            <div class="col-md-12">
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('tipoinstitucion.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Tipos de Instituciones</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('tipopersonaj.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Tipos de Personas Jurídicas</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('caractera.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Carácter Académico IES</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <a href="{{route('caracteram.index')}}" class="btn ripple btn-3d btn-danger">
                                        <div>
                                            <span>Carácter Académico IEM</span>
                                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                                    </a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
