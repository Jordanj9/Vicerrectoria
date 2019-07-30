@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Grados</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Registro Académico </a><span class="fa-angle-right fa"></span> Grados
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Bienvenidos al Módulo de Grados, el cual permite al usuario realizar la gestión referente a los grados de los estudiantes pertenecientes a los programas académicos ofrecidos por la institución. El proceso de Grados busca a través de su implementación y puesta en marcha ofrecer un producto satisfactorio, aplicando un proceso que conduce a un resultado de alta calidad que satisface las necesidades de quienes se beneficiarán con el uso del producto.
            El módulo le permite al usuario generar las actas de grado posteriormente generar las impresiones de las mismas para la entrega formal a los graduados que se presenten al acto de ceremonia. Una buena organización y parametrización de la información que conforma las estructuras curriculares de los programas, en las cuales se detallan los requisitos de grado (requisitos manuales como la entrega de documentos, requisitos de verificación automática, terminación de materias del pensum al cual se haya matriculado el estudiante, cumplimiento de exámenes preparatorios, presentación de un certificado de idiomas, promedio acumulado mínimo exigido por el programa), tipos de trabajos de grado, verificación de sanciones y deudas lo cual permite la consecución de resultados seguros, confiables y eficaces.
            Una vez se han verificado los requisitos, se asocia el acta de grado, con la fecha y lugar del evento al programa en cuestión. Del programa elegido, se registran los estudiantes con un número de folio, registro de acta general e individual, calificación del proyecto de grado, permitiendo llevar a cabo un seguimiento al proceso de una forma mas transparente para la institución. 
            Finalmente se logra el objetivo de entrega de actas, graduación de los estudiantes dentro del sistema, convirtiéndolos en egresados de la institución. Desde el punto de vista social, el estudiante se hace acreedor del aval institucional como profesional de la misma. Desde el punto de vista de almacenamiento de datos, se logra recopilar toda la información del evento y retroalimentar la información de egresados para la posterior optimización de las estadísticas, cumpliendo con uno de lo que hasta hoy ha sido un proceso lento para las instituciones y es la captación real de la información de sus egresados. 
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ GRADOS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('verificarreqgrados.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Verificar Requisitos de Grado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('gradogeneral.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Grados</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('valorporcentaje.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Porcentaje de Aprobación</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('agregarestudiante.listar')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Activar Estudiante</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('convocatoriagrado.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Convocatoria</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('tipoproyecto.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Tipo Proyecto</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('proyecto.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Gestionar Proyecto</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('investigador.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Investigador</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.jurados')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Jurado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('admin.asesores')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asesores</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('conceptotrabajogrado.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Valoración Conceptual Trabajo de Grado</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('sustentacion.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Sustentaciónes</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 15px;">
                    <a disabled='disabled' class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Promociones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
<!--                <div class="col-md-4" style="margin-top: 15px;">
                    <a href="{{route('promocion.index')}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Promociones</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>-->
            </div>
        </div>
    </div>
</div>
@endsection
