@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Encargados de Programa</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.evaluacionautohetero')}}"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Gestión de Encargados de Programa
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a los encargados de programa.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Encargados de Programa <a href="{{ route('jefedepartamento.create') }}" class="btn btn-default"><span> Agregar Nuevo Encargado</span></a></h3>
            </div>
            <div class="panel-body">                                                            
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Departamento</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jefes as $i)
                            <tr>
                                <td>{{$i->personanatural->persona->tipodoc->abreviatura." - ".$i->personanatural->persona->numero_documento}}</td>
                                <td>{{$i->personanatural->primer_nombre." ".$i->personanatural->segundo_nombre." ".$i->personanatural->primer_apellido." ".$i->personanatural->segundo_apellido}}</td>
                                <td>{{$i->departamento->nombre}}</td>
                                <td>{{$i->fechainicio}}</td>
                                <td>{{$i->fechafin}}</td>
                                <td>{{$i->created_at}}</td>
                                <td>{{$i->updated_at}}</td>
                                <td>
                                    <a href="{{ route('jefedepartamento.edit',$i->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Encargado"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('jefedepartamento.delete',$i->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Encargado"><i class="fa fa-trash-o"></i></a>
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