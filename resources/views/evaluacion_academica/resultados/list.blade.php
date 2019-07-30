@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Resultados Evaluación Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> Resultados Evaluación Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite visualizar los resultados de la evaluación académica aplicada a los estudiantes, docentes y encargados de programa.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Resultados Evaluación Académica</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-6" style="margin-top: 40px">
                <div class="col-md-12">
                    <div class="panel bg-primary box-shadow-none">
                        <div class="panel-body">
                            <center><h4 class="text-white">RESULTADOS POR DOCENTE (TODOS LOS PROGRAMAS DEL DOCENTE)</h4></center>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('tipo', 'Período Académico', ['class' => 'control-label'])!!}
                            {!! Form::select('periodo',$periodos,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo','onchange'=>'getDocentes()']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 50px">
                    <div class="responsive-table panel box-v1">
                        <table id="tbl1" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <thead>
                                <tr class="success">
                                    <th>Identificación</th>
                                    <th>Docente</th>
                                    <th>Ir</th>
                                </tr>
                            </thead>
                            <tbody id="tb1"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 40px">
                <div class="col-md-12">
                    <div class="panel bg-primary box-shadow-none">
                        <div class="panel-body">
                            <center><h4 class="text-white">RESULTADOS POR PROGRAMA (TODOS LOS DOCENTES DE UN PROGRAMA)</h4></center>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">                    
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Metodología de Estudio', ['class' => 'control-label'])!!}
                            {!! Form::select('metodologia_id',$met,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'metodologia_id']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Nivel Educativo', ['class' => 'control-label'])!!}
                            {!! Form::select('nivel_id',$ne,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'nivel_id','onchange'=>'getModalidad()']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Modalidad Educativa', ['class' => 'control-label'])!!}
                            {!! Form::select('modalidad',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'modalidad']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Período Académico', ['class' => 'control-label'])!!}
                            {!! Form::select('periodo2',$periodos,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo2']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Tipo de Unidad', ['class' => 'control-label'])!!}
                            {!! Form::select('tipo',$tu,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'tipo','onchange'=>'getUnidad()']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Unidad', ['class' => 'control-label'])!!}
                            {!! Form::select('unidad_id',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'unidad_id','onchange'=>'getProgramas()']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('tipo', 'Programa', ['class' => 'control-label'])!!}
                            {!! Form::select('programa',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','onchange'=>'getDocentes2()']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 50px" id="rtaaa">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
    });


    function getUnidad() {
        $("#unidad_id").empty();
        var id = $("#tipo").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/tipounidad/" + id + "/unidades",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#unidad_id").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#unidad_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Error', 'El tipo de unidad no posee unidades asociadas', 'error');
            }
        });
    }

    function getModalidad() {
        $("#modalidad").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/niveleducativo/" + id + "/modalidades",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#modalidad").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#modalidad").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Error', 'El nivel educativo no posee modalidades asociadas', 'error');
            }
        });
    }

    function getProgramas() {
        $("#programa").empty();
        var id = $("#nivel_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/programas/" + $("#metodologia_id").val() + "/" + $("#modalidad").val() + "/" + $("#unidad_id").val() + "/programas2",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#programa").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $.each(item.pensums, function (index2, item2) {
                        $("#programa").append("<option value='" + item.id + "'>PROGRAMA: " + item.nombre + " - PENSUM: " + item2.descripcion + " - " + item2.estadopensum.descripcion + "</option>");
                    });
                });
            } else {
                notify('Error', 'No hay programas para los parámetros dados.', 'error');
            }
        });
    }

    function getDocentes() {
        $("#tb1").html("");
        var id = $("#periodo").val();
        $.ajax({
            type: 'GET',
            url: url + "evaluacionacademica/resultadosea/index/" + id + "/docentes",
            data: {},
        }).done(function (msg) {
            var m = JSON.parse(msg);
            if (m.error == 'NO') {
                var html = "";
                $.each(m.data, function (index, item) {
                    html = html + "<tr><td>" + item.docente_idt + "</td><td>" + item.docente + "</td>"
                            + "<td><a href='" + url + "evaluacionacademica/resultadosea/index/" + item.id + "/" + id + "/mostrarresultados/individual' class='btn btn-xs btn-primary'><i class='fa fa-arrow-right'></i></a></td></tr>";
                });
                $("#tb1").html(html);
                $('#tbl1').DataTable();
            } else {
                notify('Error', m.mensaje, 'error');
            }
        });
    }

    function getDocentes2() {
        $("#rtaaa").html("");
        var id = $("#periodo2").val();
        var pro = $("#programa").val();
        $.ajax({
            type: 'GET',
            url: url + "evaluacionacademica/resultadosea/index/" + pro + "/" + id + "/docentes",
            data: {},
        }).done(function (msg) {
            var m = JSON.parse(msg);
            if (m.error == 'NO') {
                var html = "<div class='responsive-table panel box-v1'>"
                        + "<table id='tbl2' class='table table-hover table-responsive table-bordered table-condensed' width='100%' cellspacing='0'>"
                        + "<thead><tr class='success'><th>Identificación</th><th>Docente</th><th>Ir</th></tr></thead><tbody id='tb2'>";
                $.each(m.data, function (index, item) {
                    html = html + "<tr><td>" + item.docente_idt + "</td><td>" + item.docente + "</td>"
                            + "<td><a href='" + url + "evaluacionacademica/resultadosea/index/" + item.id + "/" + id + "/" + pro + "/" + $("#unidad_id").val() + "/mostrarresultados/programa' class='btn btn-xs btn-primary'><i class='fa fa-arrow-right'></i></a></td></tr>";
                });
                html = html + "</tbody></table></div>";
                $("#rtaaa").html(html);
                $('#tbl2').DataTable();
            } else {
                notify('Error', m.mensaje, 'error');
            }
        });
    }


</script>
@endsection