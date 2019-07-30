@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Pares</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Gestión de Pares
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a los docentes.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Docentes <a href="{{ route('asignarpar.create') }}" class="btn btn-default"><span> Asignar Par</span></a></h3>
            </div>
            <div class="panel-body">                                                            
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Docente a Evaluar</th>
                                <th>Docente Par</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentes as $i)
                            <tr>
                                <td>{{$i['documento']." - ".$i['name']}}</td>
                                <td>{{$i['identificacion']." - ".$i['nombre']}}</td>
                                <td>{{$i['docente']->created_at}}</td>
                                <td>{{$i['docente']->updated_at}}</td>
                                <td>
                                    <a href="{{ route('asignarpar.delete',$i['docente']->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></a>
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
    });
</script>
@endsection