<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Formularios de Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> <a href="<?php echo e(route('evaluacionaah.index')); ?>">Formularios de Evaluación </a> <span class="fa-angle-right fa"></span> Crear Formulario
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite gestionar los diferentes formularios de evaluación que van a ser tenidos en cuenta al momento de aplicar la auto-evaluación a los docentes y las hetero-evaluaciones a los jefes de programa y estudiantes.</p>
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
                <h4>Datos del Formulario</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>'evaluacionaah.store','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group">
                        <div class="col-md-5">
                            <label class="control-label">Nombre del Formulario de Evaluación</label>
                            <?php echo Form::text('nombre',null,['class'=>'form-control','required']); ?>

                        </div>
                        <div class="col-md-7">
                            <label class="control-label">Descripción del Formulario (Opcional)</label>
                            <?php echo Form::text('descripcion',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Peso del Formulario (Porcentaje de 0 a 100)</label>
                            <?php echo Form::text('peso',null,['class'=>'form-control','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="<?php echo e(route('evaluacionaah.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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