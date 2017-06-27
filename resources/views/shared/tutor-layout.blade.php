<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    @yield('customMetas')

    <title>@yield('title') - TMS-Plus</title>

    <script src="{{ asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap & Materialize core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for custom styles     -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

    <div class="wrapper">
        <!-- Left sidebar -->
        <!-- ------------ -->
        <div class="sidebar" data-color="blue" data-image="{{ asset('img/sidebar-3.jpg') }}">
            <div class="logo">
                <a href="{{ url('/dashboard') }}" class="simple-text">
                    TMS - Plus
                </a>
            </div>

            <div class="sidebar-wrapper">
                <ul class="nav sidebar-menu">
                    <li {{ ($menu == 'dashboard')? 'class=active' : '' }}>
                        <a href="{{ url('/dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li {{ ($menu == 'profile')? 'class=active' : '' }}>
                        <a href="{{ url('/profile-setup') }}">
                            <i class="material-icons">person</i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li {{ ($menu == 'subjects')? 'class=active' : '' }}>
                        <a href="{{ url('/subjects') }}">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <p>Subjects</p>
                        </a>
                    </li>
                    <li {{ ($menu == 'students')? 'class=active' : '' }}>
                        <a href="{{ url('/students') }}">
                            <i class="material-icons">people</i>
                            <p>Students</p>
                        </a>
                    </li>
                    <li {{ ($menu == 'lessons')? 'class=active' : '' }}>
                        <a href="{{ url('/lessons') }}">
                            <i class="material-icons">schedule</i>
                            <p>Manage Lessons</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Panel -->
        <!-- ---------- -->
        <div class="main-panel">
            <!-- Navigation Bar -->
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/dashboard') }}">
                            Welcome, {{ Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name }}
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                    {{--<i class="material-icons">notifications</i>--}}
                                    {{--<span class="notification">5</span>--}}
                                    {{--<p class="hidden-lg hidden-md">Notifications</p>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu">--}}
                                    {{--<li><a href="#">Mike John responded to your email</a></li>--}}
                                    {{--<li><a href="#">You have 5 new tasks</a></li>--}}
                                    {{--<li><a href="#">You're now friend with Andrew</a></li>--}}
                                    {{--<li><a href="#">Another Notification</a></li>--}}
                                    {{--<li><a href="#">Another One</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">power_settings_new</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('tutor.edit') }}">Profile</a></li>
                                        <li class="divider"></li>
                                        <li>
                                            <form action="/logout" method="post" id="logout-form">
                                                {{ csrf_field() }}
                                            </form>
                                            <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
                                        </li>
                                    </ul>
                                </a>

                            </li>
                        </ul>

                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i><div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('body')
                </div>
            </div>

            <!-- Page Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        Copyright &copy; <script>document.write(new Date().getFullYear())</script> | TMS Plus
                    </p>
                </div>
            </footer>
        </div>
    </div>

</body>

<!--   Core JS Files   -->
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>

<!-- List group Plugin -->
<script src="https://cdn.jsdelivr.net/bootstrap.listgroup/1.1.2/listgroup.min.js"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- Material Dashboard javascript methods -->
<script src="{{ asset('js/material-dashboard.js') }}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/dashboard.js') }}"></script>

<!-- Scripts from views -->
@yield('scripts')

</html>
