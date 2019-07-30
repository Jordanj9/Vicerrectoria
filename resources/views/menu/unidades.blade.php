@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Unidades</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Unidades
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Las unidades representan las dependencias de la universidad, decanaturas, facultades, sedes de la institución, y todo lo que se considere una unidad del claustro universitario.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ UNIDADES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('tipounidad.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Tipos de Unidad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('funcionunidad.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Funciones de Unidad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('tiporelacionunidad.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Tipos de Relación Entre Unidades</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('unidad.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Unidades</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MÁS OPERACIONES CON LAS UNIDADES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12" style="margin-bottom: 30px;">
                <div class="form-group">
                    {!! Form::label('tipo_id', 'Seleccione Tipo de Unidad', ['class' => 'col-sm-2 control-label text-right'])!!}
                    <div class="col-sm-10">
                        {!! Form::select('tipo_id',$tipos,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','onchange'=>'getUnidades()','id'=>'tipo_id']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                {!! Form::open(['route'=>'unidad.more','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control col-md-7 col-xs-12 chosen-select" id="unidad_id" name="unidad_id" required="required">
                                <option>-- Seleccione Unidad --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    {!! Form::submit('Continuar',['class'=>'btn btn-3d btn-success btn-block btn-xs']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });

    function getUnidades() {
        var id = $("#tipo_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/tipounidad/" + id + "/unidades",
            data: {},
        }).done(function (msg) {
            $('#unidad_id option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#unidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El tipo de unidad que seleccionó no posee unidades asociadas.', 'error');
            }
        });
    }
</script>
@endsection