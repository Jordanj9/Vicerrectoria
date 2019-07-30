@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Admisión</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admisiones.index')}}"> Admisiones </a><span class="fa-angle-right fa"></span> <a href="{{route('admisiones.menu',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}"> Menú </a><span class="fa-angle-right fa"></span> Formularios sin Programas
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
                <h3>Reportes de Admisión: Formularios sin Programas</h3>
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
                        <div class="col-md-6">
                            <label class="control-label">Fecha Inicial</label>
                            <input class="form-control" type="datetime-local" name="fechainicial" id="fechai"/>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Fecha Final</label>
                            <input class="form-control" type="datetime-local" name="fechafin" id="fechaf"/>
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
        var fi = $("#fechai").val();
        var ff = $("#fechaf").val();
        if (fi == null || ff == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/admisiones/<?php echo $u->id; ?>/<?php echo $per->id ?>/<?php echo $me->id ?>/<?php echo $mo->id ?>/<?php echo $ne->id ?>/" + fi + "/" + ff + "/menu/formulariosinprograma/pdf";
            a.click();
        }
    }
    
    function excel() {
        var fi = $("#fechai").val();
        var ff = $("#fechaf").val();
        if (fi == null || ff == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/admisiones/<?php echo $u->id; ?>/<?php echo $per->id ?>/<?php echo $me->id ?>/<?php echo $mo->id ?>/<?php echo $ne->id ?>/" + fi + "/" + ff + "/menu/formulariosinprograma/excel";
            a.click();
        }
    }

</script>
@endsection