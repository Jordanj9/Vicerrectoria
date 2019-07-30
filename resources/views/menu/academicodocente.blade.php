@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Módulo Académico Docente</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> Menú Módulo Académico Docente
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÓDULO ACADÉMICO DOCENTE</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('norma_id', 'Período Académico (Necesario para: Listado de Estudiantes por Grupo, Calificaciones)', ['class' => 'control-label'])!!}
                        {!! Form::select('periodo',$per,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodo']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if(session()->exists('PAG_DOC-DATOS-PERSONALES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a href="{{route('datospersonales.index',0)}}" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Datos Personales</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_DOC-LISTADO-ESTUDIANTES-GRUPO'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a onclick="ir()" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Listado de Estudiantes por Grupo</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
                @if(session()->exists('PAG_DOC-CALIFICACIONES'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a onclick="irCal()" class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Calificaciones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif
<!--                @if(session()->exists('PAG_DOC-CALIFICACIONES-HISTORICAS'))
                <div class="col-md-4"  style="margin-top: 15px;">
                    <a disabled='disabled' class="btn ripple btn-gradient btn-success">
                        <div>
                            <span>Calificaciones Históricas por Docente</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>
                </div>
                @endif-->
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
            location.href = url + "docente/listadoestudiantes/" + per + "/porgrupo";
        } else {
            notify('Atención', 'Debe indicar el período para continuar', 'error');
        }
    }

    function irCal() {
        var per = $("#periodo").val();
        if (per !== null) {
            location.href = url + "docente/calificaciones/" + per + "/grupos";
        } else {
            notify('Atención', 'Debe indicar el período para continuar', 'error');
        }
    }

</script>
@endsection