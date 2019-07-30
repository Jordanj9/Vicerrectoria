@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Módulos Generales del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio </a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Módulos Generales
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Los módulos generales del sistema son las aplicaciones generales representadas en las opciones del menú. Ejemplo de modulo general: ACADÉMICO ESTUDIANTE.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-warning alert-raised alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Nota: </strong> No modifique los nombres de los módulos ya creados ya que puede ocasionar fallas en el sistema.
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Módulos Generales del Sistema  <a href="{{ route('modulo.create') }}" class="btn btn-default"><span> Agregar Nuevo Módulo</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Módulo</th>
                                <th>Descripción</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modulos as $modulo)
                            <tr>
                                <td>{{$modulo->id}}</td>
                                <td>{{$modulo->nombre}}</td>
                                <td>{{$modulo->descripcion}}</td>
                                <td>{{$modulo->created_at}}</td>
                                <td>{{$modulo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('modulo.edit',$modulo->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Módulo"><i class="fa fa-edit"></i></a>
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