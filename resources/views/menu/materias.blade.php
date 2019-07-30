@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Materias</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.academico')}}">Módulo Académico</a> <i class="fa-angle-right fa"></i> <a href="{{route('materias.index')}}"> Gestión de Materias</a> <i class="fa-angle-right fa"></i> Más Operaciones con Materias
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Menú para el tratamiento de diferentes las materias que se ofrecen en los programas, cursos y diplomados.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="responsive-table panel box-v1">
        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
            <tbody>
                <tr class="success">
                    <th>Unidad</th>
                    <th>{{$m->unidad->nombre}}</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Código Materia</th>
                    <th>Materia</th>
                    <th>Naturaleza</th>
                </tr>
                <tr>
                    <th>{{$m->codigomateria}}</th>
                    <th>{{$m->nombre}}</th>
                    <th>{{$m->naturaleza->descripcion}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h4>MENÚ MÁS OPERACIONES CON LA MATERIA</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-4" style="margin-top: 30px;">
                        <a href="{{route('contenidoprogramamateria.inicio',$m->codigomateria)}}" class="btn ripple btn-3d btn-primary">
                            <div>
                                <span>Contenidos de Ítems de Materia</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>   
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">
                        <a href="{{route('contenidoprogramamateria.historico',$m->codigomateria)}}" class="btn ripple btn-3d btn-primary">
                            <div>
                                <span>Histórico Contenidos de Ítems de Materia</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>   
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">
                        <a href="{{route('requisitomateriageneral.inicio',$m->codigomateria)}}" class="btn ripple btn-3d btn-primary">
                            <div>
                                <span>Requisitos de Materia General</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>   
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h4>REQUISITOS DE MATERIA POR PENSUM</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class='form-horizontal form-label-left'>
                        <input type="hidden" value="{{$m->codigomateria}}" id="codigomateria" name="codigomateria" />
                        <div class="form-group">
                            <div class="col-md-6">
                                {!! Form::label('tipo', 'Programa Académico', ['class' => 'control-label'])!!}
                                {!! Form::select('programa',$programas,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','onchange'=>'getPensums()']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('tipo', 'Pensum Académico', ['class' => 'control-label'])!!}
                                <select class='form-control chosen-select' placeholder='-- Seleccione una opción --' required='required' id='pensum' name="pensum"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-3d btn-primary" type="reset">Limpiar Formulario</button>
                                <button type='button' class='btn btn-3d btn-success' id="btn_enviar">Requisito de Materia x Pensum</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
    });

    $("#btn_enviar").click(function (e) {
        e.preventDefault();
        var idp = $("#pensum").val();
        var idm = $("#codigomateria").val();
        location.href = url + "academico/requisitomateriaxpensum/" + idm + "/" + idp + "/inicio";
    });

    function getPensums() {
        var id = $("#programa").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/programas/" + id + "/pensums",
            data: {},
        }).done(function (msg) {
            $('#pensum option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $("#pensum").append("<option value='NULL'>-- Seleccione opción --</option>");
                $.each(m, function (index, item) {
                    $("#pensum").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El programa seleccionado no posee información de pensum.', 'error');
            }
        });
    }

</script>
@endsection