@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Encargados de Programa</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('jefedepartamento.index')}}">Gestión de Encargados de Programa </a> <span class="fa-angle-right fa"></span> Editar
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a los Encargados de Programa.</p>
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
                <h4>Editar Datos del Encargado de Programa {{$jefe->personanatural->primer_nombre." ".$jefe->personanatural->primer_apellido}}</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>['jefedepartamento.update',$jefe],'method'=>'PUT','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Inicial</label>
                            <input class="form-control col-md-7 col-xs-12" value="{{$jefe->fechainicio}}" name="fechainicio" type="date" placeholder="Fecha de inicio" required="required" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Final</label>
                            <input class="form-control col-md-7 col-xs-12" value="{{$jefe->fechafin}}" name="fechainicio" type="date" placeholder="Fecha de inicio" required="required" />                      
                       </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('jefedepartamento.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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

