@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes de Liquidaciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> <a href="{{route('liquidaciones.index')}}"> Liquidaciones </a><span class="fa-angle-right fa"></span> Menú
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes del proceso de liqudación.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes de Liquidación</h3>
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
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('liquidaciones.matriculafinanciera',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Consolidado de Matricula Financiera</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('liquidaciones.liquidadoxunidad',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Total Liquidado por unidad</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('liquidaciones.descuentosporprograma',[$u->id,$per->id,$me->id,$mo->id,$ne->id])}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Descuentos por Programa</span>
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