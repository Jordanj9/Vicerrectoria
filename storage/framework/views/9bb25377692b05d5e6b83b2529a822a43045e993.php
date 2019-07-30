<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Tipos de Periodos Académicos</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <i class="fa-angle-right fa"></i> <a href="<?php echo e(route('admin.academico')); ?>">Módulo Académico</a> <i class="fa-angle-right fa"></i> <a href="<?php echo e(route('tipoperiodo.index')); ?>"> Tipos de Periodos </a> <i class="fa-angle-right fa"></i> Editar Tipo
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Edite los tipos de periodos, recuerde que el campo descripción y duracion en semanas son requeridos.</p>
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
                <h4>Editar Datos del Tipo de Periodo <?php echo e($tipo->descripcion); ?></h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>['tipoperiodo.update',$tipo],'method'=>'PUT','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Descripción o Nombre del Tipo de Periodo</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('descripcion',$tipo->descripcion,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Estos pueden ser: trimestral, semestral, anual, etc.','required']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Duración</label>
                        <div class="col-sm-10">
                            <?php echo Form::number('duracion_semanas',$tipo->duracion_semanas,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Duración del tipo de periodo en semanas','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('tipoperiodo.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>