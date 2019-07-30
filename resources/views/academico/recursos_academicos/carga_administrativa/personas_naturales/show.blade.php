@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docente</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="{{route('admin.academico')}}"> Recursos Académicos </a><span class="fa-angle-right fa"></span><a href="{{route('pnaturales.index')}}"> Docentes </a><span class="fa-angle-right fa"></span> Ver
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
                <h4>Datos del Docente</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="success">
                                    DATOS PERSONALES
                                </td>
                                <td class="success"></td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Docente ID</b></td>
                                <td class="subject">{{$p->id}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Nombres y Apellidos</b></td>
                                <td class="subject">{{$p->primer_nombre . " ". $p->segundo_nombre." ".$p->primer_apellido." ".$p->segundo_apellido}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Documento</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->numero_documento}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Tipo Documento</b></td>
                                <td class="subject">@if($p->persona->tipodoc!==null){{$p->persona->tipodoc->descripcion}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Lugar de Expedición</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->lugar_expedicion}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Fecha de Expedición</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->fecha_expedicion}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Libreta Militar</b></td>
                                <td class="subject">{{$p->libreta_militar}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Distrito Militar</b></td>
                                <td class="subject">{{$p->distrito_militar}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Tipo Sanguíneo</b></td>
                                <td class="subject">{{$p->rh}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Sexo</b></td>
                                <td class="subject">@if($p->sexo==='M') MASCULINO @else FEMENINO @endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Fecha de Nacimiento</b></td>
                                <td class="subject">{{$p->fecha_nacimiento}}</td>
                            </tr>
                            <tr>
                                <td class="success">
                                    DATOS DE UBICACIÓN
                                </td>
                                <td class="success"></td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Dirección</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->direccion}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Teléfono</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->telefono}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Celular</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->celular}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Correo Personal</b></td>
                                <td class="subject">@if($p->persona!==null){{$p->persona->mail}}@endif</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Correo Institucional</b></td>
                                <td class="subject">{{$p->email_institucional}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Creado</b></td>
                                <td class="subject">{{$p->created_at}}</td>
                            </tr>
                            <tr class="read">
                                <td class="contact"><b>Modificado</b></td>
                                <td class="subject">{{$p->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

