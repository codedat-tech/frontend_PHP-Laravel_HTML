@extends('layouts.index')
@section('content')
    <style>
        /* cart */
        .cart {
            padding: 100px 0;
        }

        .cart-top-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cart-top {
            height: 2px;
            width: 70%;
            background-color: #dddddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 100px;
        }

        .cart-top-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #dddddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffff;
        }

        .cart-top-item i {
            color: #dddddd;
        }

        .cart-top-cart {
            border: 1px solid aqua;
        }

        .cart-top-cart i {
            color: aqua;
        }

        .cart-content {
            display: flex;
            justify-content: space-between;
        }

        .cart-content-left {
            flex: 2;
            padding-right: 12px;
        }

        .cart-content-left table {
            width: 100%;
            text-align: center;
        }

        .cart-content-left table th {
            padding-bottom: 30px;
            font-family: var(--main-text-font);
            font-size: 12px;
            text-transform: uppercase;
            color: #333333;
            border-collapse: collapse;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-left table p {
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333333;
        }

        .cart-content-left table input {
            width: 30px;
        }

        .cart-content-left table span {
            display: block;
            width: 20px;
            height: 20px;
            justify-content: center;
            align-items: center;
            border: 1px solid #dddddd;
            cursor: pointer;
        }

        .cart-content-left td {
            padding: 20px 0;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-left td:first-child img {
            width: 130px;
        }

        .cart-content-left td:nth-child(2) {
            max-width: 130px;
        }

        .cart-content-left td:nth-child(3) img {
            width: 40px;
        }

        .cart-content-right {
            flex: 1;
            padding-left: 12px;
            border-left: 2px solid #dddddd;
        }

        .cart-content-right table {
            width: 100%;
        }

        .cart-content-right table th {
            padding-bottom: 30px;
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333333;
            border-collapse: collapse;
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-right table td {
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333333;
            padding: 6px 0;
        }

        .cart-content-right tr:nth-child(4) td {
            border-bottom: 2px solid #dddddd;
        }

        .cart-content-right tr td:last-child {
            text-align: right;
        }

        .cart-content-right-text {
            margin: 20px 0;
            text-align: center;
        }

        .cart-content-right-text p {
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333333;
        }

        .cart-content-right-button {
            text-align: center;
            align-items: center;
        }

        .cart-content-right-button button {
            padding: 0 18px;
            height: 35px;
            cursor: pointer;
        }

        .cart-content-right-button button:first-child {
            background-color: #ffff;
            border: 1px solid black;
            margin-right: 20px;
        }

        .cart-content-right-button button:first-child:hover {
            background-color: #ddd;
        }

        .cart-content-right-button button:last-child {
            background-color: black;
            color: #ffff;
            border: none;
            border: 1px solid black;
        }

        .cart-content-right-button button:last-child:hover {
            background-color: #dddddd;
            color: black;
        }

        .cart-content-right-login {
            margin-top: 20px;
        }

        .cart-content-right-login p {
            font-family: var(--main-text-font);
            font-size: 12px;
            color: #333333;
        }
    </style>
    <section class="cart">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="cart-top-address cart-top-item">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content">
                <div class="cart-content-left">
                    <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ asset('Asset/Image/product/' . $product->image) }}" alt="">
                                    </td>
                                    <td>
                                        <p>{{ $product->name }}</p>
                                    </td>
                                    <td><input type="number" value="{{ $product->quantity }}" min="1"
                                            class="quantity-input" data-id="{{ $product->productID }}"></td>
                                    <td>
                                        <p>{{ $product->price }}<sup>USD</sup></p>
                                    </td>
                                    <td>
                                        <p class="item-total">{{ $product->total_price }}<sup>USD</sup></p>
                                    </td>
                                    <td><a href="{{ url('/cart/delete/' . $product->productID) }}">X</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Total Amount</th>
                        </tr>
                        <tr>
                            <td>Total Product</td>
                            <td id="totalQuantity">{{ $totalQuantity }}</td> <!-- Total quantity ID -->
                        </tr>
                        <tr>
                            <td>Total Price</td>
                            <td id="totalPrice">
                                <p>{{ $totalPrice }}<sup>USD</sup></p>
                            </td> <!-- Total price ID -->
                        </tr>
                        <tr>
                            <td>Values</td>
                            <td id="values">
                                <p style="color: black; font-weight: bold;">{{ $totalPrice }}<sup>VND</sup></p>
                            </td> <!-- Values ID -->
                        </tr>
                    </table>
                    <br>
                    <div class="cart-content-right-button">
                        <form action="{{ route('delivery') }}" method="GET" style="display: inline;">
                            <button type="submit">Go to Payment</button>
                        </form>
                        <form action="{{ route('category.show', ['categoryID' => 1]) }}" method="GET"
                            style="display: inline;">
                            <button type="submit">Continue shopping</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script>
        // Lắng nghe sự kiện thay đổi trên tất cả các input số lượng
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.getAttribute('data-id');
                const newQuantity = parseInt(this.value, 10);

                if (newQuantity < 1) {
                    alert('Quantity must be at least 1');
                    this.value = 1; // Đặt lại giá trị về 1 nếu nhỏ hơn 1
                    return;
                }

                // Gửi yêu cầu AJAX để cập nhật số lượng trong backend
                fetch(`/cart/update/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            quantity: newQuantity // Gửi giá trị số lượng
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật tổng giá cho sản phẩm
                            const row = this.closest('tr');
                            const itemPrice = parseFloat(row.querySelector('td:nth-child(4) p')
                                .textContent.replace(' USD', ''));
                            const itemTotalPriceCell = row.querySelector('td:nth-child(5) p');
                            const itemTotalPrice = itemPrice * newQuantity;
                            itemTotalPriceCell.textContent =
                            `${itemTotalPrice} USD`; // Cập nhật giá trị tổng cho sản phẩm

                            // Cập nhật tổng số lượng và tổng giá trị giỏ hàng
                            document.getElementById('totalQuantity').textContent = data
                            .totalQuantity; // Cập nhật tổng số lượng
                            document.querySelector('.cart-content-right tr:nth-child(3) td p')
                                .textContent = `${data.totalPrice} USD`; // Cập nhật tổng giá trị
                        } else {
                            alert(data.message || 'Could not update quantity');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
