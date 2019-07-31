<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span> <a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica</a> <span class="fa-angle-right fa"></span> <a href="<?php echo e(route('aplicaciondocente.inicio')); ?>"> Aplicar Evaluación</a> <span class="fa-angle-right fa"></span> Realizar Exámen
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>La funcionalidad permite realizar la autoevaluación academica del docente para la materia seleccionada.</p>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Realizar Autoevaluación Académica</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="responsive-table panel box-v1">
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="success">
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Período</th>
                            </tr>
                            <tr>
                                <td><?php echo e($pn->persona->numero_documento); ?></td>
                                <td><?php echo e($nombredoc); ?></td>  
                                <td><?php echo e($periodo->anio." - ".$periodo->periodo); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="success">
                                <th>Docente</th>
                                <th>Evaluación</th>
                            </tr>
                            <tr>
                                <td><?php echo e($nombredoc); ?></td>  
                                <td><?php echo e($e->nombre); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 top-20">
                <div class="col-md-12">
                    <h4>Forma de Evaluar</h4>
                    <p><b>Escriba en el campo "Valor" al frente de cada indicador su respectiva calificación de acuerdo a la siguiente tabla.</b></p>
                    <div class="responsive-table panel box-v1">
                        <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                            <tbody>
                                <tr class="success">
                                    <th>Notación</th>
                                    <th>Descripción</th>
                                    <th>Valor Cualitativo</th>
                                    <th>Rango Cuantitativo</th>
                                </tr>
                                <?php $__currentLoopData = $eval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($ev->acronimo); ?></td>
                                    <td><?php echo e($ev->descripcion); ?></td>
                                    <td><?php echo e($ev->valor_cualitativo); ?></td>  
                                    <td><?php echo e($ev->valor_cuat1." - ".$ev->valor_cuat2); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php echo Form::open(['route'=>'aplicaciondocente.guardarevaluaciondocente','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                <input type="hidden" name="docente_pegea" value="<?php echo e($pn->id); ?>" />
                <input type="hidden" name="docente_pegeq" value="<?php echo e($docenteacademico->pege); ?>" />
                <input type="hidden" name="personanaturala" value="<?php echo e($pn->id); ?>" />
                <input type="hidden" name="personanaturalq" value="<?php echo e($docenteacademico->pege); ?>" />
                <input type="hidden" name="periodoacademico_id" value="<?php echo e($periodo->id); ?>" />
                <input type="hidden" name="evaluacionaah_id" value="<?php echo e($e->id); ?>" />
                <div class="responsive-table panel box-v1">
                    <h4><?php echo e($e->nombre); ?></h4>
                    <table class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <tbody>
                            <tr class="info">
                                <th>Indicador</th>
                                <th>Criterio</th>
                                <th>Valor</th>
                            </tr>
                            <?php $__currentLoopData = $e->evaluacionindicadors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i->indicador->indicador); ?></td>
                                <td><?php echo e($i->indicador->criterioevaluacion->nombre); ?></td>
                                <td><input type="number" accept="text" min="10" max="100" required="required" class="form-control" name="indicador_<?php echo e($i->id); ?>" /></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <?php echo Form::submit('Enviar Evaluación',['class'=>'btn btn-3d btn-success']); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>