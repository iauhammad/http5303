<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>TMS - Plus</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">

    <!-- JS -->
    <script src="{{ asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
    <style>
        body {
            margin-top: 0 !important;
        }
    </style>
</head>
<body>
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="/" class="brand-logo">TMS - Plus</a>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            @if(Sentinel::check())
                <li>
                    <a class="dropdown-button" href="#!" data-activates="logged_user">
                        Welcome, {{ Sentinel::getUser()->display_name }}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <ul id="logged_user" class="dropdown-content">
                    <li><a href="/admin">Dashboard</a></li>
                    <li class="divider"></li>
                    <li>
                        <form action="/logout" method="post" id="logout-form">
                            {{ csrf_field() }}
                        </form>
                        <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
                    </li>
                </ul>
            @else
                <li><a href="/login">Log in</a></li>
                <li><a href="/register">Register</a></li>
            @endif
        </ul>
        <ul class="side-nav" id="mobile-menu">
            <li><a href="/">Home</a></li>
            @if(Sentinel::check())
                <li>
                    <a class="dropdown-button" href="#!" data-activates="loggedUser">
                        Welcome, {{ Sentinel::getUser()->display_name }}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <ul id="loggedUser" class="dropdown-content">
                    <li><a href="/admin">Dashboard</a></li>
                    <li class="divider"></li>
                    <li>
                        <form action="/logout" method="post" id="logout-form">
                            {{ csrf_field() }}
                        </form>
                        <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
                    </li>
                </ul>
            @else
                <li><a href="/login">Log in</a></li>
                <li><a href="/register">Register</a></li>
            @endif
        </ul>
    </div>
</nav>

<main>
    @yield('body')
</main>

<footer class="page-footer teal">
    <div class="footer-copyright">
        <div class="container">
            Copyright &copy; 2017 - TMS Plus | Irfaan Auhammad
        </div>
    </div>
</footer>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".button-collapse").sideNav();
        $(".dropdown-button").dropdown();
    });
</script>
</body>
</html>