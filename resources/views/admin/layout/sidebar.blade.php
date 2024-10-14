<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link d-flex justify-content-center">
        <img src="Asset/Image/LOGO.png" alt="Bucki Logo" style="width: 20%; display: block;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="Asset/Image/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Administrator</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- report --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/report/products') }}" class="nav-link active">

                        <p>View Reports</p>
                    </a>
                </li>

                {{-- product management --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <p>
                            Product Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/products/create') }}"
                                class="nav-link {{ request()->is('admin/products/create') ? 'active' : '' }}">
                                {{-- active dòng đang chọn --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/products/view') }}"
                                class="nav-link {{ request()->is('admin/products/view') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Product</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Category Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/categories') }}" class="nav-link active">

                        <p>Category Management</p>
                    </a>
                </li>

                {{-- Category Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/brands') }}" class="nav-link active">

                        <p>Brand Management</p>
                    </a>
                </li>

                {{-- blueprint Management --}}
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link active">
                        <p>
                            Blueprint Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/blueprints/create') }}"
                                class="nav-link {{ request()->is('admin/blueprints/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Blueprint</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/blueprints/view') }}"
                                class="nav-link {{ request()->is('admin/blueprints/view') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Blueprint</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Customer Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/customers') }}" class="nav-link active">
                        <p>Customer Management</p>
                    </a>
                </li>
                {{-- Designer Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/designers') }}" class="nav-link active">
                        <p>Designer Management</p>
                    </a>
                </li>
                {{-- Order Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/orders') }}" class="nav-link active">
                        <p>Order Management</p>
                    </a>
                </li>
                {{-- review order --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/review_orders') }}" class="nav-link active">

                        <p>Review Order</p>
                    </a>
                </li>
                {{-- Consultation Management --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/consultations') }}" class="nav-link active">

                        <p>Consultation Management</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
