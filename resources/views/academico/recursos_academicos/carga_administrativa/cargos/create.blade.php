@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Cargos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> <a href="{{route('cargo.index')}}"> Gestión de Cargos </a> <span class="fa-angle-right fa"></span> Crear Cargo
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue nuevos cargos. Contiene la información de los cargos administrativos que existen al interior de la institución.</p>
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
                <h4>Datos del Cargo</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'cargo.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Código</label>
                        <div class="col-sm-10">
                            {!! Form::text('codigo',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Código del cargo asignado por la universidad','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombre</label>
                        <div class="col-sm-10">
                            {!! Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Nombre del cargo','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Descripción</label>
                        <div class="col-sm-10">
                            {!! Form::text('descripcion',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Descripción del cargo','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Número de Empleados</label>
                        <div class="col-sm-10">
                            {!! Form::number('numero_empleados',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Cantidad de empleados que pueden ser contratados en éste cargo']) !!}
                        </div>
                    </div>
<!--                    <div class="form-group form-animate-checkbox col-md-12">
                        <input type="checkbox" class="checkbox" id="tiene_funcion" name="tiene_funcion">
                        <label> ¿Labor de Docencia?</label>
                    </div>-->
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('cargo.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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

    function getEscalas() {
        $("#escalasalario_id").empty();
        var id = $("#niveljerarquico_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/niveljerarqico/" + id + "/escalas",
            data: {},
        }).done(function (msg) {
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#escalasalario_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            }
        });
    }
</script>
@endsection