@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Recursos Físicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.reprecursosfisicos')}}"> Recuros Físicos </a><span class="fa-angle-right fa"></span> Ocupación Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes de los Recursos Físicos.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de la Ocupación Académica</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('periodo', 'Periodo Académico', ['class' => 'control-label text-right'])!!}
                            {!! Form::select('periodo',$per,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'periodo','onchange'=>'getOcupacion()']) !!}
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
        var p = $("#periodo").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/recursos/ocupacion/" + p + "/pdf";
            a.click();
        }
    }

    function excel() {
        var u = $("#localidad_id").val();
        var p = $("#tipo_id").val();
        var e = $("#espaciofisico").val();
        if (u == null || p == null || e == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/recursos/porespacio/" + p + "/" + e + "/excel";
            a.click();
        }
    }

    function getEf() {
        var id = $("#localidad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/localidad/" + id + "/espaciofisicos",
            data: {},
        }).done(function (msg) {
            $('#espaciofisico option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#espaciofisico").append("<option value='0'>-- Seleccione opción --</option>");
                $.each(m, function (index, item) {
                    $("#espaciofisico").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'La localidad seleccionada no posee información de espacios físicos.', 'error');
            }
        });
    }

</script>
@endsection