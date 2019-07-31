@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Asignar Jefe</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Asignar Jefe
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario asignar un jefe a un docente.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Jefes <a href="{{ route('jefedepartamento.create') }}" class="btn btn-default"><span> Asignar Nuevo Jefe</span></a></h3>
            </div>
            <div class="panel-body">                                                            
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Jefe</th>
                                <th>Docente</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($jefes != null)
                            @foreach($jefes as $i)
                            <tr>
                                <td>{{$i["jefe"]}}</td>
                                <td>{{$i["docente"]}}</td>
                                <td>{{$i["fi"]}}</td>
                                <td>{{$i["ff"]}}</td>
                                <td>
                                    <a href="{{ route('jefedepartamento.delete',$i["id"])}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Encargado"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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