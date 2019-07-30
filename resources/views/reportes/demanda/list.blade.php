@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Proyectar Demanda</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.repproyectardemanda')}}"> Menú Reportes de Proyectar Demanda </a><span class="fa-angle-right fa"></span> Demanda Por Materia
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de Demanda.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reporte de Demanda Por Materia</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class='form-horizontal form-label-left'>
                        {{ csrf_field() }}
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
                        <div class="form-group" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <a href="{{route('admin.repproyectardemanda')}}" class="btn btn-3d btn-danger">Cancelar</a>
                                <button type="button" class='btn btn-3d btn-success' onclick="ir()">Continuar</button>
                            </div>
                        </div>
                    </form>
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

    function ir() {
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        location.href = url + "reportes/repdemanda/porasignatura/pdf/" + u + "/" + p;
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