<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') - TMS-Plus</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <header class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">TMS Plus</a>
            </div>
            <nav class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    @if(Sentinel::check())
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Sentinel::getUser()->display_name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/profile">Profile</a></li>
                                <li><a href="/settings">Settings</a></li>
                                <li class="divider"></li>
                                <li>
                                    <form action="/logout" method="post" id="logout-form">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="/login">Log in</a></li>
                        <li><a href="/register">Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('body')
        </div>
    </main>

    <footer class="footer">
        <div class="container">Copyright &copy; 2017 | TMS Plus</div>
    </footer>

</body>
</html>