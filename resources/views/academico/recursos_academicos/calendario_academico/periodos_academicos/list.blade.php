@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Períodos Académicos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Períodos Académicos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Contiene la información de los períodos académicos de la institución.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Períodos Académicos  <a href="{{ route('periodoa.create') }}" class="btn btn-3d btn-primary"><span> Agregar Nuevo Período</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tipo Período</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Año</th>
                                <th>Período</th>
                                <th>Inicio Clases</th>
                                <th>Fin Clases</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodos as $p)
                            <tr>
                                <td>@if($p->tipoperiodo!==null){{$p->tipoperiodo->descripcion}}@endif</td>
                                <td><label class="label label-success">{{$p->fechainicio}}</label></td>
                                <td><label class="label label-danger">{{$p->fechafin}}</label></td>
                                <td>{{$p->anio}}</td>
                                <td>{{$p->periodo}}</td>
                                <td>{{$p->fechainicioclases}}</td>
                                <td>{{$p->fechafinclases}}</td>
                                <td>{{$p->created_at}}</td>
                                <td>{{$p->updated_at}}</td>
                                <td>
                                    <a href="{{ route('periodoa.edit',$p->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Período"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('periodoa.delete',$p->id)}}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Período"><i class="fa fa-trash-o"></i></a>
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