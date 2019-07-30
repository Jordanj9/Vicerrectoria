@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Tipos de Documentos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Datos Generales </a><span class="fa-angle-right fa"></span><a href="{{route('tipodoc.index')}}"> Tipos de Documento </a> <span class="fa-angle-right fa"></span> Editar
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Edite los datos de los tipos de documentos, Contiene la información de los Tipos de Documentos.</p>
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
                <h4>Editar Datos del Tipo de Documento {{$tipo->descripcion}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['tipodoc.update',$tipo],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Tipo de Documento</label>
                        <div class="col-sm-10">
                            {!! Form::text('descripcion',$tipo->descripcion,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Nombre o descripción del tipo de documento','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tipo_persona', 'Seleccione Tipo de Persona', ['class' => 'col-sm-2 control-label text-right'])!!}
                        <div class="col-sm-10">
                            {!! Form::select('tipo_persona',['J'=>'JURÍDICA','N'=>'NATURAL'],$tipo->tipo_persona,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Abreviatura</label>
                        <div class="col-sm-10">
                            {!! Form::text('abreviatura',$tipo->abreviatura,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Abreviatura del tipo de documento, ejemplo: para cedula CC']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tipo', 'Seleccione Juego de Caracteres Permitidos', ['class' => 'col-sm-2 control-label text-right'])!!}
                        <div class="col-sm-10">
                            {!! Form::select('tipo',['NUMERICO'=>'NUMERICO','ALFABETICO'=>'ALFABETICO','ALFANUMERICO'=>'ALFANUMERICO','TODOS'=>'TODOS'],$tipo->tipo,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('tipodoc.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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

