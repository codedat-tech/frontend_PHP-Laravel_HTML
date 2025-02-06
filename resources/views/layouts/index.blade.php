<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('/') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('Asset/css/home.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('Asset/css/interior-design.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('Asset/css/designer.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- Header -->
    @include('layouts.header')


    <!--content-->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

</body>

</html>
