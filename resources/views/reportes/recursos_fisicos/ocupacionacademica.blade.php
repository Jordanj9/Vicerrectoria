@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Recursos Físicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admin.reprecursosfisicos')}}"> Recursos Físicos </a><span class="fa-angle-right fa"></span> Ocupación Académica de los Recursos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite obtener la ocupación de los recursos físicos para un período específico (funcionalidad construida para el módulo RESERVA RECURSO).</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Recursos Físicos - Ocupación Académica</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Período Académico</label>
                            {!! Form::select('periodo',$per,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="text-align: center;">
                        <h4>Genere Reporte En PDF</h4>
                        <a onclick="pdf()" class="btn btn-circle ripple-infinite btn-lg btn-danger"><div><span class="fa fa-file-pdf-o"></span></div></a>
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

    });

    $(".chosen-select").chosen({});


    function pdf() {
        var p = $("#periodo").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar el período para continuar', 'warning');
        } else {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/recursosfisicos/" + p + "/ocupacionacademica/pdf";
            a.click();
        }
    }

</script>
@endsection