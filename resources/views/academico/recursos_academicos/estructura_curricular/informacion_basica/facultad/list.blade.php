@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Facultades</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.academico')}}">Módulo Académico</a> <i class="fa-angle-right fa"></i> Facultades
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Gestione las facultades que existen en la universidad.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Facultades  <a href="{{ route('facultad.create')}}" class="btn btn-3d btn-primary"><span> Agregar Nueva Facultad</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facultades as $f)
                            <tr>
                                <td>{{$f->id}}</td>
                                <td>{{$f->nombre}}</td>
                                <td>{{$f->descripcion}}</td>
                                <td>{{$f->created_at}}</td>
                                <td>{{$f->updated_at}}</td>
                                <td>
                                    <a href="{{ route('facultad.edit',$f->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Facultad"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('facultad.delete',$f->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Facultad"><i class="fa fa-trash-o"></i></a>
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