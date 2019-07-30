@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Formularios de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> <a href="{{route('evaluacionaah.index')}}">Formularios de Evaluación </a> <span class="fa-angle-right fa"></span> Editar Formulario
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes formularios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes y las hetero-evaluaciones a los jefes de programa y estudiantes.</p>
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
                <h4>Editar Datos del Formulario {{$e->nombre}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['evaluacionaah.update',$e],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-5">
                            <label class="control-label">Nombre del Formulario de Evaluación</label>
                            {!! Form::text('nombre',$e->nombre,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-7">
                            <label class="control-label">Descripción del Formulario (Opcional)</label>
                            {!! Form::text('descripcion',$e->descripcion,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Peso del Formulario (Porcentaje de 0 a 100)</label>
                            {!! Form::text('peso',$e->peso,['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('evaluacionaah.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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