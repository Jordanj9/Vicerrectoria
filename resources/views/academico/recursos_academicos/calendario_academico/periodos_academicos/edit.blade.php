@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Períodos Académicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span><a href="{{route('periodoa.index')}}"> Períodos Académicos </a><span class="fa-angle-right fa"></span> Editar
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Edite los datos de los períodos. Contiene la información de los períodos académicos de la institución.</p>
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
                <h4>Editar Datos del Período</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['periodoa.update',$periodo],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Tipo de Período</label>
                            {!! Form::select('tipo_periodo_id',$tipos,$periodo->tipo_periodo_id,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fecha Inicio</label>
                            {!! Form::date('fechainicio',$periodo->fechainicio,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fecha Fin</label>
                            {!! Form::date('fechafin',$periodo->fechafin,['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label">Año</label>
                            {!! Form::text('anio',$periodo->anio,['class'=>'form-control','placeholder'=>'Año para el período','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Período</label>
                            {!! Form::text('periodo',$periodo->periodo,['class'=>'form-control','placeholder'=>'Período del año']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Fecha Inicio Clases</label>
                            {!! Form::date('fechainicioclases',$periodo->fechainicioclases,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Fecha Fin Clases</label>
                            {!! Form::date('fechafinclases',$periodo->fechafinclases,['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('periodoa.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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