@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Matrícula - Menú Módulo Matrícula Docente</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Menú Módulo Matrícula Docente
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÓDULO MATRÍCULA DOCENTE</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('norma_id', 'Período Académico (Necesario para: Carga Académica del Docente, Horario Docente)', ['class' => 'control-label'])!!}
                        {!! Form::select('periodo',$per,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if(session()->exists('PAG_DOC-HORARIO-DOCENTE'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a onclick="ir2()" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span><i class="fa fa-file-pdf-o"></i>  Horario Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_DOC-VER-MATERIAS-DOCENTE'))
                <div class="col-md-6"  style="margin-top: 15px;">
                    <a onclick="ir()" class="btn ripple btn-gradient btn-primary">
                        <div>
                            <span>Carga Académica del Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
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
        var per = $("#periodo").val();
        if (per !== null) {
            location.href = url + "docente/cargacademica/" + per + "/docente";
        } else {
            notify('Atención', 'Debe indicar el período para continuar', 'error');
        }
    }

    function ir2() {
        var per = $("#periodo").val();
        if (per !== null) {
            var a = document.createElement("a");
            a.target = "_blank";
            a.href = url + "docente/horario/" + per + "/docente";
            a.click();
        } else {
            notify('Atención', 'Debe indicar el período para continuar', 'error');
        }
    }

</script>
@endsection