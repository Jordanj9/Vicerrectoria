@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Admisiones - Menú Inscripciones</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio</a> <span class="fa-angle-right fa"></span> <a href="{{route('admin.admisiones')}}"> Módulo Admisiones </a> <span class="fa-angle-right fa"></span> Inscripciones
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>INSCRIPCIÓN EN LÍNEA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-12">
                        {!! Form::label('nivel_educativo_id', 'Nivel Educativo', ['class' => 'control-label text-right'])!!}
                        {!! Form::select('nivel_educativo_id',$niveles,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'nivel_educativo_id']) !!}
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a class="btn ripple btn-3d btn-primary"  id="btn_1" onclick="navegar(this.id)">
                        <div>
                            <span>Agregar Aspirante Transf. Externa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a class="btn ripple btn-3d btn-primary" id="btn_2" onclick="navegar(this.id)">
                        <div>
                            <span>Trasferencia Externa</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a class="btn ripple btn-3d btn-primary" id="btn_3" onclick="navegar(this.id)">
                        <div>
                            <span>Transferencia Interna</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(".chosen-select").chosen({});

    function navegar(id) {
        var nivel = $("#nivel_educativo_id").val();
        if (nivel === null) {
            notify('Alerta', 'Debe seleccionar nivel educativo', 'warning');
            return;
        }
        switch (id) {
            case 'btn_1':
                location.href = url + "admisiones/inscripcion/" + nivel + "/aspirante/trasferenciaexterna";
                break;
            case 'btn_2':
                location.href = url + "admisiones/inscripcion/" + nivel + "/aspirante/trasferenciaexterna/solicitudtransferencia";
                break;
            case 'btn_3':
                location.href = url + "admisiones/inscripcion/" + nivel + "/aspirante/transferenciainterna/solicitudtransferencia";
                break;
            default:
                break;
        }
    }
</script>
@endsection