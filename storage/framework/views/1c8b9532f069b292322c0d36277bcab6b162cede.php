<?php $__env->startSection('content'); ?>
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuarios - Menú Usuarios del Sistema</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo e(route('inicio')); ?>">Inicio</a> <span class="fa-angle-right fa"></span> Módulo Usuarios
            </p>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MENÚ USUARIOS DEL SISTEMA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="alert alert-success alert-raised alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Agregue usuarios al sistema y administre sus privilegios, gestione los usuarios, configure los grupos de usuarios, así como también los módulos del sistema, entre otras tareas.
                </div>
            </div>
            <div class="col-md-12">
                <?php if(session()->exists('PAG_MODULOS')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('modulo.index')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Módulos del sistema</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_PAGINAS')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('pagina.index')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Páginas del sistema</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_GRUPOS-ROLES')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('grupousuario.index')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Grupos de Usuarios</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_PRIVILEGIOS')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('grupousuario.privilegios')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Privilegios a Páginas</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_USUARIOS')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('usuario.index')); ?>" class="btn ripple btn-3d btn-primary" data-toggle="tooltip" title="Tenga en cuenta que al cargar gran cantidad de registros puede hacer que el navegador se bloquee y deba esperar a que este cargue todos los registros de la base de datos para continuar la navegación.">
                        <div>
                            <span>Listar Todos los Usuarios</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_USUARIO-MANUAL')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('usuario.create')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Usuario Manual</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_AUTOMATICO')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('usuario.vistaestudiante')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Estudiantes a Usuarios (Automático)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
                <?php if(session()->exists('PAG_DOCENTE-CONVERTIR-AUTOMATICO')): ?>
                <div class="col-md-4" style="margin-top: 30px;">
                    <a href="<?php echo e(route('usuario.vistadocente')); ?>" class="btn ripple btn-3d btn-primary">
                        <div>
                            <span>Docentes a Usuarios (Automático)</span>
                            <span class="ink animate" style="height: 87px; width: 87px; top: -37.5px; left: 53.5px;"></span></div>
                    </a>   
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if(session()->exists('PAG_OPERACIONES-USUARIO')): ?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>MODIFICACIÓN, ELIMINACIÓN DE USUARIOS Y CAMBIO DE CONTRASEÑA</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php echo Form::open(['route'=>'usuario.operaciones','method'=>'POST','class'=>'form-horizontal form-label-left']); ?>

                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php echo Form::text('id',null,['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Escriba la identificación a consultar','id'=>'id']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo Form::submit('Consultar Usuario',['class'=>'btn btn-3d btn-success btn-block']); ?>

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>