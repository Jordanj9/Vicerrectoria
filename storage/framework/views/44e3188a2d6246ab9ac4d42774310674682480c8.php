<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Usuarios del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.usuarios')); ?>"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Editar o Elimnar Usuario
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Modifique o elimine un usuario del sistema. Además puede usted cambiar la contraseña al usuario.</p>
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
                <h4>Datos del Usuario</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>['usuario.update',$user],'method'=>'PUT','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Identificación del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('identificacion',$user->identificacion,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el número de identificación del usuario, con éste tendrá acceso al sistema','required']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombres del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('nombres',$user->nombres,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba los nombres del usuario','required','id'=>'txt_nombres']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Apellidos del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('apellidos',$user->apellidos,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba los apellidos del usuario','required','id'=>'txt_apellidos']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">E-mail del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::email('email',$user->email,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el correo electrónico del usuario','required','id'=>'txt_email']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('grupos', 'Seleccione Estado del Usuario', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('estado',['ACTIVO'=>'ACTIVO','INACTIVO'=>'INACTIVO'],$user->estado,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('grupos', 'Seleccione los Grupos o Roles de Usuarios', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('grupos[]',$grupos,$user->grupousuarios,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','multiple']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('admin.usuarios')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
                            <button class="btn btn-3d btn-primary" type="reset">Limpiar Formulario</button>
                            <?php echo Form::submit('Guardar Cambios',['class'=>'btn btn-3d btn-success']); ?>

                            <a href="<?php echo e(route('usuario.delete',$user->id)); ?>" class="btn btn-3d btn-danger">Eliminar Usuario</a>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-heading">
                <h4>Cambiar Contraseña</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>'usuario.cambiarPass','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Identificación del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('identificacion2',$user->identificacion,['class'=>'form-control col-md-7 col-xs-12','readonly','required']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Escriba La Nueva Contraseña</label>
                        <div class="col-sm-10">
                            <?php echo Form::password('pass1',['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Mínimo 6 caracteres','required']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Vuelva a Escribir La Nueva Contraseña</label>
                        <div class="col-sm-10">
                            <?php echo Form::password('pass2',['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Mínimo 6 caracteres','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('admin.usuarios')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
                            <button class="btn btn-3d btn-primary" type="reset">Limpiar Formulario</button>
                            <?php echo Form::submit('Cambiar Contraseña',['class'=>'btn btn-3d btn-success']); ?>

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