@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Reglas</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.calificaciones')}}"> Calificaciones </a><span class="fa-angle-right fa"></span> Reglas
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar los parámetros por los cuales serán condicionadas las reglas para el proceso de calificaciones. Dependiendo de las reglas asignadas al programa; en esta opción se darán los valores específicos o condiciones para el cumplimiento de las mismas. De acuerdo a lo contemplado en las normas y el reglamento de la institución. Consta de las siguientes funcionalidades: De Rendimiento y Asociar Reglas a Pensum. </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>REGLAS DE RENDIMIENTO</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
                    <h3>Detalles
                        <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </h3>
                    <p>Esta funcionalidad permite al usuario parametrizar las reglas de rendimiento académico por pensum. Estas reglas principalmente se habilitan para las actualizaciones de la situación académica (activo, condicional, excluido por bajo rendimiento académico) de un estudiante de acuerdo a la reglamentación de la institución. Se aplican en el periodo de cierres de calificaciones, deben parametrizarse antes del proceso de cierre de calificaciones para que a través de su designación se evalúe académicamente al estudiante, teniendo en cuenta su registro académico histórico y el del actual periodo cursado. Consta de las siguientes funcionalidades: Reglas de la institución y Asociar reglas a pensum.</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('reglarendimiento.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Reglas de la Institución</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('reglapensum.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asociar Reglas a Pensum</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
