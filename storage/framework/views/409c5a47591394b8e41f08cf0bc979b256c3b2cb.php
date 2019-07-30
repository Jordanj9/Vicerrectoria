<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'UPC')); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css')); ?>"/>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style2.css')); ?>">
        <link rel="shortcut icon" href="<?php echo e(asset('img/upclogo.png')); ?>">
    </head>
    <body>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <?php echo e(config('app.name', 'UPC')); ?>

                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Ingresar al Sistema</a></li>
                            <li><a href="<?php echo e(url('/')); ?>">Regresar</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <center>
                            <img style="width: 250px;" src="<?php echo e(asset('img/logocesar.png')); ?>"/><br/><br/>
                        </center>
                    </div>
                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row bort">
                    <div class="copyright">
                            © 2019 UPC. Todos los Derechos Reservados.
                            <div class="credits">Desarrollado por <a href="https://www.facebook.com">Alberto Rojas</a>
                            </div>
                        </div>
                </div>
            </div>
        </footer>
        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>