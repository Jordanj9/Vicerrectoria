<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Gestión de Fechas de Aplicación de Evaluación Académica</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Gestión de Fechas de Aplicación de Evaluación Académica
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar las fechas en la que se aplicará la evaluación académica de los docentes, jefes y pares para un período determinado.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Fechas de Aplicación <a href="<?php echo e(route('fechaaplicacion.create')); ?>" class="btn btn-default"><span> Agregar Nueva Fecha</span></a></h3>
            </div>
            <div class="panel-body">                                                            
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Periodo</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $fechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i->periodoacademico->anio . " - " . $i->periodoacademico->periodo . " --> " . $i->periodoacademico->TipoPeriodo->descripcion); ?></td>
                                <td><?php echo e($i->fechainicio); ?></td>
                                <td><?php echo e($i->fechafin); ?></td>
                                <td><?php echo e($i->created_at); ?></td>
                                <td><?php echo e($i->updated_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('fechaaplicacion.edit',$i->id)); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Fecha"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo e(route('fechaaplicacion.delete',$i->id)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Fecha"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>