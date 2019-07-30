@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Sanciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Sanciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al módulo que permite Gestionar Sanciones a los estudiantes bajo la aplicabilidad de las normas plasmadas en el Reglamento Estudiantil de la institución académica, la cual da autonomía a la implementación de procesos disciplinarios que contribuyan al fortalecimiento de la academia, alcance y cumplimiento de los objetivos institucionales.
            El proceso de gestión de sanciones en las Instituciones de Educación Superior se fundamenta en los principios de equidad por los cuales los alumnos tienen los mismos derechos sin importar condiciones sociales, ni otros factores que pudieren favorecer intereses individuales y/o grupales dentro de la institución, para controlar las faltas cometidas se cuenta con la herramienta de sanciones, la cual permite incurrir en la imposición de normas autónomas que contribuyen al buen funcionamiento de las instituciones, evitando de este modo la degradación que tiene la institución como es el formar profesionales en los diferentes cursos académicos ofrecidos. Aplicando de una manera óptima la gestión de sanciones, las organizaciones logran obtener un alto grado de reconocimiento y sobre todo un alto nivel de popularidad, que hace que los procesos de gestión académica y administrativa tiendan a mejorar para lograr de este modo la excelencia.
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ SANCIONES</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.sancionesbasicos')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Datos Básicos</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('sancion.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Sanción</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
