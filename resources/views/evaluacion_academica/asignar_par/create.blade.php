@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Pares</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('docenteexamen.index')}}">Gestión de Pares </a> <span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a los docentes.</p>
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
                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getPersona()">Traer Persona</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::open(['route'=>'asignarpar.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <input type="hidden" name="docentea" id="docentea">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Seleccione Docente a Evaluar</label>
                            <select id='personanatural_id' class='form-control' onchange="mostrar()" required='required' name='personanatural_id'></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Identificación del Docente a Evaluar</label>
                            {!! Form::text('ident',null,['class'=>'form-control','placeholder'=>'Identificación de la persona','required','id'=>'ident']) !!}
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">Docente a Evaluar</label>
                            {!! Form::text('persona',null,['class'=>'form-control','placeholder'=>'Persona natural','id'=>'persona']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('docenteacademico_pege', 'Seleccione el Par', ['class' => 'control-label'])!!}
                            {!! Form::select('docenteacademico_pege',$docentes,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'tipo']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('asignarpar.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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
                url: url + "evaluacionacademica/asignarpar/" + id + "/get/docentes",
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

    function mostrar() {
        var id = $("#personanatural_id").val();
        var e = false;
        $.each(vect, function (index, item) {
            if (item.id == id) {
                $("#docentea").val(item.docacademico_id);
                $("#ident").val(item.identificacion);
                $("#persona").val(item.nombres + " " + item.apellidos);
                e = true;
            }
        });
        if (e === false) {
            $("#docentea").val("");
            $("#identificacion").val("");
            $("#ident").val("");
            $("#persona").val("");
        }
    }

</script>
@endsection
