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
        <strong>Detalles: </strong> Este modulo esta dedicado a la gestión por parte del estudiante del aula virtual. Mire los contenidos de las asignaturas y descargue los materiales. Mire sus actividades y descargue los documentos para realizarlas, suba sus actividades realizadas, resuelva exámenes, visualice sus calificaciones, cree temas en los foros de discusión y gestione mensajes directos entre sus contactos. 
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
                    <div class="col-md-5">
                        <label class="control-label">Estudiante</label>
                        <select name="estudiante_id" id="estudiante_id" class="form-control" placeholder="-- Seleccione una opción --">
                            <option value="00">-- Seleccione una opción --</option>
                            @foreach($est as $key=>$e)
                            @foreach($e as $i)
                            <option value="{{$key}}">{{$i}}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Período Académico</label>
                        {!! Form::select('periodo',$pa,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo','onchange'=>'getAsignaturas()']) !!}
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Asignatura</label>
                        {!! Form::select('asignaturas',[],null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required','id'=>'asignaturas']) !!}
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
    });

    $(".chosen-select").chosen({});

    function getAsignaturas() {
        var ide = $("#estudiante_id").val();
        var per = $("#periodo").val();
        $.ajax({
            type: 'GET',
            url: url + "aulavirtual/asignatura/" + ide + "/" + per + "/asignaturasest",
            data: {},
        }).done(function (msg) {
            $('#asignaturas option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#asignaturas").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#asignaturas").append("<option value='" + index + "'>" + item + "</option>");
                });
            } else {
                notify('Atención', 'Usted no tiene asignaturas asignadas en el período seleccionado', 'error');
            }
        });
    }

    function continuar() {
        var id = $("#asignaturas").val();
        var idpa = $("#periodo").val();
        var est = $("#estudiante_id").val();
        if (id !== null) {
            location.href = url + "aulavirtual/panelcurso/" + id + "/" + idpa + "/" + est + "/estudiante";
        } else {
            notify('Alerta','Debe indicar una asignatura para continuar.','error');
        }
    }

</script>
@endsection