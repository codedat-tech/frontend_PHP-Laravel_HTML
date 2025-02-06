@extends('layouts.index')
@section('content')
    <!-- PRODUCTS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="mb-3 text-center container">
        <div class="row justify-content-center align-items-center bg-light p-3">
            <div class="col-sm-2 text-center">
                <h5 class="fw-bold">HIGHLIGHT PRODUCTS</h5>
                <!-- Nút điều khiển Carousel -->
                <div class="d-flex justify-content-center mt-3">
                    <a href="#carouselExampleIndicators" role="button" data-bs-slide="prev" class="me-2">
                        <div class="carousel-nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                <path
                                    d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" />
                            </svg>
                        </div>
                    </a>
                    <a href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <div class="carousel-nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                                <path
                                    d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Carousel với giới hạn chiều cao -->
            <div class="col-sm-10">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
                    style="max-height: 300px; overflow: hidden;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <!-- Giới hạn chiều cao -->
                                    <h6>Style 1</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style1.jpg" alt="Style 1" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <h6>Style 2</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style2.jpg" alt="Style 2" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Các mục Carousel bổ sung -->
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <h6>Information 3</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style3.jpg" alt="Information 3" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <h6>Information 4</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style4.jpg" alt="Information 4" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <h6>Information 5</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style5.jpg" alt="Information 5" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-6 p-2 bg-warning" style="max-height: 300px;">
                                    <h6>Information 6</h6>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="/Asset/Image/style6.jpg" alt="Information 6" class="img-fluid"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- DESIGNER -->
    <section>
        <h1>DESIGNER</h1>
        <div class="container3">
            @foreach ($designers as $item)
                <div class="card">
                    <a href="{{ route('designer.show') }}">
                        <div class="card-body">
                            <h3 class="title">{{ $item->fullname }}</h3>
                            <div class="bar">
                                <div class="emptybar"></div>
                                <div class="filledbar"></div>
                            </div>
                            <img class="card-img-bottom" src="{{ asset('Asset/Image/designer/' . $item->image) }}"
                                alt="{{ $item->fullname }}">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>


    <!-- BRAND -->
    <section>
        <div class="slider">
            <div class="slide-track d-flex">
                @foreach ($brands as $brand)
                    <div class="slide">
                        <img src="{{ asset('Asset/Image/brand/' . $brand->image) }}" class="img-fluid" height="100"
                            width="200" alt="{{ $brand->name }}" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
