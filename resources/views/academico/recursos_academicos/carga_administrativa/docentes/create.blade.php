@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docentes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span><a href="{{route('docentes.index')}}"> Docentes </a><span class="fa-angle-right fa"></span> Crear Docente
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue nuevos docentes. Contiene la información de los docentes de la institución</p>
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
                <h4>Datos del Docente</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text('id',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba la identificación a consultar','id'=>'id']) !!}
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getPersona()">Traer Docente</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 30px;">
                    {!! Form::open(['route'=>'docentes.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <input type="hidden" id="identificacion" name="identificacion" required="required">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Seleccione Docente</label>
                            <select id='personanatural_id' class='form-control' onchange="mostrar()" required='required' name='personanatural_id'></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label">Identificación del Docente</label>
                            {!! Form::text('ident',null,['class'=>'form-control','placeholder'=>'Identificación de la persona','required','id'=>'ident']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Futuro Docente en Comisión</label>
                            {!! Form::text('persona',null,['class'=>'form-control','placeholder'=>'Persona natural','id'=>'persona']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Código Para el Docente</label>
                            {!! Form::text('codigo',null,['class'=>'form-control','placeholder'=>'Código asignado por la universidad']) !!}
                        </div>
                    </div>
                    <legend>Datos de Labor</legend>
                    <div class="form-group"
                        <div class="col-md-12">
                            {!! Form::label('tipo', 'Cargo', ['class' => 'control-label'])!!}
                            {!! Form::select('cargo_id',$cargos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'cargo_id','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('docentes.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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
                    $("#identificacion").val("");
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
                $("#identificacion").val(item.identificacion);
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
</script>
@endsection