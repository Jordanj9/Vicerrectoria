@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Matrícula Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repmatacademica')}}"> Matricula Académica </a><span class="fa-angle-right fa"></span> Matriculados por Edades
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de matrícula académica por edades.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Matriculados por Edades</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Unidad Regional</label>
                            {!! Form::select('unidad_id',$unds,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'unidad_id','onchange'=>'getPeriodos()']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Período Académico</label>
                            {!! Form::select('periodoacademico_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodoacademico_id']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('edad_a', 'Desde', ['class' => 'control-label text-right'])!!}
                            {!! Form::number('edad_a',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Edad','id'=>'edad_a_id']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('edad_b', 'Hasta', ['class' => 'control-label text-right'])!!}
                            {!! Form::number('edad_b',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Edad','id'=>'edad_b_id']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group" style="text-align: center; margin-top: 35px;">
                                    <h4>Genere Reporte En PDF</h4>
                                    <a onclick="pdf()" class="btn btn-circle ripple-infinite btn-lg btn-danger"><div><span class="fa fa-file-pdf-o"></span></div></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="text-align: center; margin-top: 35px;">
                                    <h4>Genere Reporte En EXCEL</h4>
                                    <a onclick="excel()" class="btn btn-circle ripple-infinite btn-lg btn-success"><div><span class="fa fa-file-excel-o"></span></div></a>
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
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });

    function pdf() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        var ea = $("#edad_a_id").val();
        var eb = $("#edad_b_id").val();
        if (u == null || p == null || ea == null || eb == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            if (ea <= eb) {
                var a = document.createElement("a");
                a.target = "_blank";
                a.href = url + "reportes/matricula/" + u + "/" + p + "/" + ea + "/" + eb + "/poredad/pdf";
                a.click();
            } else {
                notify('Alerta', 'El valor del campo Hasta debe ser mayor que el valor del campo Desde', 'warning');
            }
        }
    }

    function excel() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        var ea = $("#edad_a_id").val();
        var eb = $("#edad_b_id").val();
        if (u == null || p == null || ea == null || eb == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            if (ea <= eb) {
                var a = document.createElement("a");
                a.target = "_blank";
                a.href = url + "reportes/matricula/" + u + "/" + p + "/" + ea + "/" + eb + "/poredad/excel";
                a.click();
            } else {
                notify('Alerta', 'El valor del campo Desde debe ser mayor que el valor del campo Hasta', 'warning');
            }
        }
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
</script>
@endsection