@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Admisión</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admisiones.index')}}"> Admisiones </a><span class="fa-angle-right fa"></span> <a href="{{route('admisiones.menu',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}"> Menú </a><span class="fa-angle-right fa"></span> Inscritos Por Programa
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de admisión.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Admisión: Inscritos Por Programa</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <tbody>
                                <tr class="success">
                                    <th>Tipo Unidad</th>
                                    <th>Unidad</th>
                                    <th>Ciudad</th>
                                </tr>
                                <tr>
                                    <th>{{$u->TipoUnidad->descripcion}}</th>
                                    <th>{{$u->nombre}}</th>
                                    <th>{{$u->ciudad->nombre}}</th>
                                </tr>
                                <tr class="success">
                                    <th>Año</th>
                                    <th>Período</th>
                                    <th>Tipo Período</th>
                                </tr>
                                <tr>
                                    <th>{{$per->anio}}</th>
                                    <th>{{$per->periodo}}</th>
                                    <th>{{$per->TipoPeriodo->descripcion}}</th>
                                </tr>
                                <tr class="success">
                                    <th>Metodología de Estudio</th>
                                    <th>Nivel Educativo</th>
                                    <th>Modalidad Académica</th>
                                </tr>
                                <tr>
                                    <th>{{$me->nombre}}</th>
                                    <th>{{$ne->descripcion}}</th>
                                    <th>{{$mo->descripcion}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Programa Académico</label>
                            {!! Form::select('programa[]',$pr,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','multiple']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Estado de Admisión</label>
                            {!! Form::select('estadoadmision',['ASPIRANTE'=>'ASPIRANTE','ADMITIDO'=>'ADMITIDO','ANULADO'=>'ANULADO','NO ADMITIDO'=>'NO ADMITIDO','TODOS'=>'TODOS'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'estadoadmision']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Ordenar Por</label>
                            {!! Form::select('orden',['nombres'=>'NOMBRES','identificacion'=>'IDENTIFICACIÓN','estadoa'=>'ESTADO ADMISIÓN','sexo'=>'SEXO','tipoprueba'=>'TIPO PRUEBA'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'orden']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Estado De La Convocatoria</label>
                            {!! Form::select('estadoc',['ABIERTA'=>'ABIERTA','CERRADA'=>'CERRADA','CANCELADA'=>'CANCELADA'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'estadoc']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group" style="text-align: center;">
                            <h4>Genere Reporte En PDF</h4>
                            <a onclick="pdf()" class="btn btn-circle ripple-infinite btn-lg btn-danger"><div><span class="fa fa-file-pdf-o"></span></div></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="text-align: center;">
                            <h4>Genere Reporte En EXCEL</h4>
                            <a onclick="excel()" class="btn btn-circle ripple-infinite btn-lg btn-success"><div><span class="fa fa-file-excel-o"></span></div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });

    $(".chosen-select").chosen({});


    function pdf() {
        var p = $("#programa").val();
        var ea = $("#estadoadmision").val();
        var orden = $("#orden").val();
        var ec = $("#estadoc").val();
        if (ea == null || orden == null || ec == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/admisiones/<?php echo $u->id; ?>/<?php echo $per->id ?>/<?php echo $me->id ?>/<?php echo $mo->id ?>/<?php echo $ne->id ?>/" + p + "/" + ea + "/" + orden + "/" + ec + "/menu/inscritosxprograma/pdf";
            a.click();
        }
    }

    function excel() {
        var p = $("#programa").val();
        var ea = $("#estadoadmision").val();
        var orden = $("#orden").val();
        var ec = $("#estadoc").val();
        if (ea == null || orden == null || ec == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/admisiones/<?php echo $u->id; ?>/<?php echo $per->id ?>/<?php echo $me->id ?>/<?php echo $mo->id ?>/<?php echo $ne->id ?>/" + p + "/" + ea + "/" + orden + "/" + ec + "/menu/inscritosxprograma/excel";
            a.click();
        }
    }

</script>
@endsection