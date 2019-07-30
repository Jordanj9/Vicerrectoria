@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Admisiones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('admisiones.index')}}"> Admisiones </a><span class="fa-angle-right fa"></span> Menú
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de admisión.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Admisión</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <tbody>
                                <tr class="success">
                                    <th>Tipo Unidad</th>
                                    <th>Unidad</th>
                                    <th>Ciudad</th>
                                </tr>
                                <tr>
                                    <th>{{$u->TipoUnidad->descripcion}}</th>
                                    <th>{{$u->nombre}}</th>
                                    <th>{{$u->ciudad->nombre}}</th>
                                </tr>
                                <tr class="success">
                                    <th>Año</th>
                                    <th>Período</th>
                                    <th>Tipo Período</th>
                                </tr>
                                <tr>
                                    <th>{{$per->anio}}</th>
                                    <th>{{$per->periodo}}</th>
                                    <th>{{$per->TipoPeriodo->descripcion}}</th>
                                </tr>
                                <tr class="success">
                                    <th>Metodología de Estudio</th>
                                    <th>Nivel Educativo</th>
                                    <th>Modalidad Académica</th>
                                </tr>
                                <tr>
                                    <th>{{$me->nombre}}</th>
                                    <th>{{$ne->descripcion}}</th>
                                    <th>{{$mo->descripcion}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>REPORTES GENERALES</h4>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.inscritosxprograma',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Inscritos Por Programa</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.transferenciaexterna',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Trasferencia Externa</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.transferenciainterna',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Trasferencia Interna</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.puntajeobtenidoxaspirante',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Puntaje Obtenido Aspirante</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.inscritosxfecha',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Inscritos por Fechas</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.formulariosinprograma',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Formularios sin Programas</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.admitidosxtipoadmision',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Admitidos Por Tipo de Admisión</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.cuposxcircunscripcion',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Cupos Por Circunscripción y Programa</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.listadoinscritonuevoicfes',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Listado General Inscritos Nuevo ICFES</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.cuposperiodos',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Resumen Distribución Cupos - Periodo</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 style="margin-top: 20px">REPORTES NUMÉRICOS</h4>
                    <div class="col-md-12"  style="margin-top: 15px;">
                        <a href="{{route('admisiones.inscritosxprogramanumericos',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Aspirantes, Anulados, Inscritos, Admitidos y Demás - Periodo y Programa</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
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
        var u = $("#unidad_id").val();
        var p = $("#periodoacademico_id").val();
        var met = $("#metodologia_id").val();
        var mod = $("#modalidad_id").val();
        var n = $("#nivel_Educativo_id").val();
        location.href = url + "reportes/admisiones/" + u + "/" + p + "/" + met + "/" + mod + "/" + n + "/menu";
    }

</script>
@endsection