@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docentes</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Docentes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ DOCENTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="alert alert-success alert-raised alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Contiene la información de los Docentes.
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="margin-top: 30px;">
                    <a href="{{route('pnaturales.create')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Crear Nuevo Docente</span>
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
            <h4>MODIFICACIÓN Y CONSULTA DE DOCENTES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">Identificación del docente a Consultar</label>
                                {!! Form::text('id',null,['class'=>'form-control','placeholder'=>'Escriba la identificación a consultar','id'=>'id']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Traer Docente</label>
                                <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getPersona()">Traer Docente</button>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Seleccione Docente</label>
                                <select id='personanatural_id' class='form-control' onchange="mostrar()" required='required' name='personanatural_id'></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::text('identificacion',null,['class'=>'form-control','placeholder'=>'Escriba el número de identificación del usuario, con éste tendrá acceso al sistema','required','id'=>'identificacion','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::text('nombres',null,['class'=>'form-control','placeholder'=>'Escriba los nombres del usuario','required','id'=>'txt_nombres','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::text('apellidos',null,['class'=>'form-control','placeholder'=>'Escriba los apellidos del usuario','required','id'=>'txt_apellidos','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Escriba el correo electrónico del usuario','required','id'=>'txt_email','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6">
                                <button class='btn btn-sm btn-success btn-block' id="btn1">Consultar</button>
                            </div>
                            <div class="col-md-6">
                                <button class='btn btn-sm btn-success btn-block' id="btn2">Ir a Modificar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel">
        <div class="panel-heading">
            <h4>LISTADO DE DOCENTES</h4>
        </div>
        <div class="panel-body">
            <div class="responsive-table">
                <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Departamento</th>
                            <th>Facultad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docentes as $i)
                        <tr>
                            <td>{{$i->persona->tipodoc->abreviatura.":".$i->persona->numero_documento}}</td>
                            <td>{{$i->primer_nombre." ".$i->segundo_nombre." ".$i->primer_apellido." ".$i->segundo_apellido}}</td>
                            <td>{{$i->persona->celular}}</td>
                            <td>{{$i->persona->direccion}}</td>
                            @if($i->departamento_id == null)
                            <td>SIN DEPARTAMENTO</td>
                            <td>SIN FACULTAD</td>
                            @else
                            <td>{{$i->departamento->nombre}}</td>
                            <td>{{$i->departamento->facultad->nombre}}</td>
                            @endif
                            <td>
                                <a href="{{ route('pnaturales.delete',$i->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Docente"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    
    $("#btn1").click(function (e) {
        e.preventDefault();
        var id = $("#personanatural_id").val();
        window.location = url + "academico/pnaturales/" + id;
    });

    $("#btn2").click(function (e) {
        e.preventDefault();
        var id = $("#personanatural_id").val();
        window.location = url + "academico/pnaturales/" + id + "/edit";
    });


    var vect = null;

    function getPersona() {
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Alerta', 'Debe ingresar identificación para continuar...', 'warning');
        } else {
            $.ajax({
                type: 'GET',
                url: url + "academico/pnaturales/" + id + "/personaNaturals",
                data: {},
            }).done(function (msg) {
                var m = JSON.parse(msg);
                if (m.error === "NO") {
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                    vect = m.data1;
                    $("#personanatural_id").append("<option value='0'>-- Seleccione una opción --</option>");
                    $.each(m.data2, function (index, item) {
                        $("#personanatural_id").append("<option value='" + index + "'>" + item + "</option>");
                    });
                } else {
                    notify('Atención', m.msg, 'error');
                    $("#identificacion").val("");
                    $("#txt_nombres").val("");
                    $("#txt_apellidos").val("");
                    $("#txt_email").val("");
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                }
            });
        }
    }

    function mostrar() {
        var id = $("#personanatural_id").val();
        $.each(vect, function (index, item) {
            if (item.id == id) {
                $("#identificacion").val(item.identificacion);
                $("#txt_nombres").val(item.nombres);
                $("#txt_apellidos").val(item.apellidos);
                $("#txt_email").val(item.mail);
            }
        });
    }
</script>
@endsection