@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Indicadores de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> <a href="{{route('indicador.index')}}">Indicadores de Evaluación </a> <span class="fa-angle-right fa"></span> Editar Indicador
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes indicadores de los criterios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes y las hetero-evaluaciones a los jefes de programa y estudiantes. Los indicadores son los items que conforman un formulario de exámen. </p>
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
                <h4>Editar Datos del Indicador {{$i->indicador}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['indicador.update',$i],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-5">
                            <label class="control-label">Indicador</label>
                            {!! Form::text('indicador',$i->indicador,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-7">
                            <label class="control-label">Criterio</label>
                            {!! Form::select('criterioevaluacion_id',$criterios,$i->criterioevaluacion_id,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('indicador.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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