@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Tipos de Periodos Académicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.academico')}}">Módulo Académico</a> <i class="fa-angle-right fa"></i> Periodos Académicos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Los tipos de periodos académicos indican la duración de los periodos para los programas.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Tipos de Periodos Académicos  <a href="{{ route('tipoperiodo.create') }}" class="btn btn-3d btn-primary"><span> Agregar Nuevo Tipo de Periodo</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Duración en Semanas</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>{{$tipo->id}}</td>
                                <td>{{$tipo->descripcion}}</td>
                                <td>{{$tipo->duracion_semanas}} SEMANAS</td>
                                <td>{{$tipo->created_at}}</td>
                                <td>{{$tipo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('tipoperiodo.edit',$tipo->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Tipo Periodo"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('tipoperiodo.delete',$tipo->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Tipo Periodo"><i class="fa fa-trash-o"></i></a>
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