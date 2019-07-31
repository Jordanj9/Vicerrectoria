<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Grupos de Usuarios o Roles del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.usuarios')); ?>"> Módulo Usuarios </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('grupousuario.index')); ?>"> Grupos de Usuarios </a><span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue nuevos grupos, los grupos de usuarios son los roles o agrupaciones de usuarios que permite asignarle privilegios a todo un conglomerado de usuarios que comparte funciones. Ejemplo de grupos de usuarios: ADMINISTRADORES, ESTUDIANTES, BIENESTAR, SISTEMAS, DOCENTES, EGRESADOS, ETC.</p>
    </div>
</div>
<div class="col-md-12">
    <?php $__env->startComponent('layouts.errors'); ?>
    <?php echo $__env->renderComponent(); ?>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-heading">
                <h4>Datos del Grupo</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>'grupousuario.store','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombre del Grupo</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el nombre del grupo o rol de usuario','required']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Descripción (Opcional)</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('descripcion',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Descripción del grupo']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('niveles', 'Seleccione los Módulos a los que el Grupo Tendrá Acceso', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('modulos[]',$modulos,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','multiple']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('grupousuario.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
                            <button class="btn btn-3d btn-primary" type="reset">Limpiar Formulario</button>
                            <?php echo Form::submit('Guardar',['class'=>'btn btn-3d btn-success']); ?>

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
<script>
    $(".chosen-select").chosen({});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>