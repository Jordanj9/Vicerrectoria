@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Práctica Empresarial</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Práctica Empresarial
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al módulo de Práctica Empresarial el cual permitirá realizar la gestión de las prácticas de los estudiantes para que tengan proyección profesional y social, teniendo como característica y objetivo primordial la aplicación del conocimiento adquirido en la universidad al tiempo que colabora con la solución de problemas reales en las empresas de la región. La práctica empresarial se podrá desarrollar bajo la modalidad de convenio, vinculación contractual por parte de las empresas, es decir, pasantía remunerada o por solicitud individual mediante intención escrita o carta presentada por las empresas, instituciones públicas, fundaciones, ONG, comunidades o por solicitud hecha por el estudiante respaldada por la intención y necesidad de la empresa donde él está vinculado laboralmente.
            El desarrollo de la práctica garantiza una actividad digna al estudiante y va en concordancia a su formación profesional. No tendrá relación alguna con oficios y labores que no estén acordes con su formación profesional y para ello se dispone de un plan de supervisión por parte de los tutores y director de práctica quienes garantizan la calidad y coherencia en el desarrollo de la misma. 
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ PRÁCTICA EMPRESARIAL</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.practicaempresarialbasicos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos Básicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('jefepractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Jefe de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('ofertaareapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Oferta a un Área de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('inscripcionofertaareapractica.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Inscripción a Oferta de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a disabled class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Práctica Empresarial</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a disabled class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Seguimiento de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a disabled class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Sugerencia Oferta de Práctica</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
