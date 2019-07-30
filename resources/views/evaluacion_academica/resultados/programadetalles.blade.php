@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Resultados Evaluación Académica</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> <a href="{{route('resultadosea.inicio')}}"> Resultados Evaluación Académica</a> <span class="fa-angle-right fa"></span> Resultados Individuales Por Programa - Detalles
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
            <h4>Resultados Individuales Evaluación Académica (Un programa un docente)</h4>
        </div>
        <div class="panel-body">
            <div class="responsive-table">
                <table id="tbl1" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr class="success">
                            <th>Realizado Por</th>
                            <th>Evaluación</th>
                            <th>Materia</th>
                            <th>Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($resultados)>0)
                        @foreach($resultados as $i)
                        <tr>
                            <td>{{$i['quien']}}</td>
                            <td>{{$i['evaluacion']->nombre}}</td>
                            <td>@if($i['materia']!=null){{$i['materia']->nombre}} @else -- @endif</td>
                            <td>
                                <a data-toggle="modal" data-target="#formulario_{{$i['formulario']->id}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Items"><i class="fa fa-arrow-right"></i></a>
                            </td>
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
    </div>
</div>
@if(count($resultados)>0)
@foreach($resultados as $i)
<!-- Modal {{$i['formulario']->id}}-->
<div class="modal fade" id="formulario_{{$i['formulario']->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles Evaluación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tbody>
                        <tr class="read">
                            <td class="contact"><b>Realizado Por</b></td>
                            <td class="subject">{{$i['quien']}}</td>
                        </tr>
                        <tr class="read">
                            <td class="contact"><b>Materia</b></td>
                            <td class="subject">@if($i['materia']!=null){{$i['materia']->nombre}} @else -- @endif</td>
                        </tr>
                        <tr class="read">
                            <td class="contact"><b>Evaluación</b></td>
                            <td class="subject">{{$i['evaluacion']->nombre}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="responsive-table">
                    <table id="tbl1" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr class="success">
                                <th>Item</th>
                                <th>Valor</th>
                                <th>Equivalencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($i['items']!=null)
                            @foreach($i['items'] as $it)
                            <tr>
                                <td>{{$it['item']}}</td>
                                <td>{{$it['valor']}}</td>
                                <td>{{$it['equivalencia']}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="danger">
                                <td>No hay indicadores resueltos</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
    });


</script>
@endsection