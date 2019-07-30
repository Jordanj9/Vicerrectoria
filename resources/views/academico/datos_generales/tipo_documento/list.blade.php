@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Tipos de Documento</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Datos Generales </a><span class="fa-angle-right fa"></span> Tipos de Documento
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Contiene la información de los Tipos de Documentos.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Tipos de Documentos  <a href="{{ route('tipodoc.create') }}" class="btn btn-3d btn-primary"><span> Agregar Nuevo Tipo de Documento</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Tipo Persona</th>
                                <th>Abreviatura</th>
                                <th>Tipo Escritura</th>
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
                                <td>
                                    @if($tipo->tipo_persona=='J')
                                    JURÍDICA
                                    @else
                                    NATURAL
                                    @endif
                                </td>
                                <td>{{$tipo->abreviatura}}</td>
                                <td>{{$tipo->tipo}}</td>
                                <td>{{$tipo->created_at}}</td>
                                <td>{{$tipo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('tipodoc.edit',$tipo->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Tipo de Documento"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('tipodoc.delete',$tipo->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Tipo de Documento"><i class="fa fa-trash-o"></i></a>
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