@extends('layouts.index')
@section('content')
    <style>
        /* delivery */

        .delivery {
            padding: 100px 0;

        }

        .delivery-top-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .delivery-top {
            height: 2px;
            width: 70%;
            background-color: #dddddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 100px;
        }

        .delivery-top-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #dddddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffff;
        }

        .delivery-top-item i {
            color: #dddddd;
        }

        .delivery-top-cart {
            border: 1px solid aqua;
        }

        .delivery-top-cart i {
            color: aqua;
        }

        .delivery-top-address {
            border: 1px solid cyan;
        }

        .delivery-top-address i {
            color: cyan;
        }

        .delivery-content {
            display: flex;
            justify-content: space-between;
        }

        .delivery-content-left {
            width: 60%;
            padding-right: 12px;
        }

        .delivery-content-left p {
            font-family: var(--main-text-font);
            font-size: 12px;
        }

        .delivery-content-left>p {
            font-weight: bold;
        }

        .delivery-content-left label {
            font-family: var(--main-text-font);
            font-size: 12px;
            margin-bottom: 6px;
            display: block;
        }

        .delivery-content-left-login {
            margin-top: 12px;
        }

        .delivery-content-left-login i {
            font-size: 12px;
            margin-right: 12px;

        }

        .delivery-content-left-singup {
            margin-bottom: 30px;
        }

        .delivery-content-left-signup input {
            margin-right: 12px;
        }

        .delivery-content-left-input-top {
            justify-content: space-between;
        }

        .delivery-content-left-input-top-item {
            width: calc(50% - 12px);
            margin-top: 20px;
        }

        .delivery-content-left-input-top-item input {
            width: 100%;
            height: 35px;
            border: 1px solid #dddddd;
            padding-left: 6px;
        }

        .delivery-content-left-input-bottom input {
            width: 100%;
            height: 35px;
            border: 1px solid #dddddd;
            padding-left: 6px;
        }

        .cart-content-left-button p {
            display: inline-block;
            font-family: var(--main-text-font);
            font-size: 12px;
        }

        .delivery-content-left-button span {
            margin-right: 12px;
        }

        .delivery-content-left-button {
            justify-content: space-between;
            padding-top: 20px;
        }

        .delivery-content-left-button button {
            height: 35px;
            border: 2px solid black;
            padding: 6px 12px;
            cursor: pointer;
        }

        .delivery-content-left-button button:hover {
            background-color: black;
            color: #ffff;
        }

        .delivery-content-right {
            width: 40%;
            padding-left: 12px;
            border-left: 2px solid #dddddd;
            height: auto;
        }

        .delivery-content-right table {
            width: 100%;
            font-family: var(--main-text-font);
            font-size: 12px;
            text-align: center;
        }

        .delivery-content-right table tr th:first-child {
            text-align: left;
        }

        .delivery-content-right table tr th {
            padding-bottom: 12px;
            border-bottom: 2px solid #dddddd;
        }

        .delivery-content-right table tr th:last-child {
            text-align: right;
        }

        .delivery-content-right table tr td {
            padding: 6px 0;
        }

        .delivery-content-right table tr:nth-child(4) {
            border-top: 2px solid #dddddd;
        }

        .delivery-content-right table tr td:last-child {
            text-align: right;
        }

        .delivery-content-right table tr td:first-child {
            text-align: left;
        }

        .payment-options {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .payment-option {
            flex: 1;
            margin: 0 10px;
            /* Added margin for spacing between options */
        }

        .payment-button {
            width: 100%;
            /* Full width */
            padding: 20px;
            /* Increased padding for height */
            border: 1px solid #dddddd;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            background-color: #ffffff;
            /* Default background */
            font-weight: bold;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        .payment-button:hover {
            background-color: #f0f0f0;
            /* Change background on hover */
        }

        .payment-button.selected {
            background-color: #007bff;
            /* Selected background color */
            color: #ffffff;
            /* Selected text color */
        }
    </style>
    <div class="container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-cart delivery-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="delivery-top-address delivery-top-item">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <p>Fill in your information</p>
                <div class="delivery-content-left-login row">
                    <p>Already have an account? <span style="font-weight: bold;">Login</span></p>
                </div>
                <div class="delivery-content-left-signup row">
                    <p>Don't have an account? <span style="font-weight: bold;">Sign Up</span></p>
                </div>

                <form id="payment-form" action="{{ route('submit.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" id="payment_method" required>

                    <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <label for="name">Full Name<span style="color: red;">*</span></label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="phone">Phone number<span style="color: red;">*</span></label>
                            <input type="text" name="phone" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="email">Email<span style="color: red;">*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="city">City/Province<span style="color: red;">*</span></label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="district">District<span style="color: red;">*</span></label>
                            <input type="text" name="district" required>
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="address">Address<span style="color: red;">*</span></label>
                            <input type="text" name="address" required>
                        </div>
                    </div>

                    <div class="delivery-content-left-button row">
                        <a href="{{ route('cart') }}">
                            <span>&#171;</span>
                            <p>Back to Cart</p>
                        </a>
                        <button type="button" id="payment-shipping-button" class="main-btn">Payment and Shipping</button>
                    </div>
                </form>
            </div>
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <p>{{ $product->name }}</p>
                            </td>
                            <td><span>{{ $cart[$product->productID] }}</span></td> <!-- Quantity from the cart -->
                            <td>
                                <p>{{ number_format($product->price * $cart[$product->productID], 2) }}<sup>USD</sup></p>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="font-weight: bold;" colspan="2">Total</td>
                        <td style="font-weight: bold;">
                            <p>{{ number_format($total, 2) }}<sup>USD</sup></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="2">VAT (10%)</td>
                        <td style="font-weight: bold;">
                            <p>{{ number_format($vat, 2) }}<sup>USD</sup></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Total Amount</td>
                        <td style="font-weight: bold;">
                            <p>{{ number_format($totalAmount, 2) }}<sup>USD</sup></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;" colspan="3">Payment Method</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="payment-options">
                                <div class="payment-option" id="cash-option">
                                    <button type="button" class="payment-button" data-value="cash">Cash</button>
                                </div>
                                <div class="payment-option" id="paypal-option">
                                    <button type="button" class="payment-button" data-value="paypal">PayPal</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        // Select all payment buttons
        const paymentButtons = document.querySelectorAll('.payment-button');

        // Add click event listener to each button
        paymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove 'selected' class from all buttons
                paymentButtons.forEach(btn => btn.classList.remove('selected'));
                // Add 'selected' class to the clicked button
                this.classList.add('selected');
            });
        });

        // Handle the payment and shipping button click
        document.getElementById('payment-shipping-button').addEventListener('click', function(event) {
            // Prevent default action
            event.preventDefault();

            // Check if a payment method is selected
            const selectedButton = document.querySelector('.payment-button.selected');

            // If no payment method is selected, show an alert
            if (!selectedButton) {
                alert('Please choose a payment method: Cash or PayPal.');
                return; // Exit the function if no payment method is selected
            }

            // Check if the form is valid
            const form = document.getElementById('payment-form');
            if (!form.checkValidity()) {
                // If the form is not valid, show an alert
                alert('Please fill in all required fields.');
                return; // Exit the function if the form is not valid
            }

            // Set the value of the hidden input to the selected payment method
            document.getElementById('payment_method').value = selectedButton.getAttribute('data-value');

            // Log the selected payment method for debugging
            console.log('Selected payment method:', selectedButton.getAttribute('data-value'));

            // Proceed with the form submission
            form.submit();
        });
    </script>
@endsection
