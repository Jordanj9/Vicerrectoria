<?php $__env->startSection('content'); ?>
<div class="panel">
    <div class="panel-body">
        <div class="col-md-6 col-sm-12">
            <h3 class="animated fadeInLeft">Bienvenido <?php echo e(Auth::user()->name); ?> a la Plataforma para La Evaluación Académica de la Universidad Popular del Cesar UPC</h3>
            <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Valledupar - Cesar</p>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="col-md-6 col-sm-6 text-right" style="padding-left:10px;">
                <h3 style="color:#DDDDDE;"><span class="fa  fa-map-marker"></span> Valledupar</h3>

            </div>
            <div class="col-md-6 col-sm-6">
                <div class="wheather">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="row">
        <?php if(session()->exists('MOD_INICIO')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-blue-grey box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('inicio')); ?>"><i class="fa fa-home"></i> INICIO</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_USUARIOS')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-primary box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.usuarios')); ?>"><i class="fa fa-user"></i> USUARIOS</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_ADMISIONES')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-pink box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.admisiones')); ?>"><i class="fa fa-check-circle"></i> ADMISIONES</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_ACADEMICO-ADMINISTRADOR')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-teal box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.academico')); ?>"><i class="fa fa-book"></i> ACADÉMICO</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_TESORERIA')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-indigo box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.tesoreria')); ?>"><i class="fa fa-money"></i> TESORERÍA</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_REPORTES')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-purple box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.reportes')); ?>"><i class="fa fa-list"></i> REPORTES</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_ACADEMICO-ESTUDIANTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-teal box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.academicoestudiante')); ?>"><i class="fa fa-book"></i> ACADÉMICO</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_MATRICULA-ESTUDIANTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-pink box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.matricula')); ?>"><i class="fa fa-check-circle"></i> MATRÍCULA</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_FINANCIERA-ESTUDIANTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-primary box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.financiera')); ?>"><i class="fa fa-dollar"></i> FINANCIERA</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_AULA-VIRTUAL-ESTUDIANTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-orange box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.aulavirtualest')); ?>"><i class="fa fa-cloud"></i> AULA VIRTUAL</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_ACADEMICO-DOCENTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-teal box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.academicodocente')); ?>"><i class="fa fa-book"></i> ACADÉMICO</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_MATRICULA-DOCENTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-dark-pink box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.matriculadocente')); ?>"><i class="fa fa-check-circle"></i> MATRÍCULA</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_AULA-VIRTUAL')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-orange box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.aulavirtual')); ?>"><i class="fa fa-cloud"></i> AULA VIRTUAL</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session()->exists('MOD_AULA-VIRTUAL-DOCENTE')): ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-primary box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.aulavirtualdoc')); ?>"><i class="fa fa-cloud"></i> AULA VIRTUAL</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--        <?php if(session()->exists('MOD_RESERVA-RECURSO')): ?>
                <div class="col-sm-6 col-md-3">
                    <div class="panel bg-success box-shadow-none">
                        <div class="panel-body">
                            <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.reservarecurso')); ?>"><i class="fa fa-list-alt"></i> RESERVA RECURSO</a></h4></center>
                        </div>
                    </div>
                </div>
                <?php endif; ?>-->
        <div class="col-sm-12 col-md-4">
            <div class="panel bg-teal box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('usuario.vistacontrasenia')); ?>"><i class="fa fa-key"></i> CAMBIAR CONTRASEÑA</a></h4></center>
                </div>
            </div>
        </div>
        <?php if(session()->exists('MOD_EVALUACION-AUTO-HETERO')): ?>
        <div class="col-sm-6 col-md-5">
            <div class="panel bg-success box-shadow-none">
                <div class="panel-body">
                    <center><h4 class="text-white"><a class="text-white" href="<?php echo e(route('admin.evaluacionautohetero')); ?>"><i class="fa fa-check-circle-o"></i> EVALUACIÓN ACADÉMICA</a></h4></center>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-6 col-md-3">
            <div class="panel bg-red box-shadow-none">
                <div class="panel-body">
                    <center>
                        <h4 class="text-white">
                            <a class="text-white" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> SALIR</a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </h4>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>