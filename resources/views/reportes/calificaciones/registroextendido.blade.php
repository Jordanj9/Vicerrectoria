@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Calificaciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repcalificaciones')}}"> Calificaciones </a><span class="fa-angle-right fa"></span> Registro Extendio por Estudiante o por Pensum 
            </p>
        </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de Calificaciones.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Reporte de Registro Extendido</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class='form-horizontal form-label-left'>
                    <h3>Buscar por datos personales</h3>
                    <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::label('tipoconcepto_id', 'Buscar Por...', ['class' => 'control-label text-right'])!!}
                            {!! Form::select('clave',['IDENTIFICACION'=>'IDENTIFICACION','NOMBRES'=>'NOMBRES Y APELLIDOS'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'clave']) !!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Valor de Busqueda...</label>
                            <input type="text" class="form-control" id="valor" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Realizar Busqueda...</label>
                            <button type="button" onclick="buscar()" class="btn btn-primary btn-sm btn-block">Buscar</button>
                        </div>
                    </div>
                    <h3>Buscar por programa</h3>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Unidad', ['class' => 'control-label'])!!}
                            {!! Form::select('unidad_id',$unds,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'unidad_id','onchange'=>'getPeriodos()']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Período', ['class' => 'control-label'])!!}
                            {!! Form::select('periodo',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::label('tipo', 'Metodología de Estudio', ['class' => 'control-label'])!!}
                            {!! Form::select('metodologia_id',$met,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'metodologia_id']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('tipo', 'Nivel Educativo', ['class' => 'control-label'])!!}
                            {!! Form::select('nivel_id',$ne,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'nivel_id','onchange'=>'getModalidad()']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('tipo', 'Modalidad Educativa', ['class' => 'control-label'])!!}
                            {!! Form::select('modalidad',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'modalidad','onchange'=>'getProgramas()']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('tipo', 'Programa', ['class' => 'control-label'])!!}
                            {!! Form::select('programa',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa','onchange'=>'getEstudiantes()']) !!}
                        </div>
                    </div>
                    <h3>Listado de Estudiantes</h3>
                    <div class="responsive-table" id="rta">

                    </div>
                </form>
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

    function pdf(id) {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/calificaciones/" + id +"/registroextendido/pdf";
            a.click();
    }
    
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

    function getPeriodos() {
        $("#periodo").empty();
        var id = $("#unidad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/ppa/" + id + "/periodos",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                $("#periodo").append("<option value='0'>-- Seleccione una opción --</option>");
                $.each(m, function (index, item) {
                    $("#periodo").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Alerta', 'La unidad seleccionada no posee períodos asociados', 'error');
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
                        $("#programa").append("<option value='" + item.id + ";" + item.programaunidad_id + ";" + item2.id + "'>PROGRAMA: " + item.nombre + " - PENSUM: " + item2.descripcion + " - " + item2.estadopensum.descripcion + "</option>");
                    });
                });
            } else {
                notify('Error', 'No hay programas para los parámetros dados.', 'error');
            }
        });
    }

    function getEstudiantes() {
        $("#rta").html("");
        var id = $("#programa").val();
        var v = id.split(";");
        $.ajax({
            type: 'GET',
            url: url + "academico/agregarestudiante/" + v[1] + "/" + v[2] + "/" + $("#unidad_id").val() + "/estudiantes",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                var html = "<table id='tabla' class='table table-hover table-responsive table-bordered table-condensed' width='100%' cellspacing='0'>"
                        + "<thead><tr><th>Identificación</th><th>Nombres y Apellidos</th>"
                        + "<th>Situación Estudiante</th><th>Acciones</th></tr></thead><tbody>";
                $.each(m, function (index, item) {
                    html = html + "<tr>"
                            + "<td>" + item.estudiante.personanatural.persona.numero_documento + "</td>"
                            + "<td>" + item.est + "</td>"
                            + "<td>" + item.situacionestudiante.descripcion + "</td>"
                            + "<td>"
                            + "<a onclick='pdf(" + item.id + ")' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Consultar Notas Actuales'><i class='fa fa-file-pdf-o'></i></a>"
                            + "</td>"
                            + "</tr>";
                });
                html = html + "</tbody></html>";
                $("#rta").html(html);
                $('#tabla').DataTable();
            } else {
                $("#rta").html("");
                notify('Error', 'No hay estudiantes matriculados en el programa seleccionado.', 'error');
            }
        });
    }

    function buscar() {
        $("#rta").html("");
        var clave = $("#clave").val();
        var valor = $("#valor").val();
        if (clave == null || valor.length <= 0) {
            notify('Alerta', 'Debe indicar el campo de busqueda y el valor del campo para continuar', 'error');
            return;
        }
        $.ajax({
            type: 'GET',
            url: url + "tesoreria/liquidacionconceptosp/ESTUDIANTE/" + clave + "/" + valor + "/buscar",
            data: {},
        }).done(function (msg) {
            if (msg !== "null") {
                var m = JSON.parse(msg);
                var html = "<table id='tabla' class='table table-hover table-responsive table-bordered table-condensed' width='100%' cellspacing='0'>"
                        + "<thead><tr><th>Identificación</th><th>Nombres y Apellidos</th>"
                        + "<th>Situación Estudiante</th><th>Acciones</th></tr></thead><tbody>";
                $.each(m, function (index, item) {
                    html = html + "<tr>"
                            + "<td>" + item.ident + "</td>"
                            + "<td>" + item.persona + "</td>"
                            + "<td>" + item.situacion + "</td>"
                            + "<td>"
                            + "<a onclick='pdf(" + item.id + ")' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Imprimir PDF'><i class='fa fa-file-pdf-o'></i></a>"
                            + "</td>"
                            + "</tr>";
                });
                html = html + "</tbody></html>";
                $("#rta").html(html);
                $('#tabla').DataTable();
            } else {
                notify('Atención', 'Persona no encontrada o relación de parámetros inválidos.', 'error');
            }
        });
    }

</script>
@endsection
