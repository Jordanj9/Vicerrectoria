@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> <a href="{{route('aplicacionestudiante.inicio')}}"> Aplicar Evaluación</a> <span class="fa-angle-right fa"></span> <a href="{{route('aplicacionestudiante.consultarmatriculaacademica',[$ep->id,$per->id])}}"> Lista Docentes</a> <span class="fa-angle-right fa"></span> Realizar Exámen
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
                                <th>Materia</th>
                                <th>Docente</th>
                                <th>Evaluación</th>
                            </tr>
                            <tr>
                                <td>{{$ep->programaunidad->programa->nombre}}</td>
                                <td>{{$mat->nombre}}</td>
                                <td>{{$pn->primer_nombre." ".$pn->segundo_nombre." ".$pn->primer_apellido." ".$pn->segundo_apellido}}</td>  
                                <td>{{$e->nombre}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 top-20">
                <div class="col-md-12">
                    <h4>Forma de Evaluar</h4>
                    <p><b>Escriba en el campo "Valor" al frente de cada indicador su respectiva calificación de acuerdo a la siguiente tabla.</b></p>
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <tbody>
                                <tr class="success">
                                    <th>Notación</th>
                                    <th>Descripción</th>
                                    <th>Valor Cualitativo</th>
                                    <th>Rango Cuantitativo</th>
                                </tr>
                                @foreach($eval as $ev)
                                <tr>
                                    <td>{{$ev->acronimo}}</td>
                                    <td>{{$ev->descripcion}}</td>
                                    <td>{{$ev->valor_cualitativo}}</td>  
                                    <td>{{$ev->valor_cuat1." - ".$ev->valor_cuat2}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! Form::open(['route'=>'aplicacionestudiante.guardarevaluacionestudiante','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                <input type="hidden" name="materia_codigomateria" value="{{$mat->codigomateria}}" />
                <input type="hidden" name="docente_pegea" value="{{$pn->id}}" />
                <input type="hidden" name="personanaturala" value="{{$pn->id}}" />
                <input type="hidden" name="programa_id" value="{{$ep->programaunidad->programa_id}}" />
                <input type="hidden" name="personanaturalq" value="{{$ep->estudiante->personanatural_id}}" />
                <input type="hidden" name="periodoacademico_id" value="{{$per->id}}" />
                <input type="hidden" name="evaluacionaah_id" value="{{$e->id}}" />
                <input type="hidden" name="unidad_id" value="{{$ep->unidad_id}}" />
                <input type="hidden" name="estudiantepensum_id" value="{{$ep->id}}" />
                <div class="responsive-table panel box-v1">
                    <h4>{{$e->nombre}}</h4>
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="info">
                                <th>Indicador</th>
                                <th>Criterio</th>
                                <th>Valor</th>
                            </tr>
                            @foreach($e->evaluacionindicadors as $i)
                            <tr>
                                <td>{{$i->indicador->indicador}}</td>
                                <td>{{$i->indicador->criterioevaluacion->nombre}}</td>
                                <td><input accept="text" required="required" class="form-control" name="indicador_{{$i->id}}" /></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::submit('Enviar Evaluación',['class'=>'btn btn-3d btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
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