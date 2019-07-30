@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Cargos</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span> <a href="{{route('cargo.index')}}"> Gestión de Cargos </a> <span class="fa-angle-right fa"></span> Ver Cargo
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
                <h4>Datos del Cargo Seleccionado</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="read">
                                <td class="contact"><b>Id del Cargo</b></td>
                                <td class="subject">{{$cargo->id}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Código Asignado por la Universidad</b></td>
                                <td class="subject">{{$cargo->codigo}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombre</b></td>
                                <td class="subject">{{$cargo->nombre}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Descripción</b></td>
                                <td class="subject">{{$cargo->descripcion}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Número de empleados</b></td>
                                <td class="subject">{{$cargo->numero_empleados}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Labor de Docencia</b></td>
                                <td class="subject">@if($cargo->tiene_funcion=='1')<label class="label label-success">SI</label>@else<label class="label label-danger">NO</label>@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Creado</b></td>
                                <td class="subject">{{$cargo->created_at}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Modificado</b></td>
                                <td class="subject">{{$cargo->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

