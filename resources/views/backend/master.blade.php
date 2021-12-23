<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard 2</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    </head>

    <body class="hold-transition     sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                    width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
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
                <a href="index3.html" class="brand-link">
                    <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    {{-- <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                               
                                <li class="nav-item">
                                    <a href="./index2.html" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li> --}}
                            <li class="nav-item">
                                <a href="{{route('Frontendhome')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('dashboard.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/widgets.html" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>
                            @can('View Category')
                            <li class="nav-item @yield('cat_dropdown_active') ">
                                <a href="#" class="nav-link @yield('cat_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Catagory
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('View Category')

                                    <li class="nav-item">
                                        <a href="{{route('catagory.index')}}"
                                            class="nav-link  @yield('cat_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Catagory</p>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('Create Category')
                                    <li class="nav-item">
                                        <a href="{{route('catagory.create')}}"
                                            class="nav-link @yield('cat_add-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Catagory</p>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('View Sub-Category')
                            <li class="nav-item @yield('sub-cat_dropdown_active')">
                                <a href="#" class="nav-link @yield('subcat_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Sub-Catagory
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('View Sub-Category')
                                    <li class="nav-item">
                                        <a href="{{route('subcatagory.index')}}"
                                            class="nav-link @yield('subcat_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View SubCatagory</p>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('Create Sub-Category')
                                    <li class="nav-item">
                                        <a href="{{route('subcatagory.create')}}"
                                            class="nav-link @yield('subcat_add-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add SubCatagory</p>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('View Product')
                            <li class="nav-item @yield('product_dropdown_active')">
                                <a href="#" class="nav-link @yield('product_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Product
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('View Product')
                                    <li class="nav-item">
                                        <a href="{{route('products.index')}}"
                                            class="nav-link @yield('product_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Products</p>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('Create Product')
                                    <li class="nav-item">
                                        <a href="{{route('products.create')}}"
                                            class="nav-link @yield('product_add-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Product</p>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @if (auth()->user()->can('View Color') || auth()->user()->can('View Size'))
                            <li class="nav-item @yield('color-size_dropdown_active')">
                                <a href="#" class="nav-link @yield('color-size_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Colors & Sizes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('View Color')
                                    <li class="nav-item">
                                        <a href="{{route('color.index')}}" class="nav-link @yield('color_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Colors</p>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('View Size')
                                    <li class="nav-item">
                                        <a href="{{route('size.index')}}" class="nav-link @yield('size_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Sizes</p>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endif
                            @can('View Coupon')

                            <li class="nav-item">
                                <a href="{{route('coupons.index')}}" class="nav-link  @yield('coupon_active')">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Coupons
                                    </p>
                                </a>
                            </li>
                            @endcan

                            @can('View Role')

                            <li class="nav-item @yield('role_dropdown_active')">
                                <a href="#" class="nav-link @yield('role_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Role Managements
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('Create Role')
                                    <li class="nav-item">
                                        <a href="{{route('roles.create')}}" class="nav-link @yield('add_role-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Role</p>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('View Role')
                                    <li class="nav-item">
                                        <a href="{{route('roles.index')}}" class="nav-link @yield('role_view-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Role</p>
                                        </a>
                                    </li>
                                    @endcan
                                    <li class="nav-item">
                                        <a href="{{route('AssignUser')}}" class="nav-link @yield('assign_user_active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Assign User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('CreateUser')}}" class="nav-link @yield('add_user_active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add User</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            @endcan
                            <li class="nav-item @yield('blog_dropdown_active')">
                                <a href="#" class="nav-link @yield('blog_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Blogs
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('blogs.create')}}" class="nav-link @yield('add_blog-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Create Blog</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('blogs.index')}}" class="nav-link @yield('view_blog-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View Blogs</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item @yield('blog_dropdown_active')">
                                <a href="#" class="nav-link @yield('blog_active')">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Order
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    {{-- <li class="nav-item">
                                    <a href="{{route('orders.create')}}" class="nav-link @yield('add_blog-active')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Blog</p>
                                    </a>
                            </li> --}}

                            <li class="nav-item">
                                <a href="{{route('orders.index')}}" class="nav-link @yield('view_order-active')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Order</p>
                                </a>
                            </li>

                        </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                onclick="event.preventDefault();document.getElementById('from_logout').submit()"
                                href="{{ route('logout') }}"><i class="fa fa-key"></i>Log
                                out</a>
                        </li>
                        <form id="from_logout" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        </ul>
                        </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            @yield('content')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0-rc
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
        <script src="{{asset('backedn/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('backend/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
        <script src="{{asset('backend/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{asset('backend/dist/js/demo.js')}}"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>
        @yield('script_js')
    </body>

</html>