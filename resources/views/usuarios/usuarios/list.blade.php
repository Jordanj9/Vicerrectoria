@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Usuarios del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio </a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Listado de Usuarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Usuarios del Sistema</h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Usuario</th>
                                <th>E-mail</th>
                                <th>Estado</th>
                                <th>Roles</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->identificacion}}</td>
                                <td>{{$usuario->nombres}} {{$usuario->apellidos}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>@if($usuario->estado=='ACTIVO')<label class="label label-success">ACTIVO</label>@else<label class="label label-danger">INACTIVO</label>@endif</td>
                                <td>
                                    @foreach($usuario->grupousuarios as $grupo)
                                    {{$grupo->nombre}} - 
                                    @endforeach
                                </td>
                                <td>{{$usuario->created_at}}</td>
                                <td>{{$usuario->updated_at}}</td>
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