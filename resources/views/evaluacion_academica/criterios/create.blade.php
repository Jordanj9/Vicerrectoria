@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Criterios de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> <a href="{{route('criterioe.index')}}">Criterios de Evaluación </a> <span class="fa-angle-right fa"></span> Crear Criterio
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes criterios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes y las hetero-evaluaciones a los jefes de programa y estudiantes. Los criterios pueden ser: DOCENCIA DIRECTA, MODELO PEDAGÓGICO, entre otros.</p>
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
                <h4>Datos del Criterio</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'criterioe.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Nombre del Criterio</label>
                            {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre del criterio','required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Descripción del Criterio</label>
                            {!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Descripción del criterio']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Peso en %</label>
                            {!! Form::number('peso',null,['class'=>'form-control','placeholder'=>'Peso del criterio','max'=>'100','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('criterioe.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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
</script>
@endsection