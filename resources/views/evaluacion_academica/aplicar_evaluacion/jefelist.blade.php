@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicación Encargados de Programa</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('aplicacionjefe.inicio')}}"> Aplicación Encargados de Programa</a><span class="fa-angle-right fa"></span> Listado
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la aplicación de evaluación académica de los Encargados de Programa.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="responsive-table panel box-v1">
        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
            <tbody>
                <tr class="success">
                    <th>Periodo</th>
                </tr>
                <tr>
                    <th>{{$periodo->anio . " - " . $periodo->periodo . " --> " . $periodo->TipoPeriodo->descripcion}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <input type="hidden" name="periodo_id" value="{{$periodo->id}}" id="periodo_id"/>
                    <input type="hidden" name="fecha_id" value="{{$fecha->id}}" id="fecha_id"/>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label">Programas a cargo</label>
                            {!! Form::select('pensum_id',$programas,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'pensum_id','onchange'=>'getDocentes()']) !!}
                        </div>
                    </div>
                    <h3 style="padding-top: 50px;" id="titulo"></h3>
                    <div class="responsive-table" id="rta">

                    </div>
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

    function getDocentes() {
        $("#rta").html("");
        var pen = $("#pensum_id").val();
        var per = $("#periodo_id").val();
        $.ajax({
            type: 'GET',
            url: url + "evaluacionacademica/aplicacionjefe/inicio/" + pen + "/" + per + "/0/0/getdocentes",
            data: {},
        }).done(function (msg) {
            if (msg !== 'null') {
                var m = JSON.parse(msg);
                var html = "<table id='tabla' class='table table-hover table-responsive table-bordered table-condensed' width='100%' cellspacing='0'>"
                        + "<thead><tr><th>Codigo Materia</th><th>Materia</th>"
                        + "<th>Identificación</th><th>Docente</th><th>Acciones</th></tr></thead><tbody>";
                $.each(m.data, function (index, item) {
                    html = html + "<tr>"
                            + "<td>" + item.materiac + "</td>"
                            + "<td>" + item.materian + "</td>"
                            + "<td>" + item.identificacion + "</td>"
                            + "<td>" + item.docente + "</td>"
                            + "<td><a href='" + url + "evaluacionacademica/aplicacionjefe/" + item.docentepege + "/" + item.docente_pn + "/" + item.materiac + "/" + m.jefe + "/" + m.programa + "/" + per + "/continuar' class='btn btn-success btn-xs'>Continuar</a></td>"
                            + "</tr>";
                });
                html = html + "</tbody></html>";
                $("#rta").html(html);
                $('#tabla').DataTable();
                $("#titulo").html("DOCENTES A EVALUAR [DOCENTES EVALUADOS " + m.totala + " DE " + m.totalg + "]");
            } else {
                $("#rta").html("");
                notify('Error', 'No hay información para los parametros seleccionados.', 'error');
            }
        });
    }

</script>
@endsection
