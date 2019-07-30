@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Estructura Curricular</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span><a href="{{route('admin.repestructuracurricular')}}"> Estructura Curricular </a><span class="fa-angle-right fa"></span> Hoja de Vida de Programa
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de matrícula académica.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Hoja de Vida de Programa</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class='form-horizontal form-label-left'>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('programa', 'Programa', ['class' => 'control-label'])!!}
                                {!! Form::select('programa_id',$programa,null,['class'=>'form-control chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'programa_id']) !!}
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
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });
    $(".chosen-select").chosen({});
    function pdf() {
        var id = $("#programa_id").val();
        if (id == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            var v = id.split(";");
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "reportes/estructura/" + v[0] + "/hojavidapro/pdf";
            a.click();
        }
    }

</script>
@endsection