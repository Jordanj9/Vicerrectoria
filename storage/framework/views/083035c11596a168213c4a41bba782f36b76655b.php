<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Fechas de Aplicación de Evaluació Académica</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('fechaaplicacion.index')); ?>"> Fechas de Aplicación de Evaluación Académica</a> <span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
       <p>Esta funcionalidad permite al usuario gestionar las fechas en la que se aplicará la evaluación académica de los docentes, jefes y estudiantes para un período determinado, para los estudiantes en estas fechas no podran visualizar las notas.</p>
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
                <h4>Datos de la Fecha de Aplicación</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>'fechaaplicacion.store','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Periodo</label>
                        <div class="col-sm-10">
                            <?php echo Form::select('periodoacademico_id',$periodos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodoacademico_id']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Fecha Inicial</label>
                        <div class="col-sm-10">
                            <input class="form-control col-md-7 col-xs-12" name="fechainicio" type="date" placeholder="Inicio de la evaluacion académica" required="required" />
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Fecha Final</label>
                        <div class="col-sm-10">
                            <input class="form-control col-md-7 col-xs-12" name="fechafin" type="date" placeholder="Ultimo plazo para evaluación académica" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('fechaaplicacion.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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