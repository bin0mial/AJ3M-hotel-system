<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title") | {{ config()->get("app.name", "AJ3M Hotel System") }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    @yield("styles")
</head>

<body class="hold-transition sidebar-mini">
    @php($currentRoute = Route::currentRouteName())
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route("admin.dashboard") }}" class="nav-link">Home</a>
                </li>


            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           event.stopPropagation();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="d-flex justify-content-center">
                <a href="{{ route("admin.dashboard") }}" class="brand-link">
                    <img src="{{ asset("images/logo/AJ3M Logo.png") }}" alt="AdminLTE Logo"
                        style="width: 150px; height: 150px; filter:drop-shadow(0px 0px 4px #060d1a)">
                </a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ Auth::user()->avatar_image }}" class="img-circle elevation-2" style="width: 50px; height: 50px" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route("users.edit", Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        @php($active = str_starts_with($currentRoute, "admin.dashboard"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link @if($active) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("admin.dashboard") }}" class="nav-link {{$currentRoute=="admin.dashboard"?"active": ""}}">
                                        <i class="fa fa-home nav-icon"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @hasanyrole("admin")
                        @php($currentRoute = Route::currentRouteName())
                        @php($active = str_starts_with($currentRoute, "managers"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link  @if($active) active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Manager Control
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('managers.index')}}" class="nav-link {{$currentRoute=="managers.index"?"active": ""}}">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>All Managers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('managers.create')}} " class="nav-link {{$currentRoute=="managers.create"?"active": ""}}">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>Create Manager</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        {{-- RECEPTCINIST --}}
                         @hasanyrole('admin|manager')
                        @php($active = str_starts_with($currentRoute, "receptionists"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link @if($active) active @endif">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Receptionist Control
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('receptionists.index')}}" class="nav-link {{$currentRoute=="receptionists.index"?"active": ""}}">
                                        <i class="fas fa-stream"></i>
                                        <p>All receptionists</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('receptionists.create')}} " class="nav-link {{$currentRoute=="receptionists.create"?"active": ""}}">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Create receptionist</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- FLOORS CONTROLL --}}
                        @php($currentRoute = Route::currentRouteName())
                        @php($active = str_starts_with($currentRoute, "floors"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link  @if($active) active @endif">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>
                                    Manage Floors
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('floors.index')}}" class="nav-link {{$currentRoute=="floors.index"?"active": ""}}">
                                        <i class="fas fa-list-ul"></i>
                                        <p>All Floors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('floors.create')}} " class="nav-link {{$currentRoute=="floors.create"?"active": ""}}">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Create Floor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ROOMS CONTROLL --}}
                        @php($currentRoute = Route::currentRouteName())
                        @php($active = str_starts_with($currentRoute, "rooms"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link  @if($active) active @endif">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Manage Rooms
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rooms.index')}}" class="nav-link {{$currentRoute=="rooms.index"?"active": ""}}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>All Rooms</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('rooms.create')}} " class="nav-link {{$currentRoute=="rooms.create"?"active": ""}}">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Create Room</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        {{-- CLIENT  --}}
                        @hasanyrole('admin|manager|receptionists')
                        @php($currentRoute = Route::currentRouteName())
                        @php($active = str_starts_with($currentRoute, "client"))
                        <li class="nav-item menu-{{$active? "open": "close"}}">
                            <a href="#" class="nav-link @if($active) active @endif">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>
                                    Client Control
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('client.index')}}" class="nav-link {{$currentRoute=="client.index"?"active": ""}}">
                                        <i class="fas fa-check-double"></i>
                                        <p>Approved Clients</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('client.reservation')}} " class="nav-link {{$currentRoute=="client.reservation"?"active": ""}}">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Clients Reservations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{route('client.pending')}} " class="nav-link {{$currentRoute=="client.pending"?"active": ""}}">
                                        <i class="fas fa-pause-circle"></i>
                                        <p>Pending Clients</p>
                                    </a>
                                </li>

                                @endhasanyrole
                            </ul>
                        </li>
                        {{-- @endhasanyrole --}}
                        {{-- @endrole --}}
                        {{-- @endrole --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('page-header')
            <!-- /.content-header -->

            <!-- Main content -->

            @if(session()->has("warning"))
                <div class="alert alert-warning">
                    <ul>
                        @foreach (session()->get("warning") as $warning)
                            <li>{!! $warning !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has("error"))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session()->get("error") as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has("success"))
                <div class="alert alert-success">
                    <ul>
                        @foreach (session()->get("success") as $success)
                            <li>{!! $success !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield("content")

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ now()->year }} <a
                    href="https://github.com/bin0mial/AJ3M-hotel-system">{{ config()->get('app.name') }}</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
    <script>
        const deleteButton = (url, name, table) => {
            if (confirm(`Are you sure you want to delete ${name}, permanently`)){
                const data = {
                    _method: "DELETE",
                    _token: "{{ csrf_token() }}"
                }
                $.ajaxSetup({
                    url: url,
                    global: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST"
                });

                $.ajax({
                    type: "POST",
                    data: data,
                    success: function () {
                        $(`#${table}-table`).DataTable().ajax.reload(null, false);
                    },
                    error: function (jqXhr){
                        alert(jqXhr.responseText)
                    },
                });
            }
        }
    </script>
</body>

</html>
