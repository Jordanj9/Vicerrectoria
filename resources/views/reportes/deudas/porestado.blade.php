@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Deudas</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repdeudas')}}"> Deudas </a><span class="fa-angle-right fa"></span> Reporte de Deudas por Estado
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de deudas.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Deudas por Estado</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Estado</label>
                            {!! Form::select('estado',['VIGENTE'=>'VIGENTE','ANULADA'=>'ANULADA','PAGADA'=>'PAGADA'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'estado']) !!}
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
        var e = $("#estado").val();
        if (e == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/deudas/" + e + "/porestado/pdf";
            a.click();
        }
    }

    function excel() {
        var e = $("#estado").val();
        if (e == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/deudas/" + e + "/porestado/excel";
            a.click();
        }
    }

</script>
@endsection