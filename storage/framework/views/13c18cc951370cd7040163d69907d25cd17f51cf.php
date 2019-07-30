<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Encargados de Programa</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('jefedepartamento.index')); ?>">Gestión de Encargados de Programa </a> <span class="fa-angle-right fa"></span> Editar
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-default alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la información referente a los Encargados de Programa.</p>
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
                <h4>Editar Datos del Encargado de Programa <?php echo e($jefe->personanatural->primer_nombre." ".$jefe->personanatural->primer_apellido); ?></h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>['jefedepartamento.update',$jefe],'method'=>'PUT','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Inicial</label>
                            <input class="form-control col-md-7 col-xs-12" value="<?php echo e($jefe->fechainicio); ?>" name="fechainicio" type="date" placeholder="Fecha de inicio" required="required" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label text-right">Fecha Final <?php echo e($jefe->fechafin); ?></label>
                            <input class="form-control col-md-7 col-xs-12" value="<?php echo e($jefe->fechafin); ?>" name="fechainicio" type="date" placeholder="Fecha de inicio" required="required" />                      
                       </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="<?php echo e(route('jefedepartamento.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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