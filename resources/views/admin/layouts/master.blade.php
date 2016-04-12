<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helpdesk</title>

    <link href="{{ url('/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ url('/admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ url('/admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ url('/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/trumbowyg/dist/ui/trumbowyg.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/dataTables.bootstrap.css') }}"> -->

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/css/dataTables.bootstrap.css') }}">

    @yield('styles')

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ url('/admin/img/profile_small.jpg') }}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> </span> </a>
                        </div>
                        <div class="logo-element">
                            HD
                        </div>
                    </li>
                    <li class="@yield('home')">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
                    </li>
                    @if (Auth::user()->role == 0)
                        <li class="@yield('users')">
                            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/users') }}">Users List</a></li>
                                <li><a href="{{ url('/users/create') }}">Add a user</a></li>
                            </ul>
                        </li>
                        <li class="@yield('projects')">
                            <a href="#"><i class="fa fa-folder"></i> <span class="nav-label">Projects</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('/projects') }}">Projects List</a></li>
                                <li><a href="{{ url('/projects/create') }}">Add a Project</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->accessLevel == 1 && Auth::user()->role != 0)
                        <li class="@yield('projects')">
                            <a href="{{ url('/projects/mills-parasols') }}"><i class="fa fa-folder"></i> <span class="nav-label">Mills Parasols</span></a>
                        </li>
                    @elseif (Auth::user()->accessLevel == 2 && Auth::user()->role != 0)
                        <li class="@yield('projects')">
                            <a href="{{ url('/projects/liikenhealth') }}"><i class="fa fa-folder"></i> <span class="nav-label">LiikenHealth</span></a>
                        </li>
                    @elseif (Auth::user()->accessLevel == 0 && Auth::user()->role != 0)
                        <li class="@yield('mills')">
                            <a href="{{ url('/projects/mills-parasols') }}"><i class="fa fa-folder"></i> <span class="nav-label">Mills Parasols</span></a>
                        </li>
                        <li class="@yield('liiken')">
                            <a href="{{ url('/projects/liikenhealth') }}"><i class="fa fa-folder"></i> <span class="nav-label">LiikenHealth</span></a>
                        </li>
                    @endif
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            @yield('content')
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ url('/admin/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ url('/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ url('/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ url('/admin/js/plugins/peity/jquery.peity.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ url('/admin/js/inspinia.js') }}"></script>
    <script src="{{ url('/admin/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ url('/admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ url('/admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <script src="{{ url('/admin/js/jquery.dataTables.js') }}"></script>
    <!-- <script src="/admin/js/jquery.bootstrap.js"></script> -->
    <!-- SlimScroll -->
    <script src="{{ url('/admin/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('/bower_components/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ url('/bower_components/trumbowyg/dist/trumbowyg.min.js') }}"></script>

    @yield('scripts')

</body>

</html>
