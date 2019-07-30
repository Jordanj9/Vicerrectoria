@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Formularios de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Formularios de Evaluación
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes formularios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes, a los jefes de programa y los pares. </p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Formularios de Evaluación <a href="{{ route('evaluacionaah.create') }}" class="btn btn-default"><span> Agregar Nuevo Formulario</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Peso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluaciones as $e)
                            <tr>
                                <td>{{$e->id}}</td>
                                <td>{{$e->nombre}}</td>
                                <td>{{$e->descripcion}}</td>     
                                <td>{{$e->peso}} %</td>  
                                <td>
                                    <a href="{{ route('evaluacionaah.edit',$e->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Datos de la Evaluación"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('evaluacionaah.indicadores',$e->id)}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Configurar los Indicadores de la Evaluación"><i class="fa fa-arrow-right"></i></a>
                                    <a href="{{ route('evaluacionaah.delete',$e->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Evaluación"><i class="fa fa-trash-o"></i></a>
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