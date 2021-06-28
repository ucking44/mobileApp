<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('asset/dist/img/all.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Ecom Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('asset/dist/img/twitter.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><b>Uc King</b></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ URL::to('/dashboard') }}" class="nav-link {{ Request::is('/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ Request::is('category*') ? 'menu-open' : '' }}">
                    {{-- <a href="#" class="nav-link {{ Request::is('master/vendor*') ? 'active' : '' }}"> --}}
                    <a href="#" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/add-category') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/all-category') }}" class="nav-link active {{ Request::is('category*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('service-category*') ? 'menu-open' : '' }}">
                    {{-- <a href="#" class="nav-link {{ Request::is('master/vendor*') ? 'active' : '' }}"> --}}
                    <a href="#" class="nav-link {{ Request::is('service-category*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Service Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/create/service-category') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Service Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/service-category') }}" class="nav-link active {{ Request::is('service-category*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Service Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('services*') ? 'menu-open' : '' }}">
                    {{-- <a href="#" class="nav-link {{ Request::is('master/vendor*') ? 'active' : '' }}"> --}}
                    <a href="#" class="nav-link {{ Request::is('services*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Services
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/create/service') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Service</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/service') }}" class="nav-link active {{ Request::is('services*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Services</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('slider*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('slider*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Slider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/create/slider') }}" class="nav-link {{ Request::is('slider*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/sliders') }}" class="nav-link {{ Request::is('slider*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('manufacture*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('manufacture*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manufacture
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/add-manufacture') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Manufacture</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/all-manufacture') }}" class="nav-link active {{ Request::is('manufacture*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Manufactures</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('product*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('product*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/add-product') }}" class="nav-link {{ Request::is('product*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/all-product') }}" class="nav-link {{ Request::is('product*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('blogs*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/create/blogs') }}" class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/blogs') }}" class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Blog Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('appointment*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('appointment*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Appointment
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/appointment') }}" class="nav-link {{ Request::is('appointment*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Appointment</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('admin/register*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/register*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Register Role
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/role-register') }}" class="nav-link {{ Request::is('admin/register*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('admin/aboutus*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/aboutus*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            About Us
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/create/aboutus') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/aboutus') }}" class="nav-link active {{ Request::is('admin/aboutus*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('admin/contact-us*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/contact-us*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Contact Us
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/contact-us') }}" class="nav-link {{ Request::is('admin/contact-us*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Contacts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Request::is('stock/report*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('stock/report*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Reports
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('stock/report*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Reports</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ Request::is('stock/report*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Stock Reports</p>
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
