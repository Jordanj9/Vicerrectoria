@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Matrícula Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repmatacademica')}}"> Matricula Académica </a><span class="fa-angle-right fa"></span> Matriculados por Periodos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes numéricos del proceso de matrícula académica.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Matriculados Por Periodo</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class='form-horizontal form-label-left'>
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('tipo', 'Tipo de Unidad', ['class' => 'control-label'])!!}
                                {!! Form::select('tipo',$tu,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'tipo','onchange'=>'getUnidad()']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('unidad', 'Unidad', ['class' => 'control-label'])!!}
                                {!! Form::select('unidad_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'unidad_id','onchange'=>'getPeriodos()']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('periodo', 'Período', ['class' => 'control-label'])!!}
                                {!! Form::select('periodoacademico_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodoacademico_id']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('metodologia_id', 'Metodología de Estudio', ['class' => 'control-label'])!!}
                                {!! Form::select('metodologia_id',$met,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'metodologia_id']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('nivel_id', 'Nivel Educativo', ['class' => 'control-label'])!!}
                                {!! Form::select('nivel_id',$ne,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'nivel_id','onchange'=>'getModalidad()']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('modalidad', 'Modalidad Educativa', ['class' => 'control-label'])!!}
                                {!! Form::select('modalidad',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'modalidad','onchange'=>'getProgramas()']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('programa', 'Programa', ['class' => 'control-label'])!!}
                                {!! Form::select('programa',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','multiple']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align: center; margin-top: 35px;">
                                <h4>Genere Reporte En PDF</h4>
                                <a onclick="pdf()" class="btn btn-circle ripple-infinite btn-lg btn-danger"><div><span class="fa fa-file-pdf-o"></span></div></a>
                            </div>
                        </div>
<!--                        <div class="col-md-6">
                            <div class="form-group" style="text-align: center; margin-top: 35px;">
                                <h4>Genere Reporte En EXCEL</h4>
                                <a onclick="excel()" class="btn btn-circle ripple-infinite btn-lg btn-success"><div><span class="fa fa-file-excel-o"></span></div></a>
                            </div>
                        </div>-->
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
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        var id = $("#programa").val();
        var me = $("#metodologia_id").val();
        var ne = $("#nivel_id").val();
        var mo = $("#modalidad").val();
        if (u == null || p == null || id.length <= 0) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/matricula/" + id + "/" + u + "/" + p + "/" + me + "/" + ne + "/" + mo + "/porperiodo/pdf";
            a.click();
        }
    }

    function excel() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        var id = $("#programa").val();
        if (u == null || p == null || id.length <= 0) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var v = id.split(";");
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/matricula/" + v[1] + "/" + u + "/" + p + "/matprimersemestre/excel";
            a.click();
        }
    }

    function getUnidad() {
        $("#unidad_id").empty();
        var id = $("#tipo").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/tipounidad/" + id + "/unidades",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#unidad_id").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#unidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Error', 'El tipo de unidad no posee unidades asociadas', 'error');
            }
        });
    }

    function getPeriodos() {
        $("#periodoacademico_id").empty();
        var id = $("#unidad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/ppa/" + id + "/periodos",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#periodoacademico_id").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#periodoacademico_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Alerta', 'La unidad seleccionada no posee períodos asociados', 'error');
            }
        });
    }

    function getModalidad() {
        $("#modalidad").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/niveleducativo/" + id + "/modalidades",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#modalidad").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#modalidad").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Error', 'El nivel educativo no posee modalidades asociadas', 'error');
            }
        });
    }
    function getProgramas() {
        $("#programa").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/programas/" + $("#metodologia_id").val() + "/" + $("#modalidad").val() + "/" + $("#unidad_id").val() + "/programas2",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#programa").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $.each(item.pensums, function (index2, item2) {
                        $("#programa").append("<option value='" + item.id + ";" + item.programaunidad_id + ";" + item2.id + "'>PROGRAMA: " + item.nombre + " - PENSUM: " + item2.descripcion + " - " + item2.estadopensum.descripcion + "</option>");
                    });
                });
            } else {
                notify('Error', 'No hay programas para los parámetros dados.', 'error');
            }
        });
    }
</script>
@endsection