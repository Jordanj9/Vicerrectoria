@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Práctica Empresarial > Datos Básicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.practicaempresarial')}}"> Práctica Empresarial </a><span class="fa-angle-right fa"></span> Datos Básicos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario ingresar al aplicativo los datos necesarios para dar inicio al proceso de manejo del módulo de práctica empresarial.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ PRÁCTICA EMPRESARIAL - DATOS BÁSICOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('areapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Área de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('tipopractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Tipo de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('requisitopractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Requisito de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('tipocertipractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Tipo de Certificado de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('preguntapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Pregunta de Seguimiento de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('coordinadorpractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Coordinador de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('empresapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Empresa de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('ofertapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Oferta de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
