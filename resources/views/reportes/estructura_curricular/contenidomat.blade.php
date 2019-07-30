@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Estructura Curricular</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repestructuracurricular')}}"> Estructura Curricular </a><span class="fa-angle-right fa"></span> Contenido de Materia
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes de la Estructura Curricular.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Materias</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class='form-horizontal'>
                        <h4>Buscar Materia</h4>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label class="control-label">Dato de Busqueda</label>
                                {!! Form::select('dato',['codigomateria'=>'CODIGO','nombre'=>'NOMBRE'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'dato']) !!}
                            </div>
                            <div class="col-md-5">
                                <label class="control-label">Valor de Busqueda</label>
                                <input type="text" class="form-control" id="valor" placeholder="Valor de Busqueda..." name="valor" required="required"/>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Consultar...</label>
                                <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getData()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <thead>
                                <tr class="success">
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Capacidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="rta"></tbody>
                        </table>
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
        $('#tba').DataTable();
    });

    function pdf(id) {
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url + "reportes/estructura/" + id + "/contenidomat/pdf";
        a.click();
    }

    function excel(id) {
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url + "reportes/estructura/" + id + "/contenidomat/excel";
        a.click();
    }

    function getData() {
        var dato = $("#dato").val();
        var valor = $("#valor").val();
        if (dato === null || valor.length === 0) {
            notify('Atención', 'Debe indicar los criterios de busqueda requeridos', 'error');
        } else {
            $.ajax({
                type: 'GET',
                url: url + "academico/materias/" + dato + "/" + valor + "/materias2",
                data: {},
            }).done(function (msg) {
                var m = JSON.parse(msg);
                var html = "";
                if (m.error === "NO" && m.data.length !== 0) {
                    $.each(m.data, function (index, item) {
                        html = html + "<tr><td>" + item.codigomateria + "</td><td>" + item.nombre + "</td><td>" + item.capacidad + "</td>";
                        html = html + "<td><a onclick='pdf(this.id)' id='" + item.codigomateria + "' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Imprimir PDF'><i class='fa fa-file-pdf-o'></i></a>";
                        html = html + " <a onclick='excel(this.id)' id='" + item.codigomateria + "' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Descargar EXCEL'><i class='fa fa-file-excel-o'></i></a></td></tr>";
                    });
                    $("#rta").html(html);
                } else {
                    notify('Atención', 'Su consulta no obtuvo resultados.', 'error');
                    $("#rta").html("");
                }
            });
        }
    }
</script>
@endsection