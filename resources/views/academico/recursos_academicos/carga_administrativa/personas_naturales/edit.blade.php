@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docentes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span><a href="{{route('pnaturales.index')}}"> Docentes </a><span class="fa-angle-right fa"></span> Editar
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Edite los datos de los Docentes. Contiene la información de los docentes.
            </br><strong>Nota:</strong> Si no desea modificar el departamento actual no seleccione ninguna facultad.
        </p>
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
                <h4>Editar Datos del Docente {{$p->primer_nombre." ".$p->primer_apellido}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['pnaturales.update',$p],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <legend>Datos Personales</legend>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label">Primer Nombre</label>
                            {!! Form::text('primer_nombre',$p->primer_nombre,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Segundo Nombre</label>
                            {!! Form::text('segundo_nombre',$p->segundo_nombre,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Primer Apellido</label>
                            {!! Form::text('primer_apellido',$p->primer_apellido,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Segundo Apellido</label>
                            {!! Form::text('segundo_apellido',$p->segundo_apellido,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::label('tipo', 'Tipo de Documento', ['class' => 'control-label'])!!}
                            @if($p->persona!==null)
                            {!! Form::select('tipodoc_id',$tipodocs,$p->persona->tipodoc_id,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                            @else
                            {!! Form::select('tipodoc_id',$tipodocs,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Identificación</label>
                            @if($p->persona!==null)
                            {!! Form::text('numero_documento',$p->persona->numero_documento,['class'=>'form-control','placeholder'=>'Número del documento de identificación','required']) !!}
                            @else
                            {!! Form::text('numero_documento',null,['class'=>'form-control','placeholder'=>'Número del documento de identificación','required']) !!}
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Lugar de Expedición</label>
                            @if($p->persona!==null)
                            {!! Form::text('lugar_expedicion',$p->persona->lugar_expedicion,['class'=>'form-control']) !!}
                            @else
                            {!! Form::text('lugar_expedicion',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Fecha de Expedición</label>
                            @if($p->persona!==null)
                            {!! Form::date('fecha_expedicion',$p->persona->fecha_expedicion,['class'=>'form-control']) !!}
                            @else
                            {!! Form::date('fecha_expedicion',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            {!! Form::label('tipo', 'Libreta Militar', ['class' => 'control-label'])!!}
                            {!! Form::text('libreta_militar',$p->libreta_militar,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Distrito Militar</label>
                            {!! Form::text('distrito_militar',$p->distrito_militar,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('tipo', 'Tipo Sanguíneo', ['class' => 'control-label'])!!}
                            {!! Form::select('rh',['A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'],$p->rh,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::label('tipo', 'Sexo', ['class' => 'control-label'])!!}
                            {!! Form::select('sexo',['F'=>'F','M'=>'M'],$p->sexo,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('tipo', 'Fecha de Nacimiento', ['class' => 'control-label'])!!}
                            {!! Form::date('fecha_nacimiento',$p->fecha_nacimiento,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <legend>Datos de Ubicación</legend>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Dirección</label>
                            @if($p->persona!==null)
                            {!! Form::text('direccion',$p->persona->direccion,['class'=>'form-control']) !!}
                            @else
                            {!! Form::text('direccion',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Teléfono</label>
                            @if($p->persona!==null)
                            {!! Form::text('telefono1',$p->persona->telefono,['class'=>'form-control']) !!}
                            @else
                            {!! Form::text('telefono1',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Teléfono Celular</label>
                            @if($p->persona!==null)
                            {!! Form::text('telefono2',$p->persona->celular,['class'=>'form-control']) !!}
                            @else
                            {!! Form::text('telefono2',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Correo Personal</label>
                            @if($p->persona!==null)
                            {!! Form::text('email',$p->persona->mail,['class'=>'form-control']) !!}
                            @else
                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Correo Institucional : {{$p->email_institucional}}</label>
                            {!! Form::text('email_institucional',$p->email_institucional,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <legend>Datos de Labor</legend>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Facultad', ['class' => 'control-label'])!!}
                            {!! Form::select('facultad_id',$facultades,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'facultad_id','onchange'=>'getDepartamentos()']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Departamento Actual: {{$p->departamento->nombre}}</label>
                            {!! Form::select('departamento_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'departamento_id','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('pnaturales.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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
<script>
    $(".chosen-select").chosen({});

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

    function getEstados(name, dpto, ciudad) {
        var id = $("#" + name).val();
        $.ajax({
            type: 'GET',
            url: url + "academico/pais/" + id + "/estados",
            data: {},
        }).done(function (msg) {
            $('#' + dpto + ' option').each(function () {
                $(this).remove();
            });
            $('#' + ciudad + ' option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#" + dpto).append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El País seleccionado no posee información de estados.', 'error');
            }
        });
    }

    function getCiudades(name, ciudad) {
        var id = $("#" + name).val();
        $.ajax({
            type: 'GET',
            url: url + "academico/estado/" + id + "/ciudades",
            data: {},
        }).done(function (msg) {
            $('#' + ciudad + ' option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#" + ciudad).append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El Estado seleccionado no posee información de ciudades.', 'error');
            }
        });
    }
</script>
@endsection