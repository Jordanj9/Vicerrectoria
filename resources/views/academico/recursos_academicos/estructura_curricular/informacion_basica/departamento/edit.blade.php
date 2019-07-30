@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Departamento</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.academico')}}">Módulo Académico</a> <i class="fa-angle-right fa"></i> <a href="{{route('departamentos.index')}}">Departamentos</a> <i class="fa-angle-right fa"></i> Editar Departamento
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Edite los Departamentos, recuerde que el campo nombre es requerido.</p>
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
                <h4>Editar Datos del Departamento{{$departamento->nombre}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['departamentos.update',$departamento],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombre</label>
                        <div class="col-sm-10">
                            {!! Form::text('nombre',$departamento->nombre,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Nombre del departamento','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción', ['class' => 'col-sm-2 control-label text-right'])!!}
                        <div class="col-md-10">
                            {!! Form::text('descripcion',$departamento->descripcion,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Descripción del departamento']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Facultad</label>
                        <div class="col-sm-10">
                            {!! Form::select('facultad_id',$facultades,$departamento->facultad_id,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('departamentos.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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

