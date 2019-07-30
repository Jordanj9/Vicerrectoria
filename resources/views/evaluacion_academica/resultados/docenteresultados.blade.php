@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Resultados Evaluación Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> <a href="{{route('resultadosea.resultadosdocenteindex')}}"> Resultados Evaluación Académica</a> <span class="fa-angle-right fa"></span> Resultados Individuales 
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite visualizar los resultados de la evaluación académica aplicada a los estudiantes, docentes y encargados de programa. Los resultados son para un docente en particular y para todos los programas donde posee carga académica.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Resultados Individuales Evaluación Académica (Todos los programas del docente)</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12" style="margin-top: 40px">
                <h3 style="color: green;">CALIFICACIÓN PONDERADA: {{$finalt}}</h3>
                <h3 style="color: green;">CALIFICACIÓN CUALITATIVA: {{$finalc}}</h3>
                @if(count($resultados)>0)
                @foreach($resultados as $key=>$value)
                <div class="col-md-12" style="margin-top: 40px">
                    <div class="panel bg-primary box-shadow-none">
                        <div class="panel-body">
                            <center><h4 class="text-white">DOCENTE CON ID: {{$key}}</h4></center>
                        </div>
                    </div>
                </div>
                @foreach($value as $r)
                <div class="col-md-12">
                    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
                        <h3>{{$r['ev_nombre']}}
                            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="read">
                                <td class="contact"><b>Descripción</b></td>
                                <td class="subject">{{$r['ev_descripcion']}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Calificación</b></td>
                                <td class="subject">{{$r['final']}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Valor Cualitativo</b></td>
                                <td class="subject">{{$r['cualitativo']}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Formularios Aplicados Ésta Evaluación</b></td>
                                <td class="subject">{{$r['tevaluados']}} (Cada formulario equivale a una evaluación realizada por una persona)</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Detalles Exámen</b></td>
                                <td class="subject"><a href="{{route('resultadosea.resultadosdocenteresultadosc',[$r['periodo'],$r['evaluacion_id'],$r['docente']])}}">Consultar los detalles evaluados</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="responsive-table">
                        <table id="tbl1" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <thead>
                                <tr class="success">
                                    <th>Item</th>
                                    <th>Cualitativo</th>
                                    <th>Cuantitativo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($r['items'])>0)
                                @foreach($r['items'] as $i)
                                <tr>
                                    <td>{{$i['item']}}</td>
                                    <td>{{$i['cualitativo']}}</td>
                                    <td>{{$i['resultado']}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="danger">
                                    <td>No hay Resultados para la evaluación!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                @endforeach
                @else
                <div class="col-md-12">
                    <div class="alert alert-danger alert-border alert-dismissible fade in" role="alert">
                        <h3>Error
                            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </h3>
                        <p>No hay Resultados para el docente!</p>
                    </div>
                </div>
                @endif
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