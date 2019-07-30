<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UPC') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}">
        <link rel="shortcut icon" href="{{asset('img/upclogo.png')}}">
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
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'UPC') }}
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
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Ingresar al Sistema</a></li>
                            <li><a href="{{ url('/') }}">Regresar</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <center>
                            <img style="width: 250px;" src="{{asset('img/logocesar.png')}}"/><br/><br/>
                        </center>
                    </div>
                </div>
            </div>
            @yield('content')
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
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>