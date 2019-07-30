@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Formularios de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> <a href="{{route('evaluacionaah.index')}}">Formularios de Evaluación </a> <span class="fa-angle-right fa"></span> Indicadores del Exámen
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes formularios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes y las hetero-evaluaciones a los jefes de programa y estudiantes. Agregue tantos indicadores como lo considere necesario.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="responsive-table panel box-v1">
        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
            <tbody>
                <tr class="success">
                    <th>Nombre</th>             
                    <th>Descripción</th> 
                    <th>Peso</th>
                </tr>
                <tr>
                    <th>{{$e->nombre}}</th>
                    <th>{{$e->descripcion}}</th>
                    <th>{{$e->peso}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Indicadores del Formulario de Evaluación <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default"><span> Agregar Nuevo Indicador</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Indicador</th>
                                <th>Criterio</th>
                                <th>Retirar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($e->evaluacionindicadors as $ei)
                            <tr>
                                <td>{{$ei->indicador->indicador}}</td>
                                <td>{{$ei->indicador->criterioevaluacion->nombre}}</td>
                                <td>
                                    <a href="{{ route('evaluacionaah.indicadordelete',[$e->id,$ei->id])}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Indicador de la Evaluación"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Nuevo Indicador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="{{$e->id}}" id="id" name="id" />
                <div class="responsive-table">
                    <table id="tabla2" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Indicador</th>
                                <th>Criterio</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($i as $e)
                            <tr>
                                <td>{{$e->indicador}}</td>
                                <td>{{$e->criterioevaluacion->nombre}}</td>
                                <td>
                                    <a onclick="enviar(this.id)" id="{{$e->id}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Indicador a la Evaluación"><i class="fa fa-arrow-right"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
        $('#tabla2').DataTable();
    });

    function enviar(idi) {
        var id = $("#id").val();
        location.href = url + "evaluacionacademica/evaluacionaah/" + id + "/indicadores/" + idi + "/agregar/indicador";
    }
</script>
@endsection