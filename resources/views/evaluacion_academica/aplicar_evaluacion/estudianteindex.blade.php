@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> Aplicar Evaluación
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite realizar la evaluación académica aplicada a los estudiantes.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Realizar Evaluación Académica</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-8">
                        {!! Form::label('norma_id', 'Programa', ['class' => 'control-label'])!!}
                        {!! Form::select('programa',$programas,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','onchange'=>'getPeriodos()']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('norma_id', 'Período Académico', ['class' => 'control-label'])!!}
                        {!! Form::select('periodo',[],null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo','onchange'=>'ir()']) !!}
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

    function getPeriodos() {
        $("#periodo").empty();
        var ep = $("#programa").val();
        if (ep !== null) {
            $.ajax({
                type: 'GET',
                url: url + "estudiante/matriculae/enlinea/" + ep + "/periodosestudiante",
                data: {}
            }).done(function (msg) {
                if (msg !== "null") {
                    var m = JSON.parse(msg);
                    $("#periodo").append("<option value='00'>-- Seleccione una opción --</option>");
                    $.each(m, function (index, item) {
                        $("#periodo").append("<option value='" + index + "'>" + item + "</option>");
                    });
                } else {
                    notify('Atención', 'El programa seleccionado no posee períodos activos para el estudiante.', 'error');
                }
            });
        } else {
            notify('Atención', 'Debe indicar un programa para continuar', 'error');
        }
    }

    function ir() {
        var per = $("#periodo").val();
        var ep = $("#programa").val();
        if (ep !== null && per !== null) {
            location.href = url + "evaluacionacademica/aplicacionestudiante/inicio/" + ep + "/" + per + "/matricula/academica";
        } else {
            notify('Atención', 'Debe indicar un programa y un período para continuar', 'error');
        }
    }

</script>
@endsection