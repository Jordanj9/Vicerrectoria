@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Cambio de Contraseña</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Cambio de Contraseña
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario realizar el cambio de su contraseña.</p>
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
                <h4>Cambio de Contraseña</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'usuario.cambiarcontrasenia','method'=>'POST','class'=>'form-horizontal'])!!}
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Escriba Su Contraseña Actual</label>
                            {!! Form::password('pass0',['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Escriba La Nueva Contraseña</label>
                            {!! Form::password('pass1',['class'=>'form-control','placeholder'=>'Mínimo 6 caracteres','required']) !!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Vuelva a Escribir La Nueva Contraseña</label>
                            {!! Form::password('pass2',['class'=>'form-control','placeholder'=>'Mínimo 6 caracteres','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit('Realizar Cambio',['class'=>'btn btn-raised btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
