<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Your Cart</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Your Cart</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="height: 50px;"></td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ url('/product') }}" class="btn btn-primary">Continue Shopping</a>
            @if(session('cart') && count(session('cart')) > 0)
                <a href="{{ url('/checkout') }}" class="btn btn-success">Proceed to Checkout</a>
            @endif
        </div>
    </div>
</body>

</html>
