@extends('layouts.index')
@section('content')
    <section class="order-confirm p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Order Confirmation: <span style="font-weight: bold;">{{ $order->orderID }}</span></p>
            </div>
            <div class="row-flex">
                <div class="order-confirm-content">
                    <p>Your order has been sent <span style="font-weight: bold;">successfully</span> <br>
                        <span style="font-style: italic;">We have sent the request to your email. Please check your email and
                            confirm your order.</span>
                    </p>
                    <br>
                    <a href="{{ route('home') }}"><button class="main-btn">Continue shopping</button></a>
                </div>
            </div>
        </div>
    </section>

    <section class="order-details container">
        <div class="order-details-title">
            <h2>Order Details</h2>
        </div>
        <div class="order-details-content">
            <p><strong>Order ID:</strong> {{ $order->orderID }}</p>
            <p><strong>Order Date:</strong> {{ $order->orderDate }}</p>
            <p><strong>Total Price:</strong> {{ number_format($order->totalPrice, 0, ',', '.') }} USD</p>
            <p><strong>Shipping Address:</strong> {{ $order->shippingAddress }}</p>
        </div>
    </section>

    <section class="product-related container">
        <div class="product-related-title">
            <p>You may be interested in</p>
        </div>
        <div class="row product-content">
            <div class="product-related-item">
                <img src="{{ asset('Asset/Image/furniture/chair/chair1_1.jpg') }}" alt="">
                <h1>Chair</h1>
                <p>790.000<sup>USD</sup></p>
            </div>
            <div class="product-related-item">
                <img src="{{ asset('Asset/Image/furniture/table/table1_1.jpg') }}" alt="">
                <h1>Round Table</h1>
                <p>790.000<sup>USD</sup></p>
            </div>
            <div class="product-related-item">
                <img src="{{ asset('Asset/Image/curtainscarpets/carpet/ca1_1.jpg') }}" alt="">
                <h1>Round Carpet</h1>
                <p>790.000<sup>USD</sup></p>
            </div>
            <div class="product-related-item">
                <img src="{{ asset('Asset/Image/curtainscarpets/curtain/cur1_1.jpg') }}" alt="">
                <h1>Curtain</h1>
                <p>790.000<sup>USD</sup></p>
            </div>
            <div class="product-related-item">
                <img src="{{ asset('Asset/Image/light/den tran/light1_1.jpg') }}" alt="">
                <h1>Light</h1>
                <p>790.000<sup>USD</sup></p>
            </div>
        </div>
    </section>
@endsection
