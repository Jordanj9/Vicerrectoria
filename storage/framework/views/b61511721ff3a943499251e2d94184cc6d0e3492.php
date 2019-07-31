<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Evaluación Académica - Aplicación Docente</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.evaluacionautohetero')); ?>"> Módulo Evaluación Académica </a><span class="fa-angle-right fa"></span> Aplicación Docentes
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Esta funcionalidad permite al usuario gestionar la aplicación de la autoevaluación académica de los docentes.</p>
    </div>
</div>
<div class="col-md-12">
    <?php $__env->startComponent('layouts.errors'); ?>
    <?php echo $__env->renderComponent(); ?>
</div>
<div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
        <div class="panel form-element-padding">
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label class="control-label text-right">Periodo Académico</label>
                            <?php echo Form::select('periodoacademico_id',$periodos,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'periodoacademico_id']); ?>

                        </div>
                        <div class="col-sm-3">
                            <label class="control-label text-right">Quién Evalúa?</label>
                            <?php echo Form::select('docenteq',$docente,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'docenteq']); ?>

                        </div>
                        <div class="col-sm-3">
                            <label class="control-label text-right">A Quién Evalúa?</label>
                            <?php echo Form::select('docentea',$quienes,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required','id'=>'docentea']); ?>

                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-sm btn-success" onclick="ir()">Continuar</button>
                        </div>
                    </div>
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

    function ir() {
        var p = $("#periodoacademico_id").val();
        var dq = $("#docenteq").val();
        var da = $("#docentea").val();
        if (p == null) {
            notify('Alerta', 'Debe indicar todos los parámetros para continuar', 'warning');
        } else {
            location.href = url + "evaluacionacademica/aplicaciondocente/inicio/" + p + "/" + dq + "/" + da + "/ir";
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>