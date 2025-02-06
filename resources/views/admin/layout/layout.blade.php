<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ asset('/') }}" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ url('Asset/css/home.css') }}">
    <title>Admin</title>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        {{-- Header --}}
        @include('layouts.header')

        {{-- main content --}}
        <div class="main-content">
            @yield('content')
        </div>

        <!-- FOOTER -->
        @include('layouts.footer')
        @yield('scripts')

    </div>


</body>

</html>
