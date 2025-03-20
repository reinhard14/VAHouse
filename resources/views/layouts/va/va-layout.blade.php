<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VA House</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Sweetalert Styling -->
    <link rel="stylesheet" href="{{ asset('dist/css/sweetalert.css') }}">
    <!-- Custom Styling -->
    <link rel="stylesheet" href="{{ asset('dist/css/customcss.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css') }}">
    <!-- Show password -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- CDN Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="bi bi-bell-fill"></i>
                    </a>
                </li>
                <li class="nav-item dropdown mr-5 pr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('user.dashboard') }}" class="brand-link pl-4">
                <img src="{{ asset('dist/img/nav-logo.png') }}" alt="VA House Logo" height="23px" width="55px">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class=" mt-3 pb-3 mb-3 d-flex">

                </div>

            <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item orange-active">
                            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->segment(2) === 'dashboard' ? 'active' : '' }}">
                            <i class="bi bi-file-bar-graph"></i>
                            <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="orange-active nav-item {{ in_array(request()->segment(2), ['edit-profile', 'view-profile']) ? 'menu-open' : 'menu' }}">
                            <a href="#" class="nav-link">
                                <i class="bi bi-tools"></i>
                            <p>My Information
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item light-orange-active" >
                                    <a href="{{ route('user.edit', $user->id) }}" class="nav-link {{ request()->segment(2) === 'edit-profile' ? 'active' : '' }}">
                                        <i class="bi bi-person-fill"></i>
                                        <p>Edit Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item light-orange-active" >
                                    <a href="{{ route('user.show', $user->id) }}" class="nav-link {{ request()->segment(2) === 'view-profile' ? 'active' : '' }}">
                                        <i class="bi bi-person-fill"></i>
                                        <p>View Profile</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            <!-- /.sidebar-menu -->

            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content -->
        {{-- @include('includes.messages') --}}

        @yield('content')
        <!-- End Content -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong class="text-orange">Copyright &copy; {{ \Carbon\Carbon::now()->year }}
                <a href="#" class=" text-orange" data-toggle="tooltip" data-placement="top" title="Developed by: Reinhard">VA House Corporation Management System</a>.
            </strong>
            <span class="text-orange">
                All rights reserved.
            </span>

            <div class="float-right d-none d-sm-inline-block text-orange">
                <b>Version</b> 2.0.0
            </div>
        </footer>
    </div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->

<!-- Sweetalert Actions-->
<script src="{{ asset('dist/js/sweetalert.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Poppers -->
<script src="{{ asset('plugins/popper/popper.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/pages/global.js') }}"></script>
<!-- AJAX Saving Employment details-->
<script src="{{ asset('dist/js/ajax/user/employment-details.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- Ion Icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!-- Show password -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
</html>

