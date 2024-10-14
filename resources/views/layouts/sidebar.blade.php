<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <base href="{{asset('/')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('css/app.css')}}">

</head>

<body>

    <aside class="sidebar">
        <h2 class="h5">Bucki Admin</h2>
        <ul class="list-unstyled">
            <li>
                <a class="dropdown-item" href="{{ url('/admin/report/products') }}">
                    <i class="icon fas fa-th-list"></i> Dashboard
                </a>
            </li>
            <li>
                <a class="dropdown-item" data-bs-toggle="collapse" href="#collapseProductManagement" role="button" aria-expanded="false" aria-controls="collapseProductManagement">
                    <i class="icon fas fa-box"></i> Product Management
                </a>
                <ul class="collapse" id="collapseProductManagement">
                    <li><a class="dropdown-item" href="{{ url('admin/products/view') }}">View Products</a></li>
                    <li><a class="dropdown-item" href="{{ url('admin/products/create') }}">Add Product</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/categories') }}">
                    <i class="icon fas fa-th-list"></i> Category Management
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/brands') }}">
                    <i class="icon fas fa-tags"></i> Brand Management
                </a>
            </li>
            <li>
                <a class="dropdown-item" data-bs-toggle="collapse" href="#collapseBlueprintManagement" role="button" aria-expanded="false" aria-controls="collapseBlueprintManagement">
                    <i class="icon fas fa-drafting-compass"></i> Blueprint Management
                </a>
                <ul class="collapse" id="collapseBlueprintManagement">
                    <li><a class="dropdown-item" href="{{ url('admin/blueprints/view') }}">View</a></li>
                    <li><a class="dropdown-item" href="{{ url('admin/blueprints/create')}}">Add Blueprint</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/customers') }}">
                    <i class="icon fas fa-th-list"></i> Customer Management
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/designers') }}">
                    <i class="icon fas fa-th-list"></i> Designer Management
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/orders') }}">
                    <i class="icon fas fa-th-list"></i> Order Management
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/review_orders') }}">
                    <i class="icon fas fa-th-list"></i> Review Order
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('admin/consultations') }}">
                    <i class="icon fas fa-th-list"></i> Consultation Management
                </a>
            </li>
        </ul>
    </aside>

    <div class="main-content">
        @yield('content')
    </div>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('script-section')
</body>

</html>
