@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Valoraciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('valoracion.index')}}">Gestión de Valoraciones </a> <span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a las valoraciones cuantitativas y cualitativas.</p>
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
                <h4>Editar Datos de la Valoración {{$valoracion->valor_cualitativo}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['valoracion.update',$valoracion],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Acronimo</label>
                        <div class="col-sm-10">
                            {!! Form::text('acronimo',$valoracion->acronimo,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Acronimo','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Valor Cualitativo</label>
                        <div class="col-sm-10">
                            {!! Form::text('valor_cualitativo',$valoracion->valor_cualitativo,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Valor Cualitativo','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Calificación Inicial</label>
                        <div class="col-sm-10">
                            <input class="form-control col-md-7 col-xs-12" name="valor_cuat1" type="text" placeholder="Calificación inicial" required="required" value="{{$valoracion->valor_cuat1}}"/>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Calificación Final</label>
                        <div class="col-sm-10">
                            <input class="form-control col-md-7 col-xs-12" name="valor_cuat2" type="text" placeholder="Calificación final" required="required" value="{{$valoracion->valor_cuat2}}" />
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Descripción</label>
                        <div class="col-sm-10">
                            {!! Form::text('descripcion',$valoracion->descripcion,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Descripción']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('valoracion.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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

