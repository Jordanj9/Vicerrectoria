<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Cargos</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Gestión de Cargos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Contiene la información de los cargos administrativos que existen al interior de la institución.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Cargos  <a href="<?php echo e(route('cargo.create')); ?>" class="btn btn-3d btn-primary"><span> Agregar Nuevo Cargo</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>N° Empleados</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($cargo->codigo); ?></td>
                                <td><?php echo e($cargo->nombre); ?></td>
                                <td><?php echo e($cargo->numero_empleados); ?></td>
                                <td><?php echo e($cargo->created_at); ?></td>
                                <td><?php echo e($cargo->updated_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('cargo.edit',$cargo->id)); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Cargo"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo e(route('cargo.show',$cargo->id)); ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Cargo"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo e(route('cargo.delete',$cargo->id)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Cargo"><i class="fa fa-trash-o"></i></a>
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