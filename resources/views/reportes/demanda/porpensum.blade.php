@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Proyectar Demanda</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.repproyectardemanda')}}"> Menú Reportes de Proyectar Demanda </a><span class="fa-angle-right fa"></span> Demanda Por Pensum
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
                <h3>Reporte de Demanda Por Pensum</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class='form-horizontal form-label-left' method="post" action="{{route('repdemanda.porpensum_pdf')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-8">
                                {!! Form::label('tipo', 'Unidad Regional', ['class' => 'control-label'])!!}
                                {!! Form::select('unds',$unds,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'unds','onchange'=>'getPeriodos()']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tipo', 'Período Académico', ['class' => 'control-label'])!!}
                                {!! Form::select('per',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'per']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('tipo', 'Metodología', ['class' => 'control-label'])!!}
                                {!! Form::select('met',$met,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'met']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tipo', 'Nivel Educativo', ['class' => 'control-label'])!!}
                                {!! Form::select('nivel',$nivel,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'nivel','onchange'=>'getModalidad()']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tipo', 'Modalidad Educativa', ['class' => 'control-label'])!!}
                                {!! Form::select('moda',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'moda','onchange'=>'getProgramas()']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('tipo', 'Programa', ['class' => 'control-label'])!!}
                                {!! Form::select('prog',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'prog','onchange'=>'getPensums()']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('tipo', 'Pensum', ['class' => 'control-label'])!!}
                                {!! Form::select('pensum',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'pensum']) !!}
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <a href="{{route('admin.repproyectardemanda')}}" class="btn btn-3d btn-danger">Cancelar</a>
                                <button type="submit" class='btn btn-3d btn-success'>Continuar</button>
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

    function getModalidad() {
        $("#moda").empty();
        var id = $("#nivel").val();
        $.ajax({
            type: 'GET',
            url: url + "niveleducativop/" + id + "/modalidades",
            data: {},
        }).done(function (msg) {
            var m = JSON.parse(msg);
            $("#moda").append("<option value='0'>-- Seleccione una opción --</option>");
            $.each(m, function (index, item) {
                $("#moda").append("<option value='" + item.id + "'>" + item.value + "</option>");
            });
        });
    }

    function getProgramas() {
        $("#prog").empty();
        var mod = $("#moda").val();
        var met = $("#met").val();
        var und = $("#unds").val();
        var per = $("#per").val();
        $.ajax({
            type: 'GET',
            url: url + "convocatoriap/" + mod + "/" + met + "/" + und + "/" + per + "/programasae",
            data: {},
        }).done(function (msg) {
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#prog").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#prog").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Alerta', 'No existen programas ofertados para los parametros dados.', 'error');
            }
        });
    }

    function getPensums() {
        $("#pensum").empty();
        var id = $("#prog").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/programas/" + id + "/pensums",
            data: {},
        }).done(function (msg) {
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#pensum").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#pensum").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Alerta', 'No existen Pensums ofertados para los parametros dados.', 'error');
            }
        });
    }

    function getPeriodos() {
        $("#per").empty();
        var id = $("#unds").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/ppa/" + id + "/periodos",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#per").append("<option value='00'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#per").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
                $(".chosen-select").chosen({});
            } else {
                notify('Alerta', 'No hay períodos académicos relacionados a la unidad regional', 'error');
                $("#per").empty();
            }
        });
    }
</script>
@endsection