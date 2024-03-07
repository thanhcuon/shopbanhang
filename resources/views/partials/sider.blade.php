<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <div class="info">
                    @auth
                        <a href="#" class="d-block">
                            Chào mừng, {{ auth()->user()->name }}
                        </a>
                    @else
                        <a href="#" class="d-block">
                            Chào mừng, Khách
                        </a>
                    @endauth
                </div>
            </div>
        </div>



        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh mục sản phẩm
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('menus.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Menus

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('brands.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            thương hiệu

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách sản phẩm

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('slider.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Slider

                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('settings.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Settings

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('posts.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Posts

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                           Order

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách nhân viên

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh sách vai trò(roles)

                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('logout_admin') }}" class="d-block">Logout</a>
            </div>
        </div>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
