@extends('web.layouts.layout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                                <path
                                    d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" />
                            </svg>
                        </div>
                    </a>
                    <a href="#carouselExampleIndicators" data-bs-slide="next">
                        <div class="carousel-nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                <path
                                    d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" />
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
                                                <img src="{{ url('Asset/Image/style1.jpg') }}" alt=""
                                                    class="img-fluid">
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
                                                <img src="{{ url('Asset/Image/style2.jpg') }}" alt=""
                                                    class="img-fluid">
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
                                                <img src="{{ url('Asset/Image/style3.jpg') }}" alt=""
                                                    class="img-fluid">
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
                                                <img src="{{ url('Asset/Image/style4.jpg') }}" alt=""
                                                    class="img-fluid">
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
        <h1>DESIGNER</h1>
        <div class="container3">
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="title">Name 1</h3>
                    <div class="bar">
                        <div class="emptybar"></div>
                        <div class="filledbar"></div>
                    </div>
                    <img class="card-img-bottom" src="{{ url('./Asset/Image/style1.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>


    <!-- BRAND -->
    <section>
        <div class="slider">
            <div class="slide-track">
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style1.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style2.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style3.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style4.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style5.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style6.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style7.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style8.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style9.jpg') }}" height="100" width="200" alt="" />
                </div>
                <div class="slide">
                    <img src="{{ url('./Asset/Image/style10.jpg') }}" height="100" width="200" alt="" />
                </div>
            </div>
        </div>
    </section>
@endsection('content')
