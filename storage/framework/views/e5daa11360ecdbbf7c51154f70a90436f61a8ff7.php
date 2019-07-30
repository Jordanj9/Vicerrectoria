<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Períodos Académicos</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Recursos Académicos </a><span class="fa-angle-right fa"></span> Períodos Académicos
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Contiene la información de los períodos académicos de la institución.</p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Períodos Académicos  <a href="<?php echo e(route('periodoa.create')); ?>" class="btn btn-3d btn-primary"><span> Agregar Nuevo Período</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tipo Período</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Año</th>
                                <th>Período</th>
                                <th>Inicio Clases</th>
                                <th>Fin Clases</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $periodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php if($p->tipoperiodo!==null): ?><?php echo e($p->tipoperiodo->descripcion); ?><?php endif; ?></td>
                                <td><label class="label label-success"><?php echo e($p->fechainicio); ?></label></td>
                                <td><label class="label label-danger"><?php echo e($p->fechafin); ?></label></td>
                                <td><?php echo e($p->anio); ?></td>
                                <td><?php echo e($p->periodo); ?></td>
                                <td><?php echo e($p->fechainicioclases); ?></td>
                                <td><?php echo e($p->fechafinclases); ?></td>
                                <td><?php echo e($p->created_at); ?></td>
                                <td><?php echo e($p->updated_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('periodoa.edit',$p->id)); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Período"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo e(route('periodoa.delete',$p->id)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Período"><i class="fa fa-trash-o"></i></a>
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