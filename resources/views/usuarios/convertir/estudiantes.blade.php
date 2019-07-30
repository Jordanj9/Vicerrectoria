@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Convertir Estudiantes a Usuarios (Automático)</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio </a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Convertir Estudiantes a Usuarios (Automático)
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario convertir en usuarios del sistema de forma automática a todos los estudiantes nuevos o estudiantes que no tengan usuario asignado todavía. El usuario para acceder al sistema será el número de identificación y la contraseña será 0000 que deberá cambiar el usuario una vez ingrese al sistema.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Convertir Estudiantes a Usuarios (Automático)</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'usuario.convertir','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="alert alert-warning alert-border alert-dismissible fade in" role="alert">
                        <h3>Nota
                            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </h3>
                        <p><strong>Tenga en cuenta: </strong> Este proceso puede tardar varios minutos, la pagina parecerá no estar haciendo nada. Tenga paciencia y no cierre la página, no retroceda, no actualice la pagina ni realice otra operación mientras el proceso es llevado a cabo. Una vez de clic en el boton, el proceso dara inicio y generará usuarios a todos los estudiantes que aún no tengan uno.</p>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Seleccione grupo o rol de usuario para los estudiantes (Use el rol designado por la institución para los estudiantes)</label>
                            {!! Form::select('grupo',$grupos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Tipo de Unidad', ['class' => 'control-label'])!!}
                            {!! Form::select('tipo',$tu,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'tipo','onchange'=>'getUnidad()']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('tipo', 'Unidad', ['class' => 'control-label'])!!}
                            {!! Form::select('unidad_id',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'unidad_id']) !!}
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
                            {!! Form::select('programa',[],null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit('Procesar',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
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
                        $("#programa").append("<option value='" + item.id + ";" + item.programaunidad_id + ";" + item2.id + "'>PROGRAMA: " + item.nombre + " - PENSUM: " + item2.descripcion + " - " + item2.estadopensum.descripcion + "</option>");
                    });
                });
            } else {
                notify('Error', 'No hay programas para los parámetros dados.', 'error');
            }
        });
    }

</script>
@endsection