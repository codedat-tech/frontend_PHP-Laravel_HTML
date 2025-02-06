<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        /* Add some basic styling for the buttons */
        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .continue-shopping {
            background-color: #007bff;
            /* Bootstrap primary color */
            color: white;
        }

        .view-order-history {
            background-color: #28a745;
            /* Bootstrap success color */
            color: white;
        }

        .button-container button:hover {
            opacity: 0.8;
            /* Slightly fade on hover */
        }
    </style>
</head>

<body>
    <h1>Thank you for your order!</h1>
    <p>Your order ID is: {{ $order->orderID }}</p>
    <p>Total Amount: {{ $order->totalPrice }} USD</p>
    <p>Shipping Address: {{ $order->shippingAddress }}</p>

    <h2>Order Details:</h2>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->productID }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>If you have any questions, feel free to contact us!</p>

    <div class="button-container">
        <form action="{{ route('category.show', ['categoryID' => 1]) }}" method="GET" style="display: inline;">
            <button type="submit" class="continue-shopping">Continue Shopping</button>
        </form>
        <form action="{{ route('order.details', ['orderID' => $order->orderID]) }}" method="GET"
            style="display: inline;">
            <button type="submit" class="view-order-history">View Order History</button>
        </form>
    </div>
</body>

</html>
