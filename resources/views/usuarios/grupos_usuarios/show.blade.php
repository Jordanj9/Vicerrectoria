@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Grupos de Usuarios o Roles del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span><a href="{{route('grupousuario.index')}}"> Grupos de Usuarios </a><span class="fa-angle-right fa"></span> Ver
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    @component('layouts.errors')
    @endcomponent
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-heading">
                <h4>Datos del Grupo Seleccionado</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="read">
                                <td class="contact"><b>Id del Grupo</b></td>
                                <td class="subject">{{$grupo->id}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombre</b></td>
                                <td class="subject">{{$grupo->nombre}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Descripción</b></td>
                                <td class="subject">{{$grupo->descripcion}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Cantidad de Usuarios en el Grupo</b></td>
                                <td class="subject">{{$total}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Creado</b></td>
                                <td class="subject">{{$grupo->created_at}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Modificado</b></td>
                                <td class="subject">{{$grupo->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="list-group">
                        <a class="list-group-item active">
                            MÓDULOS A LOS QUE TIENE ACCESO EL GRUPO DE USUARIOS 
                        </a>
                        @foreach($grupo->modulos as $modulo)
                        <span class="list-group-item">{{$modulo->nombre}} ==> {{$modulo->descripcion}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

