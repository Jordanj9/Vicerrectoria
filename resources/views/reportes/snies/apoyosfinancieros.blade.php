@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes Procesos SNIES y SPADIES</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('snies.index')}}"> Snies y Spadies </a><span class="fa-angle-right fa"></span> Apoyos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Reporte de apoyos financieros, académicos y otros apoyos dados a los estudiantes en un período académico indicado.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reporte Apoyos Financieros, Académicos y Otros Apoyos</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Período Académico</label>
                            {!! Form::select('periodo',$per,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">¿Es Período Actual?</label>
                            {!! Form::select('actual',['1'=>'SI','0'=>'NO'],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'actual']) !!}
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
                            <a onclick="excel()" target="_blank" class="btn btn-circle ripple-infinite btn-lg btn-success"><div><span class="fa fa-file-excel-o"></span></div></a>
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
        var ac = $("#actual").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar el período para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/snies/apoyosfinancieros/inicio/" + p + "/" + ac + "/pdf";
            a.click();
        }
    }

    function excel() {
        var p = $("#periodo").val();
        var ac = $("#actual").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar el período para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/snies/apoyosfinancieros/inicio/" + p + "/" + ac + "/excel";
            a.click();
        }
    }
</script>
@endsection