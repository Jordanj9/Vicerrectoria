<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Académico - Gestión de Docentes</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Módulo Académico </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.academico')); ?>"> Recursos Académicos </a><span class="fa-angle-right fa"></span><a href="<?php echo e(route('pnaturales.index')); ?>"> Docentes </a><span class="fa-angle-right fa"></span> Crear
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue nuevos Docentes. Contiene la información de los Docentes.</p>
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
                <h4>Datos del Docente</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
                <div class="col-md-12">
                    <?php echo Form::open(['route'=>'pnaturales.store','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <legend>Datos Personales</legend>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label class="control-label">Primer Nombre</label>
                            <?php echo Form::text('primer_nombre',null,['class'=>'form-control','required']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Segundo Nombre</label>
                            <?php echo Form::text('segundo_nombre',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Primer Apellido</label>
                            <?php echo Form::text('primer_apellido',null,['class'=>'form-control','required']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Segundo Apellido</label>
                            <?php echo Form::text('segundo_apellido',null,['class'=>'form-control']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <?php echo Form::label('tipo', 'Tipo de Documento', ['class' => 'control-label']); ?>

                            <?php echo Form::select('tipodoc_id',$tipodocs,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Identificación</label>
                            <?php echo Form::text('numero_documento',null,['class'=>'form-control','placeholder'=>'Número del documento de identificación','required']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Lugar de Expedición</label>
                            <?php echo Form::text('lugar_expedicion',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Fecha de Expedición</label>
                            <?php echo Form::date('fecha_expedicion',null,['class'=>'form-control']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            <?php echo Form::label('tipo', 'Libreta Militar', ['class' => 'control-label']); ?>

                            <?php echo Form::text('libreta_militar',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Distrito Militar</label>
                            <?php echo Form::text('distrito_militar',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-2">
                            <?php echo Form::label('tipo', 'Tipo Sanguíneo', ['class' => 'control-label']); ?>

                            <?php echo Form::select('rh',['A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --']); ?>

                        </div>
                        <div class="col-md-2">
                            <?php echo Form::label('tipo', 'Sexo', ['class' => 'control-label']); ?>

                            <?php echo Form::select('sexo',['F'=>'F','M'=>'M'],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','required']); ?>

                        </div>
                        <div class="col-md-4">
                            <?php echo Form::label('tipo', 'Fecha de Nacimiento', ['class' => 'control-label']); ?>

                            <?php echo Form::date('fecha_nacimiento',null,['class'=>'form-control']); ?>

                        </div>
                    </div>
                    <legend>Datos de Ubicación</legend>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Dirección</label>
                            <?php echo Form::text('direccion',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Teléfono</label>
                            <?php echo Form::text('telefono1',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Teléfono Celular</label>
                            <?php echo Form::text('telefono2',null,['class'=>'form-control']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Correo Personal</label>
                            <?php echo Form::email('email',null,['class'=>'form-control']); ?>

                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Correo Institucional</label>
                            <?php echo Form::email('email_institucional',null,['class'=>'form-control']); ?>

                        </div>
                    </div>
                    <legend>Datos de Labor</legend>
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php echo Form::label('tipo', 'Facultad', ['class' => 'control-label']); ?>

                            <?php echo Form::select('facultad_id',$facultades,null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'facultad_id','onchange'=>'getDepartamentos()']); ?>

                        </div>
                        <div class="col-md-6">
                            <?php echo Form::label('tipo', 'Departamento', ['class' => 'control-label']); ?>

                            <?php echo Form::select('departamento_id',[],null,['class'=>'form-control','placeholder'=>'-- Seleccione una opción --','id'=>'departamento_id','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('pnaturales.index')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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
<?php $__env->startSection('script'); ?>
<script>
    $(".chosen-select").chosen({});

    function getEstados(name, dpto, ciudad) {
        var id = $("#" + name).val();
        $.ajax({
            type: 'GET',
            url: url + "academico/pais/" + id + "/estados",
            data: {},
        }).done(function (msg) {
            $('#' + dpto + ' option').each(function () {
                $(this).remove();
            });
            $('#' + ciudad + ' option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#" + dpto).append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El País seleccionado no posee información de estados.', 'error');
            }
        });
    }

    function getDepartamentos() {
        var id = $("#facultad_id").val();
        $.ajax({
            type: 'GET',
            url: url + "academico/facultad/" + id + "/get/departamentos",
            data: {},
        }).done(function (msg) {
            $('#departamento_id option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#departamento_id").append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'La Facultad seleccionada no posee Departamentos asociados.', 'error');
            }
        });
    }

    function getCiudades(name, ciudad) {
        var id = $("#" + name).val();
        $.ajax({
            type: 'GET',
            url: url + "academico/estado/" + id + "/ciudades",
            data: {},
        }).done(function (msg) {
            $('#' + ciudad + ' option').each(function () {
                $(this).remove();
            });
            if (msg !== "null") {
                var m = JSON.parse(msg);
                $.each(m, function (index, item) {
                    $("#" + ciudad).append("<option value='" + item.id + "'>" + item.value + "</option>");
                });
            } else {
                notify('Atención', 'El Estado seleccionado no posee información de ciudades.', 'error');
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>