<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Usuarios del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span><a href="<?php echo e(route('admin.usuarios')); ?>"> Módulo Usuarios </a><span class="fa-angle-right fa"></span> Crear Usuario Manual
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
        <h3>Detalles
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </h3>
        <p>Agregue un usuario al sistema y registre su/sus roles de acceso. Puede crear un usuario llenando todos los campos, a partir de las personas generales ó partiendo de un estudiante.</p>
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
                <h4>Datos del Usuario</h4>
            </div>
            <div class="panel-body" style="padding-bottom:30px;">
<!--                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php echo Form::text('id',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba la identificación a consultar','id'=>'id']); ?>

                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getEstudiante()">Traer Estudiante</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="getPersona()">Traer Persona</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Seleccione Persona Natural/Estudiante</label>
                            <select id='personanatural_id' class='form-control' onchange="mostrar()" required='required' name='personanatural_id'></select>
                        </div>
                    </div>
                </div>-->
                <div class="col-md-12" style="margin-top: 40px;">
                    <?php echo Form::open(['route'=>'usuario.store','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                    <div class="form-group"><label class="col-sm-2 control-label text-right">Identificación del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('identificacion',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el número de identificación del usuario, con éste tendrá acceso al sistema','required','id'=>'identificacion']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Nombres del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('nombres',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba los nombres del usuario','required','id'=>'txt_nombres']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Apellidos del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::text('apellidos',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba los apellidos del usuario','required','id'=>'txt_apellidos']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">E-mail del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba el correo electrónico del usuario','required','id'=>'txt_email']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('grupos', 'Seleccione Estado del Usuario', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('estado',['ACTIVO'=>'ACTIVO','INACTIVO'=>'INACTIVO'],null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'-- Seleccione una opción --','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('grupos', 'Seleccione los Grupos o Roles de Usuarios', ['class' => 'col-sm-2 control-label text-right']); ?>

                        <div class="col-sm-10">
                            <?php echo Form::select('grupos[]',$grupos,null,['class'=>'form-control col-md-7 col-xs-12 chosen-select','placeholder'=>'-- Seleccione una opción --','required','multiple']); ?>

                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label text-right">Contraseña del Usuario</label>
                        <div class="col-sm-10">
                            <?php echo Form::password('password',['class'=>'form-control col-md-7 col-xs-12','required']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="<?php echo e(route('admin.usuarios')); ?>" class="btn btn-3d btn-danger">Cancelar</a>
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


    var vect = null;
    var vecte = null;
    var origen = false;

    function getPersona() {
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Alerta', 'Debe ingresar identificación para continuar...', 'warning');
        } else {
            $.ajax({
                type: 'GET',
                url: url + "academico/pnaturales/" + id + "/personaNaturals",
                data: {},
            }).done(function (msg) {
                var m = JSON.parse(msg);
                if (m.error === "NO") {
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                    vect = m.data1;
                    origen = true;
                    $("#personanatural_id").append("<option value='0'>-- Seleccione una opción --</option>");
                    $.each(m.data2, function (index, item) {
                        $("#personanatural_id").append("<option value='" + index + "'>" + item + "</option>");
                    });
                } else {
                    notify('Atención', m.msg, 'error');
                    $("#identificacion").val("");
                    $("#txt_nombres").val("");
                    $("#txt_apellidos").val("");
                    $("#txt_email").val("");
                }
            });
        }
    }

    function getEstudiante() {
        var id = $("#id").val();
        if (id.length === 0) {
            notify('Alerta', 'Debe ingresar identificación para continuar...', 'warning');
        } else {
            $.ajax({
                type: 'GET',
                url: url + "academico/agregarestudiante/" + id + "/estudiantes/estudianteByIdentificacion",
                data: {},
            }).done(function (msg) {
                var m = JSON.parse(msg);
                if (m.error === "NO") {
                    $('#personanatural_id option').each(function () {
                        $(this).remove();
                    });
                    vecte = m.data1;
                    origen = false;
                    $("#personanatural_id").append("<option value='0'>-- Seleccione una opción --</option>");
                    $.each(m.data2, function (index, item) {
                        $("#personanatural_id").append("<option value='" + index + "'>" + item + "</option>");
                    });
                } else {
                    notify('Atención', m.msg, 'error');
                    $("#identificacion").val("");
                    $("#txt_nombres").val("");
                    $("#txt_apellidos").val("");
                    $("#txt_email").val("");
                }
            });
        }
    }

    function mostrar() {
        $("#identificacion").val("");
        $("#txt_nombres").val("");
        $("#txt_apellidos").val("");
        $("#txt_email").val("");
        var id = $("#personanatural_id").val();
        if (origen) {
            //pn
            $.each(vect, function (index, item) {
                if (item.id == id) {
                    $("#identificacion").val(item.identificacion);
                    $("#txt_nombres").val(item.nombres);
                    $("#txt_apellidos").val(item.apellidos);
                    $("#txt_email").val(item.mail);
                }
            });
        } else {
            //est
            $.each(vecte, function (index, item) {
                if (item.personanatural.id == id) {
                    $("#identificacion").val(item.persona.numero_documento);
                    $("#txt_nombres").val(item.personanatural.primer_nombre + " " + item.personanatural.segundo_nombre);
                    $("#txt_apellidos").val(item.personanatural.primer_apellido + " " + item.personanatural.segundo_apellido);
                    $("#txt_email").val(item.persona.mail);
                }
            });
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>