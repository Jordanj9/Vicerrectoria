@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Docentes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Docentes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Relaciona la información necesaria para la gestión de los datos de los docentes de la institución.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ DOCENTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('categoriaescalafon.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Categoría del Escalafón Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('dedicaciond.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Dedicación Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('clasificaciond.index')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Clasificación Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('docentes.create')}}" class="btn ripple btn-3d btn-success">
                        <div>
                            <span>Agregar Docente</span>
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
            <h4>GESTIONAR MÁS INFORMACIÓN DE DOCENTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                {!! Form::open(['route'=>'docentes.more','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                <div class="form-group">
                    <div class="col-md-6">
                        {!! Form::label('tipo_id', 'Seleccione Tipo de Unidad', ['class' => 'control-label'])!!}
                        {!! Form::select('tipo_id',$tipos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','onchange'=>'getUnidades()','id'=>'tipo_id']) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Seleccione Unidad</label>
                        <select class="form-control" id="unidad_id" name="unidad_id" required="required" onchange="getDocentes()">
                            <option>-- Seleccione Unidad --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9">
                        <select class="form-control chosen-select" id="docente_id" name="docente_id" required="required">
                            <option>-- Seleccione Docente --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        {!! Form::submit('Continuar',['class'=>'btn btn-3d btn-success btn-block btn-sm']) !!}
                    </div>
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
                $("#unidad_id").append("<option value='0'>-- Seleccione Unidad --</option>");
                $.each(m, function (index, item) {
                    $("#unidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El tipo de unidad que seleccionó no posee unidades asociadas.', 'error');
            }
        });
    }

    function getDocentes() {
        var id = $("#unidad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/unidad/" + id + "/docentes",
            data: {},
        }).done(function (msg) {
            $('#docente_id option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#docente_id").append("<option value='0'>-- Seleccione Docente --</option>");
                $.each(m, function (index, item) {
                    $("#docente_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'La unidad que seleccionó no posee docentes asociados.', 'error');
            }
        });
    }
</script>
@endsection