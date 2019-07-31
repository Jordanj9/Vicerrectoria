<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Autorizar Evaluación</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Autorizar Evaluación
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-primary alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite autorizar la evaluación académica para jefes, docentes y pares; sin ésta autorización no será efectiva la evaluación. </p>
    </div>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Listado de Autorizaciones de Evaluación <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default"><span> Agregar Nueva Autorización</span></a></h3>
            </div>
            <div class="panel-body">
                <div class="responsive-table">
                    <table id="tabla" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Evaluación</th>
                                <th>Rol Al Que Aplica</th>
                                <th>Período</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $autorizaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($a->id); ?></td>
                                <td><?php if($a->evaluacionaah!=null): ?><?php echo e($a->evaluacionaah->nombre." - PESO: ".$a->evaluacionaah->peso." %"); ?> <?php else: ?> -- <?php endif; ?></td>
                                <td><?php echo e($a->rol); ?></td>
                                <td><?php echo e($a->periodoacademico->anio." - ".$a->periodoacademico->periodo); ?></td>                             
                                <td><?php echo e($a->created_at); ?></td>
                                <td><?php echo e($a->updated_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('autorizarevaluacion.delete',$a->id)); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Autorización"><i class="fa fa-trash-o"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Nueva Autorización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label">¿A Quién Aplica?</label>
                        <?php echo Form::select('rol',['JEFE'=>'JEFE','DOCENTE EN COMISION'=>'DOCENTE EN COMISION','VICERRECTOR'=>'VICERRECTOR','DECANO'=>'DECANO','RECTOR'=>'RECTOR','PARES'=>'PARES/COLABORADORES'],null,['class'=>'form-control chosen-select','required','id'=>'rol']); ?>

                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Período Académico</label>
                        <?php echo Form::select('periodo',$periodos,null,['class'=>'form-control chosen-select','required','id'=>'periodo']); ?>

                    </div>
                </div>
                <div class="responsive-table"  style="margin-top: 100px !important;">
                    <table id="tabla2" class="table table-hover table-responsive table-bordered table-condensed" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Evaluación</th>
                                <th>Peso</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $evaluaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($e->nombre." - ".$e->descripcion); ?></td>
                                <td><?php echo e($e->peso." %"); ?></td>
                                <td>
                                    <a onclick="enviar(this.id)" id="<?php echo e($e->id); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Autorización de Evaluación"><i class="fa fa-arrow-right"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').DataTable();
        $('#tabla2').DataTable();
    });

    function enviar(e) {
        var p = $("#periodo").val();
        var r = $("#rol").val();
        location.href = url + "evaluacionacademica/autorizarevaluacion/" + e + "/" + p + "/" + r + "/agregar";
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>