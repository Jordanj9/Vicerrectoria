@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Páginas o Items del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span><a href="{{route('pagina.index')}}"> Páginas o Items </a><span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue nuevas páginas, el nombre de la página no debe llevar acentos, eñes (ñ) ni caracteres especiales, el nombre de la página debe iniciar con "PAG_" seguido del nombre que usted desee. Las paginas o ítems de los módulos del sistema son las funcionalidades más específicas o detalladas de los módulos. Ejemplo de página general: ESTUDIANTES, CIUDADES, NORMAS, UNIDADES, ETC.</p>
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
                <h4>Datos de la Página</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'pagina.store','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombre de la Página</label>
                        <div class="col-sm-10">
                            {!! Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el nombre de la página','required']) !!}
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Descripción (Opcional)</label>
                        <div class="col-sm-10">
                            {!! Form::text('descripcion',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Descripción de la página']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="{{route('pagina.index')}}" class="btn btn-3d btn-danger">Cancelar</a>
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
