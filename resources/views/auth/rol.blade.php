@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">{{ config('app.name', 'Laravel') }} | Seleccione un rol para ingresar al sistema</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('rol') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-group col-md-12">
                                {!! Form::label('grupos', 'Seleccione rol para Ingresar', ['class' => 'col-sm-4 control-label text-right'])!!}
                                <div class="col-sm-8">
                                    {!! Form::select('grupo',$grupos,null,['class'=>'form-control col-md-12','placeholder'=>'-- Seleccione una opción --','required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-sign-in"></i> Iniciar Sesión
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection