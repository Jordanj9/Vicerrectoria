@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicación Docente</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="{{route('aplicaciondocente.inicio')}}"> Aplicación Docente</a><span class="fa-angle-right fa"></span> Listado
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la aplicación de la autoevaluación académica de los docentes.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="responsive-table panel box-v1">
        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
            <tbody>
                <tr class="success">
                    <th>Identificación</th>             
                    <th>Nombre</th>
                    <th>Periodo</th>
                </tr>
                <tr>
                    <td>{{$identificacion}}</td>
                    <td>{{$nombre}}</td>
                    <th>{{$periodo->anio . " - " . $periodo->periodo . " --> " . $periodo->TipoPeriodo->descripcion}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-heading">
                <h4>Carga Académica Docente</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <input type="hidden" name="periodo_id" value="{{$periodo->id}}" id="periodo_id" />
                    <input type="hidden" name="fecha_id" value="{{$fecha->id}}" id="fecha_id" />
                    @if($d !== null)
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <thead>
                                <tr class="info">
                                    <th>Código</th>
                                    <th>Materia</th>
                                    <th>Naturaleza</th>
                                    <th>Pond.</th>
                                    <th>HT</th>
                                    <th>HP</th>
                                    <th>HTP</th>
                                    <th>Grupo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Unidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($d as $g)
                                <tr>
                                    <td>{{$g->materia_codigomateria}}</td>
                                    <td>{{$g->materia->nombre}}</td>
                                    <td>{{$g->materia->naturaleza->descripcion}}</td>
                                    <td>{{$g->materia->ponderacionacademica}}</td>
                                    <td>{{$g->materia->horasteoricas}}</td>
                                    <td>{{$g->materia->horaspracticas}}</td>
                                    <td>{{$g->materia->horasteoricopracticas}}</td>
                                    <td>GRUPO {{$g->nombre}}</td>
                                    <td>{{$g->fechainicial}}</td>
                                    <td>{{$g->fechafinal}}</td>
                                    <td>{{$g->unidad->nombre}}</td>
                                    <td><a href="{{route('aplicaciondocente.continuar',[$g->docacademico,$g->unidad_id,$periodo->id,$g->materia_codigomateria])}}" class="btn btn-success btn-xs">Continuar</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <p>Usted no tiene grupos asignados para el período indicado</p>
                    </div>
                    @endif    
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
        $('#tabla').DataTable();
    });
</script>
@endsection
