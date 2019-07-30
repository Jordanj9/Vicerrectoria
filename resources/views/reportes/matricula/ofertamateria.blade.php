@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Matrícula Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repmatacademica')}}"> Matricula Académica </a><span class="fa-angle-right fa"></span> Oferta de Materias
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de matrícula académica.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Materias Ofertadas</h3>
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });

    function pdf() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        if (u == null || p == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/matricula/" + u + "/" + p + "/ofertamateria/pdf";
            a.click();
        }
    }

    function excel() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        if (u == null || p == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/matricula/" + u + "/" + p + "/ofertamateria/excel";
            a.click();
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