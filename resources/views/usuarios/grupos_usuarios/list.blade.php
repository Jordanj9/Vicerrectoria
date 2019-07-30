@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Grupos de Usuarios o Roles del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio </a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Grupos de Usuarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Los grupos de usuarios son los roles o agrupaciones de usuarios que permite asignarle privilegios a todo un conglomerado de usuarios que comparte funciones. Ejemplo de grupos de usuarios: ADMINISTRADORES, ESTUDIANTES, BIENESTAR, SISTEMAS, DOCENTES, EGRESADOS, ETC.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Grupos de Usuarios del Sistema  <a href="{{ route('grupousuario.create') }}" class="btn btn-3d btn-primary"><span> Agregar Nuevo Grupo</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Grupo</th>
                                <th>Descripción</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                            <tr>
                                <td>{{$grupo->id}}</td>
                                <td>{{$grupo->nombre}}</td>
                                <td>{{$grupo->descripcion}}</td>
                                <td>{{$grupo->created_at}}</td>
                                <td>{{$grupo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('grupousuario.edit',$grupo->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Grupo de Usuario"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('grupousuario.show',$grupo->id)}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Datos del Grupo de Usuario"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('grupousuario.delete',$grupo->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Grupo de Usuario"><i class="fa fa-trash-o"></i></a>
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