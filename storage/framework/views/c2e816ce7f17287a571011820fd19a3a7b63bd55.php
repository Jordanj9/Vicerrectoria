<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Usuarios del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio </a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.usuarios')); ?>"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Listado de Usuarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Usuarios del Sistema</h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Usuario</th>
                                <th>E-mail</th>
                                <th>Estado</th>
                                <th>Roles</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($usuario->identificacion); ?></td>
                                <td><?php echo e($usuario->nombres); ?> <?php echo e($usuario->apellidos); ?></td>
                                <td><?php echo e($usuario->email); ?></td>
                                <td><?php if($usuario->estado=='ACTIVO'): ?><label class="label label-success">ACTIVO</label><?php else: ?><label class="label label-danger">INACTIVO</label><?php endif; ?></td>
                                <td>
                                    <?php $__currentLoopData = $usuario->grupousuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($grupo->nombre); ?> - 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($usuario->created_at); ?></td>
                                <td><?php echo e($usuario->updated_at); ?></td>
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