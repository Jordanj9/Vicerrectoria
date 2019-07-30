@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Liquidaciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Liquidaciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de liquidación.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Liquidación</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'liquidaciones.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
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
                        <div class="col-md-4">
                            {!! Form::label('metodologia_id', 'Metodología Académica', ['class' => 'control-label text-right'])!!}
                            {!! Form::select('metodologia_id',$metodologias,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'metodologia_id']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('nivel_educativo_id', 'Nivel Educativo', ['class' => 'control-label text-right'])!!}
                            {!! Form::select('nivel_Educativo_id',$nivel,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','onchange'=>'traerModalidad()','id'=>'nivel_educativo_id']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('modalidad_id', 'Modalidad Académica', ['class' => 'control-label text-right'])!!}
                            {!! Form::select('modalidad_id',[''=>''],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','onchange'=>'getProgramas()','id'=>'modalidad_id']) !!}
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <a href="{{route('admin.reportes')}}" class="btn btn-3d btn-danger">Cancelar</a>
                            <button type="button" class='btn btn-3d btn-success' onclick="ir()">Continuar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
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
        var met = $("#metodologia_id").val();
        var mod = $("#modalidad_id").val();
        var n = $("#nivel_educativo_id").val();
        location.href = url + "reportes/liquidaciones/" + u + "/" + p + "/" + met + "/" + mod + "/" + n + "/menu";
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

    function traerModalidad() {
        $("#modalidad_id").empty();
        var id = $("#nivel_educativo_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/niveleducativo/" + id + "/modalidades",
            data: {},
        }).done(function (msg) {
            var m = JSON.parse(msg);
            $("#modalidad_id").append("<option value='00'>-- Seleccione una opción --</option>");
            $.each(m, function (index, item) {
                $("#modalidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
            });
        });
    }
</script>
@endsection