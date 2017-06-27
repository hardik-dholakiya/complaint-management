<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CMS :: @yield('title')</title>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        body, html {
            height: 100%;
        }

        /* remove outer padding */
        .main .row {
            padding: 0px;
            margin: 0px;
        }

        /*Remove rounded coners*/

        nav.sidebar.navbar {
            border-radius: 0px;
        }

        nav.sidebar, .main {
            -webkit-transition: margin 200ms ease-out;
            -moz-transition: margin 200ms ease-out;
            -o-transition: margin 200ms ease-out;
            transition: margin 200ms ease-out;
        }

        /* Add gap to nav and right windows.*/
        .main {
            padding: 10px 10px 0 10px;
        }

        /* .....NavBar: Icon only with coloring/layout.....*/

        /*small/medium side display*/
        @media (min-width: 768px) {

            /*Allow main to be next to Nav*/
            .main {
                position: absolute;
                width: calc(100% - 40px); /*keeps 100% minus nav size*/
                margin-left: 40px;
                float: right;
            }

            /*lets nav bar to be showed on mouseover*/
            nav.sidebar:hover + .main {
                margin-left: 200px;
            }

            /*Center Brand*/
            nav.sidebar.navbar.sidebar > .container .navbar-brand, .navbar > .container-fluid .navbar-brand {
                margin-left: 0px;
            }

            /*Center Brand*/
            nav.sidebar .navbar-brand, nav.sidebar .navbar-header {
                text-align: center;
                width: 100%;
                margin-left: 0px;
            }

            /*Center Icons*/
            nav.sidebar a {
                padding-right: 13px;
            }

            /*adds border top to first nav box */
            nav.sidebar .navbar-nav > li:first-child {
                border-top: 1px #e5e5e5 solid;
            }

            /*adds border to bottom nav boxes*/
            nav.sidebar .navbar-nav > li {
                border-bottom: 1px #e5e5e5 solid;
            }

            /* Colors/style dropdown box*/
            nav.sidebar .navbar-nav .open .dropdown-menu {
                position: static;
                float: none;
                width: auto;
                margin-top: 0;
                background-color: transparent;
                border: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            /*allows nav box to use 100% width*/
            nav.sidebar .navbar-collapse, nav.sidebar .container-fluid {
                padding: 0 0px 0 0px;
            }

            /*colors dropdown box text */
            .navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
                color: #777;
            }

            /*gives sidebar width/height*/
            nav.sidebar {
                width: 200px;
                margin-left: -160px;
                float: left;
                z-index: 8000;
                margin-bottom: 0px;
            }

            /*give sidebar 100% width;*/
            nav.sidebar li {
                width: 100%;
            }

            /* Move nav to full on mouse over*/
            nav.sidebar:hover {
                margin-left: 0px;
            }

            /*for hiden things when navbar hidden*/
            .forAnimate {
                opacity: 0;
            }
        }

        /* .....NavBar: Fully showing nav bar..... */

        @media (min-width: 1330px) {

            /*Allow main to be next to Nav*/
            .main {
                width: calc(100% - 200px); /*keeps 100% minus nav size*/
                margin-left: 200px;
            }

            /*Show all nav*/
            nav.sidebar {
                margin-left: 0px;
                float: left;
            }

            /*Show hidden items on nav*/
            nav.sidebar .forAnimate {
                opacity: 1;
            }
        }

        nav.sidebar .navbar-nav .open .dropdown-menu > li > a:hover, nav.sidebar .navbar-nav .open .dropdown-menu > li > a:focus {
            color: #CCC;
            background-color: transparent;
        }

        nav:hover .forAnimate {
            opacity: 1;
        }

        section {
            padding-left: 15px;
        }
    </style>
    <script>
        function htmlbodyHeightUpdate() {
            var height3 = $(window).height();
            var height1 = $('.nav').height() + 50;
            height2 = $('.main').height();
            if (height2 > height3) {
                $('html').height(Math.max(height1, height3, height2) + 10);
                $('body').height(Math.max(height1, height3, height2) + 10);
            }
            else {
                $('html').height(Math.max(height1, height3, height2));
                $('body').height(Math.max(height1, height3, height2));
            }

        }
        $(document).ready(function () {
            htmlbodyHeightUpdate()
            $(window).resize(function () {
                htmlbodyHeightUpdate()
            });
            $(window).scroll(function () {
                height2 = $('.main').height()
                htmlbodyHeightUpdate()
            });
        });

    </script>
    @yield('header-include')
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/admin') }}">
                {{ config('app.name', 'Laravel Multi Auth Guard') }}: Admin
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
                @if (Auth::guard('admin')->user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::guard('admin')->user()->first_name}} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('change-password')}}">Change Password</a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ url('/admin/login') }}">Login</a></li>
                    <li><a href="{{ url('/admin/register') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@if (Auth::guard('admin')->user())
    <nav class="navbar navbar-inverse sidebar" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-sidebar-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('dashboard')}}">Home<span style="font-size:16px;"
                                                                                  class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a>
                    </li>
                    <li><a href="{{route('complaints-list')}}">Complaint List<span style="font-size:16px;"
                                                                                   class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a>
                    </li>
                    <li><a href="{{route('user-list')}}">User List<span style="font-size:16px;"
                                                                        class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    </li>
                    <li><a href="{{route('admin-list')}}">Admin User List<span style="font-size:16px;"
                                                                               class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    </li>
                    {{--                       <li class="dropdown">
                                               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
                                               <ul class="dropdown-menu forAnimate" role="menu">
                                                   <li><a href="#">Action</a></li>
                                                   <li><a href="#">Another action</a></li>
                                               </ul>
                                           </li>
                    --}}
                </ul>
            </div>
        </div>
    </nav>
@endif
<div class="col-lg-8 main-content">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
