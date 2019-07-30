@extends('layouts.admin')
@section('content')
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Convertir Docentes a Usuarios (Automático)</h3>
            <p class="animated fadeInDown">
                <a href="{{route('inicio')}}">Inicio </a> <span class="fa-angle-right fa"></span><a href="{{route('admin.usuarios')}}"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Convertir Docentes a Usuarios (Automático)
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario convertir en usuarios del sistema de forma automática a todos los docentes docentes nuevos o docentes que no tengan usuario asignado todavía. El usuario para acceder al sistema será el número de identificación y la contraseña será 0000 que deberá cambiar el usuario una vez ingrese al sistema.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Convertir Docentes a Usuarios (Automático)</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::open(['route'=>'usuario.convertirdocente','method'=>'POST','class'=>'form-horizontal form-label-left'])!!}
                    <div class="alert alert-warning alert-border alert-dismissible fade in" role="alert">
                        <h3>Nota
                            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </h3>
                        <p><strong>Tenga en cuenta: </strong> Este proceso puede tardar varios minutos, la pagina parecerá no estar haciendo nada. Tenga paciencia y no cierre la página, no retroceda, no actualice la pagina ni realice otra operación mientras el proceso es llevado a cabo. Una vez de clic en el boton, el proceso dara inicio y generará usuarios a todos los docentes que aún no tengan uno.</p>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Seleccione grupo o rol de usuario para los docentes (Use el rol designado por la institución para los docentes)</label>
                            {!! Form::select('grupo',$grupos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit('Procesar',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {

    });

    $(".chosen-select").chosen({});

</script>
@endsection