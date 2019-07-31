<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Departamentos</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <i class="fa-angle-right fa"></i> <a href="<?php echo e(route('admin.academico')); ?>">Módulo Académico</a> <i class="fa-angle-right fa"></i> Departamentos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Gestione los departamentos de las diferentes facultades que existen en la universidad.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Departamentos  <a href="<?php echo e(route('departamentos.create')); ?>" class="btn btn-3d btn-primary"><span> Agregar Nueva Departamento</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Facultad</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($f->id); ?></td>
                                <td><?php echo e($f->nombre); ?></td>
                                <td><?php echo e($f->descripcion); ?></td>
                                <td><?php echo e($f->facultad->nombre); ?></td>
                                <td><?php echo e($f->created_at); ?></td>
                                <td><?php echo e($f->updated_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('departamentos.edit',$f->id)); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Departamento"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo e(route('departamentos.delete',$f->id)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Departamento"><i class="fa fa-trash-o"></i></a>
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