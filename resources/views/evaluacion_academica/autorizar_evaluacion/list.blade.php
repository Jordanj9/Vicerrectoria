@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Autorizar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Autorizar Evaluación
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite autorizar la evaluación académica para jefes, docentes y pares; sin ésta autorización no será efectiva la evaluación. </p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Autorizaciones de Evaluación <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default"><span> Agregar Nueva Autorización</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Evaluación</th>
                                <th>Rol Al Que Aplica</th>
                                <th>Período</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($autorizaciones as $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td>@if($a->evaluacionaah!=null){{$a->evaluacionaah->nombre." - PESO: ".$a->evaluacionaah->peso." %"}} @else -- @endif</td>
                                <td>{{$a->rol}}</td>
                                <td>{{$a->periodoacademico->anio." - ".$a->periodoacademico->periodo}}</td>                             
                                <td>{{$a->created_at}}</td>
                                <td>{{$a->updated_at}}</td>
                                <td>
                                    <a href="{{ route('autorizarevaluacion.delete',$a->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Autorización"><i class="fa fa-trash-o"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Nueva Autorización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label">¿A Quién Aplica?</label>
                        {!! Form::select('rol',['JEFE'=>'JEFE','DOCENTE'=>'DOCENTE','PARES'=>'PARES'],null,['class'=>'form-control chosen-select','required','id'=>'rol']) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Período Académico</label>
                        {!! Form::select('periodo',$periodos,null,['class'=>'form-control chosen-select','required','id'=>'periodo']) !!}
                    </div>
                </div>
                <div class="responsive-table"  style="margin-top: 100px !important;">
                    <table id="tabla2" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Evaluación</th>
                                <th>Peso</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluaciones as $e)
                            <tr>
                                <td>{{$e->nombre." - ".$e->descripcion}}</td>
                                <td>{{$e->peso." %"}}</td>
                                <td>
                                    <a onclick="enviar(this.id)" id="{{$e->id}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Autorización de Evaluación"><i class="fa fa-arrow-right"></i></a>
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

    function enviar(e) {
        var p = $("#periodo").val();
        var r = $("#rol").val();
        location.href = url + "evaluacionacademica/autorizarevaluacion/" + e + "/" + p + "/" + r + "/agregar";
    }
</script>
@endsection