<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('Asset/css/home.css') }}">
    <title>Home</title>
</head>

<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <header>
            <div class="container1">
                <div class="row-flex">
                    <div class="header-logo">
                        <img src="{{ asset('Asset/Image/LOGO.png') }}" alt="Logo">
                    </div>
                    <div class="header-nav">
                        <nav>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="{{ url('/product') }}">Our Products</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="{{ url('/designer') }}">Designer</a></li>
                                <div class="dropdown01">
                                    <span class="dropbtn01">Library</span>
                                    <div class="drop-content01">
                                        <a href="#">Link 1</a>
                                        <a href="#">Link 2</a>
                                        <a href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="dropdown02">
                                    <span class="dropbtn02">Product</span>
                                    <div class="drop-content02">
                                        <a href="#">Link 1</a>
                                        <a href="#">Link 2</a>
                                        <a href="#">Link 3</a>
                                    </div>
                                </div>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-icon">
                        <div class="header-cart">
                            <a href="#"><i class="ri-shopping-cart-2-line"></i></a>
                        </div>
                        <div class="header-bell">
                            <i class="ri-notification-4-line"></i>
                        </div>
                        <div class="header-login">
                            @if(Auth::check())
                                <span>Welcome, {{ Auth::user()->fullname }}</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            @else
                                <a href="{{ route('login') }}"><i class="ri-login-box-line"></i> Login</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="header-image">
                        BuckiDecor là một trang web cung cấp ....
                    </div>
                </div>
            </div>
        </header>

        <!-- PRODUCTS -->
        <div class="mb-3 text-center container2">
            <div class="row frame" style="background-color: antiquewhite;">
                <div class="col-sm-2 col text-center frame1">
                    <div style="margin-left: 15px;">
                        <h4><b>HIGHLIGHT PRODUCTS</b></h4>
                    </div>
                    <!-- button -->
                    <div class="col-1 d-flex align-items-center justify-content-center">
                        <a href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                            <div class="carousel-nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                    <path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" />
                                </svg>
                            </div>
                        </a>
                        <a href="#carouselExampleIndicators" data-bs-slide="next">
                            <div class="carousel-nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                    <path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row frame2">
                                    <div class="col-sm-6 smallframe" style="background-color: #aa7200;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Information 1</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="col-12 col-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('Asset/Image/style1.jpg') }}" alt="style1" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 smallframe" style="background-color: #aa7200;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Information 2</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="col-12 col-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('Asset/Image/style2.jpg') }}" alt="style2" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Carousel Items -->
                            <div class="carousel-item">
                                <div class="row frame2">
                                    <div class="col-sm-6 smallframe" style="background-color: #aa7200;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Information 3</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="col-12 col-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('Asset/Image/style3.jpg') }}" alt="style3" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 smallframe" style="background-color: #aa7200;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Information 4</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="col-12 col-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('Asset/Image/style4.jpg') }}" alt="style4" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat carousel items as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DESIGNER -->
        <section>
            <div class="container2">
                <h4>MEET THE DESIGNER</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{ asset('Asset/Image/style1.jpg') }}" class="img-fluid" alt="Designer Image">
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ asset('Asset/Image/style2.jpg') }}" class="img-fluid" alt="Designer Image">
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <!-- Footer Content -->
        </footer>
    </div>
</body>

</html>
