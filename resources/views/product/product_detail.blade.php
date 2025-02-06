@extends('layouts.index')
@section('content')
    <style>
        /* product */
        .p-to-top {
            padding-top: calc(var(--header-height) + 20px)
        }

        .add-to-cart .row-flex-add-to-cart {
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 30px;
        }

        .row-flex-add-to-cart {
            position: relative;
            padding-left: 6px;
        }

        .row-flex-add-to-cart::after {
            position: absolute;
            content: "";
            height: 50px;
            width: 2px;
            left: 0;
            background-color: var(--main-bg);
        }

        .row-flex-add-to-cart i {
            margin: 0 12px;
        }

        .add-to-cart .row-grid {
            display: grid;
            grid-template-columns: 70% 30%;
            column-gap: 30px;
        }

        .add-to-cart-left {
            position: relative;
        }

        .add-to-cart-left img {
            width: 65%;
            border-radius: 5px;
            border: 1px solid black;
            margin-left: 20%;
        }

        .add-to-cart-right-infor h1 {
            font-weight: var(--main-font-weight);
        }

        .add-to-cart-right-des h2 {
            font-weight: var(--main-font-weight);
            margin: 12px 0;
            font-size: 20px;
        }

        .add-to-cart-right-des ul {
            background-color: var(--main-bg);
            padding: 20px 20px 20px 30px;
            border-radius: var(--main-border-radius);
        }

        .add-to-cart-right-des ul li {
            list-style: circle;
            margin-bottom: 12px;
        }

        .add-to-cart-right-des ul li::marker {
            color: black;

        }

        .add-to-cart-right-quantity h2 {
            font-weight: var(--main-font-weight);
            margin: 12px 0;
            font-size: 20px;
        }

        .add-to-cart-right-quantity-input {
            position: relative;
            width: 70px;
            margin-bottom: 12px;
        }

        .add-to-cart-right-quantity-input input {
            height: 25px;
            width: 70px;
            text-align: center;
        }

        .add-to-cart-right-quantity-input i {
            height: 25px;
            width: 25px;
            color: black;
            color: var(--main-color);
            position: absolute;
            top: 0;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-to-cart-right-quantity-input .ri-add-line {
            right: 0;
        }

        .add-to-cart-right-quantity-input .ri-subtract-line {
            left: 0;
        }

        .add-to-cart-right-quantity input::-webkit-outer-spin-button,
        .add-to-cart-right-quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .product-item-price {
            margin-top: 6px;
        }

        .product-item-price p {
            font-weight: var(--main-font-weight);
        }

        .product-item-price p span {
            font-weight: 300;
            font-size: small;
            text-decoration: line-through;
        }

        .product-item-color-image {
            display: flex;
            gap: 10px;
        }

        .product-item-color-image img {
            height: 30px;
            width: 30px;
            border-radius: 50%;
            border: 2px solid #333333;
            padding: 5px;
            box-sizing: border-box;
            margin: 12px 0;
        }


        .main-btn {
            padding: 12px 12px;
            border: 2px;
            color: var(--main-color);
            background-color: rgb(186, 236, 214);
            cursor: pointer;
            transition: var(--main-transition);
        }

        .main-btn:hover {
            background-color: var(--main-bg);
            color: rgb(204, 175, 30);
        }

        /* related product */
        .product-related {
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .product-related-title {
            margin: 20px 0;
        }

        .product-related-title p {
            font-family: var(--main-text-font);
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            padding: 0 6px;
        }

        .product-related-item {
            width: 20%;
            text-align: center;
            padding: 0 10px;
        }

        .product-related-item img {
            width: 100%;
            height: 200px;
            cursor: pointer;
        }

        .product-related-item h1 {
            font-family: var(--main-text-font);
            font-size: 14px;
            font-weight: bold;
            color: #333333;
        }

        .product-related-item p {
            font-size: 12px;
        }
    </style>

    <section class="add-to-cart p-to-top">
        <form action="/cart/add" method="post">
            <div class="container">
                <div class="row-flex row-flex-add-to-cart">
                    <p>Product</p><i class="ri-arrow-right-line"></i>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="row-grid">
                    <div class="add-to-cart-left">
                        <img class="main-image" src="{{ asset('Asset/Image/product/' . $product->image) }}" alt="">
                    </div>
                    <div class="add-to-cart-right">
                        <div class="add-to-cart-right-infor">
                            <h1>{{ $product->name }}</h1>
                            <div class="product-item-price">
                                <p>{{ $product->price }}<sup>USD</sup></p>
                            </div>
                        </div>
                        <h2>Description</h2>
                        <div class="add-to-cart-right-des">
                            {!! $product->description !!}
                        </div>
                        <h4>Brand</h4>
                        <div class="add-to-cart-right-des">
                            {{ $product->brand->name }}
                            <br>
                            <img class="product-images-items"
                                src="{{ asset('Asset/Image/brand/' . $product->brand->image) }}" alt="">
                        </div>
                        <div class="add-to-cart-right-quantity">
                            <h2>Quantity</h2>
                            <div class="add-to-cart-right-quantity-input">
                                <i class="ri-subtract-line"></i>
                                <input onKeyDown="return false" class="quantity-input" name="product_qty" type="number"
                                    value="1">
                                <input type="hidden" value="{{ $product->productID }}" name="productID">
                                <i class="ri-add-line"></i>
                            </div>
                        </div>
                        <div class="add-to-cart-right-addCart">
                            <button type="submit" class="main-btn">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>

    <section class="product-related container">
        <div class="product-related-title">
            <p>You may interest</p>
        </div>
        <div class="row product-content">
            @foreach ($products->take(5) as $product)
                <div class="product-related-item">
                    <a href="/product_detail/{{ $product->productID }}"><img
                            src="{{ asset('Asset/Image/product/' . $product->image) }}" alt=""></a>
                    <h1><a href="/product_detail/{{ $product->productID }}">{{ $product->name }}</a></h1>
                    <p>{{ $product->price }}<sup>USD</sup></p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('scripts')
    @parent
    <script>
        //click product image detail
        const imageSmall = document.querySelectorAll('.product-images-items img')
        const imageMain = document.querySelector('.main-image')
        for (let index = 0; index < imageSmall.length; index++) {
            imageSmall[index].addEventListener('click', () => {

                for (let a = 0; a < imageSmall.length; a++) {
                    imageSmall[a].classList.remove('active')

                }

                imageMain.src = imageSmall[index].src
                imageSmall[index].classList.add('active')
            })
        }

        //quantity
        // Lấy các nút và trường nhập số lượng
        const quanPlus = document.querySelector('.ri-add-line');
        const quanMinus = document.querySelector('.ri-subtract-line');
        const quanInput = document.querySelector('.quantity-input');

        // Khởi tạo số lượng ban đầu
        let qty = parseInt(quanInput.value) || 1;

        // Xử lý sự kiện tăng số lượng
        quanPlus.addEventListener('click', () => {
            qty += 1;
            quanInput.value = qty;
        });

        // Xử lý sự kiện giảm số lượng, đảm bảo không giảm dưới 1
        quanMinus.addEventListener('click', () => {
            if (qty > 1) {
                qty -= 1;
                quanInput.value = qty;
            }
        });
    </script>
@endsection
