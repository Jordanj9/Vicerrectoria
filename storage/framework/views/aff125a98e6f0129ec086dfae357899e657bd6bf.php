<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docentes</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Docentes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Docentes  <a href="<?php echo e(route('docentes.create')); ?>" class="btn btn-3d btn-primary"><span> Agregar Nuevo Docente</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th>Facultad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i->tipo.".".$i->documento); ?></td>
                                <td><?php echo e($i->name); ?></td>
                                <td><?php echo e($i->personanatural->persona->celular); ?></td>
                                <td><?php echo e($i->personanatural->persona->direccion); ?></td>
                                <td><?php echo e($i->labor); ?></td>
                                <td><?php echo e($i->depto); ?></td>
                                <td><?php echo e($i->fac); ?></td>
                                <td>
                                    <a href="<?php echo e(route('docentes.delete',$i->pege)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Docente"><i class="fa fa-trash-o"></i></a>
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