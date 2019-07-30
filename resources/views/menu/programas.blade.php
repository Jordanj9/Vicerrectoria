@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Menú Gestión de Programas</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <i class="fa-angle-right fa"></i> <a href="{{route('admin.academico')}}">Módulo Académico</a> <i class="fa-angle-right fa"></i> <a href="{{route('programas.index')}}">Programas</a> <i class="fa-angle-right fa"></i> Más Opciones de Programa
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ MÁS OPCIONES DE PROGRAMAS</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="panel bg-success box-shadow-none">
                    <div class="panel-body">
                        <center><h4 class="text-white">PROGRAMA SELECCIONADO</h4></center>
                    </div>
                </div>
            </div>
            <div class="responsive-table col-md-12">
                <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Metodología</th>
                            <th>Nivel</th>
                            <th>Modalidad</th>
                            <th>Nombre</th>
                            <th>Jornada</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{$p->metodologia->nombre}}</th>
                            <th>{{$p->modalidad->NivelEducativo->descripcion}}</th>
                            <th>{{$p->modalidad->descripcion}}</th>
                            <th>{{$p->nombre}}</th>
                            <th>{{$p->jornada->descripcion}}</th>
                            <th>
                                @if($p->estado==='1')
                                <label class="label label-success">ACTIVO</label>
                                @else
                                <label class="label label-danger">INACTIVO</label>
                                @endif
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.unidad',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Relación Programa-Unidad</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.titulo',$p->id)}}"  class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Asociar Título a Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.cambionombre',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Modificar Nombre de Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.cambioestado',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Cambio de Estado de Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.cambiotpa',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Cambio en Tipo de Período Académico</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.renovacion',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Renovación del Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.acreditacion',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Acreditación del Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.aspectos',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Fundamentación del Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.ciclos',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Ciclo Curricular</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a  class="btn ripple btn-3d btn-primary" disabled="disabled">
                        <div>
                            <span>Convenios por Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.nbc',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Núcleo Básico del Conocimiento</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="{{route('programas.revision',$p->id)}}" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Revisión Programa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
