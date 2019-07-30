@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes - Reportes Procesos SNIES y SPADIES</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.reportes')}}"> Módulo Reportes </a><span class="fa-angle-right fa"></span> Snies y Spadies
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Obtenga reportes de los procesos de SNIES y SPADIES.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Reportes SNIES y SPADIES</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('snies.apoyosfinancieros')}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Apoyos Financieros, Académicos y Otros</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-6"  style="margin-top: 15px;">
                        <a href="{{route('snies.materiasmatriculadas')}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Materias Matriculadas</span>
                                <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                        </a>
                    </div>
                    <div class="col-md-4"  style="margin-top: 15px;">
                        <a href="{{route('snies.matriculados')}}" class="btn ripple btn-gradient btn-danger">
                            <div>
                                <span>Matriculados</span>
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
</script>
@endsection