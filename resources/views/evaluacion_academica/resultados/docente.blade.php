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
        <p>La funcionalidad permite visualizar los resultados de la evaluación académica aplicada a los estudiantes, docentes y jefes de programa.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Resultados Evaluación Académica</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right">Período Académico</label>
                    <div class="col-sm-6">
                        {!! Form::select('periodoacademico_id',$periodos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodoacademico_id']) !!}
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-sm btn-success" onclick="ir()">Continuar</button>
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


    function ir() {
        var p = $("#periodoacademico_id").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            location.href = url + "evaluacionacademica/resultadosea/index/docentes/index/" + p + "/resultados";
        }
    }

</script>
@endsection