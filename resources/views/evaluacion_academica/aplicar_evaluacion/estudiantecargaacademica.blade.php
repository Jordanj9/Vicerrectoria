@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> <a href="{{route('aplicacionestudiante.inicio')}}"> Aplicar Evaluación</a> <span class="fa-angle-right fa"></span> Lista Docentes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite realizar la evaluación académica aplicada a los estudiantes.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Realizar Evaluación Académica</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="responsive-table panel box-v1">
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="success">
                                <th>Código</th>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Período</th>
                            </tr>
                            <tr>
                                <td>{{$ep->codigomatricula}}</td>
                                <td>{{$ep->estudiante->personanatural->persona->numero_documento}}</td>
                                <td>{{$text}}</td>  
                                <td>{{$per->anio." - ".$per->periodo}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="success">
                                <th>Programa</th>
                                <th>Créditos Matriculados</th>
                                <th>Ubicación Semestral</th>
                                <th>Período Académico</th>
                            </tr>
                            <tr>
                                <td>{{$ep->programaunidad->programa->nombre}}</td>
                                <td>{{$creditos}}</td>
                                <td>{{$ep->periodoacademico}}</td>  
                                <td>{{$per->periodo}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 top-20">
                <div class="responsive-table panel box-v1">
                    @if(count($gr)>0)
                    <h3>Asignaturas Matriculadas [Docentes Evaluados {{$totala}} de {{$totalg}}]</h3>
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="info">
                                <th>Nro.</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Identificación</th>
                                <th>Docente</th>
                                <th>Realizar Evaluación</th>
                            </tr>
                            <?php $total = 0; ?>
                            @foreach($gr as $g)
                            <?php $total = $total + 1; ?>
                            <tr>
                                <td>{{$total}}</td>
                                <td>{{$g['materiac']}}</td>
                                <td>{{$g['materian']}}</td>
                                <td>{{$g['id']}}</td>
                                <td>{{$g['docente']}}</td>
                                <td>
                                    <a href="{{route('aplicacionestudiante.vistaaplicarestudiante',[$ep->id,$per->id,$g['docente_pn'],$g['docente_pege'],$g['materiac']])}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Realizar Evaluación"><i class="fa fa-arrow-right"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <p><strong>Información:</strong> Usted no tiene matrícula ACTIVA para los parámetros dados.</p>
                    </div>
                    @endif
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