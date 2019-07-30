@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Aula Virtual - Menú Del Aula Virtual</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Aula Virtual
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <strong>Detalles: </strong> En este modulo usted debe crear los contenidos de las asignaturas que dicta para cada periodo académico, las actividades, los exámenes, crear foros de discusión para los contenidos temáticos de la asignatura, interactuar con los estudiantes frecuentemente para aclarar dudas de la temática y actividades, calificar exámenes y visualizar las notas con su equivalente para el software académico. 
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>SELECCIONA PERÍODO ACADÉMICO Y ASIGNATURA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Período Académico</label>
                        {!! Form::select('periodo',$pa,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo','onchange'=>'getAsignaturas()']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Asignatura</label>
                        {!! Form::select('asignaturas',[],null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required','id'=>'asignaturas','onchange'=>'getGrupos()']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Grupo</label>
                        {!! Form::select('grupo',[],null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required','id'=>'grupo']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <br/><button class="btn btn-3d btn-success" type="button" onclick="continuar()">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>BANCO DE PREGUNTAS POR ASIGNATURA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label">Período Académico</label>
                        {!! Form::select('periodo2',$pa,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo2','onchange'=>'getAsignaturas2()']) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Asignatura</label>
                        {!! Form::select('asignaturas2',[],null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required','id'=>'asignaturas2']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <br/><button class="btn btn-3d btn-success" type="button" onclick="continuar2()">Continuar</button>
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
        $('#tabla').DataTable();
    });

    $(".chosen-select").chosen({});

    function getAsignaturas() {
        var id = $("#periodo").val();
        $.ajax({
            type: 'GET',
            url: url + "aulavirtual/asignatura/" + id + "/asignaturas",
            data: {},
        }).done(function (msg) {
            $('#asignaturas option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#asignaturas").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#asignaturas").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'Usted no tiene asignaturas asignadas en el período seleccionado', 'error');
            }
        });
    }

    function getAsignaturas2() {
        var id = $("#periodo2").val();
        $.ajax({
            type: 'GET',
            url: url + "aulavirtual/asignatura/" + id + "/asignaturas",
            data: {},
        }).done(function (msg) {
            $('#asignaturas2 option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#asignaturas2").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#asignaturas2").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'Usted no tiene asignaturas asignadas en el período seleccionado', 'error');
            }
        });
    }

    function getGrupos() {
        var id = $("#asignaturas").val();
        var idpa = $("#periodo").val();
        $.ajax({
            type: 'GET',
            url: url + "aulavirtual/grupoav/" + id + "/" + idpa + "/grupos",
            data: {},
        }).done(function (msg) {
            $('#grupo option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#grupo").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#grupo").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'No existen grupos para la asignatura seleccionada', 'error');
            }
        });
    }

    function continuar() {
        var id = $("#asignaturas").val();
        var idpa = $("#periodo").val();
        var idg = $("#grupo").val();
        location.href = url + "aulavirtual/panelcurso/" + id + "/" + idg + "/" + idpa;
    }

    function continuar2() {
        var id = $("#asignaturas2").val();
        location.href = url + "aulavirtual/preguntasdoc/" + id + "/index";
    }
</script>
@endsection