<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Privilegios a Páginas</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio </a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.usuarios')); ?>"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Privilegios a Páginas
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Los privilegios a páginas son los permisos que se deben asignar a los grupos de usuarios o roles para acceder a las funciones específicas de los módulos, es decir, sus páginas. En este sentido, si añade páginas a un grupo de usuario usted le estaría concediendo permisos al grupo para actuar sobre dichas páginas.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
            <span class="fa fa-info fa-2x"></span></div>
        <div class="col-md-10 col-sm-10">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <p><strong>Modo de Operar:</strong> Seleccione un grupo de usuario y agregue permisos de izquierda a derecha o elimine privilegios del grupo pasando de derecha a izquierda.</p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Gestión de Privilegios a Páginas</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('grupousuario_id', 'Seleccione Grupo o Rol de Usuario', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('grupousuario_id',$grupos,null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','onchange="traerData()"']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="panel bg-primary box-shadow-none">
                            <div class="panel-body">
                                <center><h4 class="text-white">Páginas del Sistema</h4></center>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php echo Form::select('paginas[]',$paginas,null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','multiple', 'size="20"','id'=>'paginas']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:20px">
                    <center>
                        <button type="button" class="btn btn-success" onclick="agregar()"> Agregar </button>
                        <button type="button" class="btn btn-danger" onclick="retirar()"> Quitar </button>
                        <button type="button" class="btn btn-success" onclick="agregarTodas()"> Agregar Todo </button>
                        <button type="button" class="btn btn-danger" onclick="retirarTodas()"> Quitar Todo </button>
                    </center>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="panel bg-primary box-shadow-none">
                            <div class="panel-body">
                                <center><h4 class="text-white">Privilegios del Grupo</h4></center>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::open(['route'=>'grupousuario.guardar','method'=>'POST','name'=>'form-privilegios','id'=>'form-privilegios']); ?>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <?php echo Form::hidden('id',null,['class'=>'form-control col-md-7 col-xs-12','id'=>'id']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="privilegios[]" id="privilegios" class="form-control col-md-7 col-xs-12" multiple="" size="20" required="required"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <br/><button type="submit" id="btn-enviar" class="btn btn-3d btn-primary btn-block">Guardar los Cambios Para el Grupo Seleccionado</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>  
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btn-enviar").click(function (e) {
            validar(e);
        });
    });

    function validar(e) {
        e.preventDefault();
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $('#privilegios option').each(function () {
                var valor = $(this).attr('value');
                $("#privilegios").find("option[value='" + valor + "']").prop("selected", true);
            });
            $("#form-privilegios").submit();
        }
    }

    function agregar() {
        var id = $("#grupousuario_id").val();
        if (id === null) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $.each($('#paginas :selected'), function () {
                var valor = $(this).val();
                var texto = $(this).text();
                if (!existe(valor)) {
                    $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                }
            });
        }
    }

    function agregarTodas() {
        var id = $("#grupousuario_id").val();
        if (id === null) {
            notify('Atención', 'Debe seleccionar un grupo de usuarios para agregar privilegios.', 'warning');
        } else {
            $('#paginas option').each(function () {
                var valor = $(this).attr('value');
                var texto = $(this).text();
                if (texto !== "-- Seleccione una opción --") {
                    if (!existe(valor)) {
                        $("#privilegios").append("<option value='" + valor + "'>" + texto + "</option>");
                        $("#paginas").find("option[value='" + valor + "']").prop("disabled", true);
                    }
                }
            });
        }
    }

    function existe(valor) {
        var array = [];
        $("#privilegios option").each(function () {
            array.push($(this).attr('value'));
        });
        var index = $.inArray(valor, array);
        if (index !== -1) {
            return true;
        } else {
            return false;
        }
    }

    function retirar() {
        $.each($('#privilegios :selected'), function () {
            var valor = $(this).val();
            $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
            $(this).remove();
        });
    }

    function retirarTodas() {
        $('#privilegios option').each(function () {
            var valor = $(this).attr('value');
            $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
            $(this).remove();
        });
    }

    function traerData() {
        var id = $("#grupousuario_id").val();
        $("#id").val(id);
        $.ajax({
            type: 'GET',
            url: url + "usuarios/grupousuario/" + id + "/privilegios",
            data: {},
        }).done(function (msg) {
            $('#privilegios option').each(function () {
                $(this).remove();
            });
            var m = JSON.parse(msg);
            if (m.mensaje != "null") {
                $('#paginas option').each(function () {
                    var valor = $(this).attr('value');
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                });
                $.each(m.data, function (index, item) {
                    $("#privilegios").append("<option value='" + item.id + "'>" + item.value + "</option>");
                    $("#paginas").find("option[value='" + item.id + "']").prop("disabled", true);
                });
            } else {
                notify('Atención', 'El grupo de usuarios seleccionado no tiene privilegios asignados aún.', 'error');
                $('#paginas option').each(function () {
                    var valor = $(this).attr('value');
                    $("#paginas").find("option[value='" + valor + "']").prop("disabled", false);
                });
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>