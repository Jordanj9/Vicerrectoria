@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Asignar Jefe</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('jefedepartamento.index')}}">Asignar Jefe </a> <span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario asignar un jefe a un docente.</p>
    </div>
</div>
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-heading">
                <h4>Datos del Encargado de Programa</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
<!--                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text('id',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba la identificación a consultar','id'=>'id']) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getPersona()">Traer Persona</button>
                        </div>
                    </div>
                </div>-->
                <div class="col-md-12">
                    {!! Form::open(['route'=>'jefedepartamento.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('docentejefe', 'Seleccione el Jefe', ['class' => 'control-label'])!!}
                            {!! Form::select('docentejefe',$docentes,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'docentejefe']) !!}
<!--                          <label class="control-label">Seleccione Persona Natural</label>
                            <select id='personanatural_id' class='form-control' onchange="mostrar()" required='required' name='personanatural_id'></select>-->
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Identificación del Encargado de Programa</label>
                            {!! Form::text('ident',null,['class'=>'form-control','placeholder'=>'Identificación de la persona','required','id'=>'ident']) !!}
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">Futuro Encargado de Programa</label>
                            {!! Form::text('persona',null,['class'=>'form-control','placeholder'=>'Persona natural','id'=>'persona']) !!}
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('docenteacademico_pege', 'Seleccione el Docente', ['class' => 'control-label'])!!}
                            {!! Form::select('docenteacademico_pege',$docentes,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'docenteacademico']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Inicial</label>
                            <input class="form-control col-md-7 col-xs-12" name="fechainicio" type="date" placeholder="Fecha de inicio" required="required" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Final</label>
                            <input class="form-control col-md-7 col-xs-12" name="fechafin" type="date" placeholder="Fecha final" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('jefedepartamento.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
                            <button class="btn btn-3d btn-primary" type="reset">Limpiar Formulario</button>
                            {!! Form::submit('Guardar',['class'=>'btn btn-3d btn-success']) !!}
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
    $(".chosen-select").chosen({});

    var vect = null;

    function getPersona() {
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Alerta', 'Debe ingresar identificación para continuar...', 'warning');
        } else {
            $.ajax({
                type: 'GET',
                url: url + "academico/pnaturales/" + id + "/personaNaturals",
                data: {},
            }).done(function (msg) {
                var m = JSON.parse(msg);
                if (m.error === "NO") {
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                    vect = m.data1;
                    $("#personanatural_id").append("<option value='0'>-- Seleccione una opción --</option>");
                    $.each(m.data2, function (index, item) {
                        $("#personanatural_id").append("<option value='" + index + "'>" + item + "</option>");
                    });
                } else {
                    notify('Atención', m.msg, 'error');
                    $("#ident").val("");
                    $("#persona").val("");
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                }
            });
        }
    }

    function getDepartamentos() {
        var id = $("#facultad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/facultad/" + id + "/get/departamentos",
            data: {},
        }).done(function (msg) {
            $('#departamento_id option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#departamento_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'La Facultad seleccionada no posee Departamentos asociados.', 'error');
            }
        });
    }

    function mostrar() {
        var id = $("#personanatural_id").val();
        var e = false;
        $.each(vect, function (index, item) {
            if (item.id == id) {
                $("#ident").val(item.identificacion);
                $("#persona").val(item.nombres + " " + item.apellidos);
                e = true;
            }
        });
        if (e === false) {
            $("#identificacion").val("");
            $("#ident").val("");
            $("#persona").val("");
        }
    }
    function getModalidad() {
        $("#modalidad").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/niveleducativo/" + id + "/modalidades",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#modalidad").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#modalidad").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Error', 'El nivel educativo no posee modalidades asociadas', 'error');
            }
        });
    }
    function getProgramas() {
        $("#programa").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/programas/" + $("#metodologia_id").val() + "/" + $("#modalidad").val() + "/" + $("#unidad_id").val() + "/programas2",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#programa").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $.each(item.pensums, function (index2, item2) {
                        $("#programa").append("<option value='" + item.id + ";" + item.programaunidad_id + ";" + item2.id + "'>PROGRAMA: " + item.nombre + " - PENSUM: " + item2.descripcion + " - " + item2.estadopensum.descripcion + "</option>");
                    });
                });
            } else {
                notify('Error', 'No hay programas para los parámetros dados.', 'error');
            }
        });
    }

</script>
@endsection
