<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Detail PDF</title>
    <base href='{{ asset('/') }}' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <img src="{{ $logoSrc }}" alt="Logo" style="max-width:150px">

                </td>
                <td style="text-align: right;">
                    <h2>Bucki Store</h2>
                    <p>590 Nguyen Thi Minh Khai, distrist 3, Ho Chi Minh city, VietNam</p>
                    <p>Phone: (123) 456-7890</p>
                </td>
            </tr>
        </table>

        <h3 class="mb-4">Order Detail: # {{ $order->orderID }}</h3>

        <h4>Customer Information</h4>
        <table style="width: 100%;">
            <tr>
                <td><strong>Full Name:</strong></td>
                <td>{{ $order->customer->fullname }}</td>
            </tr>
            <tr>
                <td><strong>Telephone:</strong></td>
                <td>{{ $order->customer->phone }}</td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td>{{ $order->customer->address }}</td>
            </tr>
            <tr>
                <td><strong>Shipping address:</strong></td>
                <td>{{ $order->shippingAddress }}</td>
            </tr>
            <tr>
                <td><strong>Order Date:</strong></td>
                <td>{{ $order->orderDate }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td><i><b>{{ $order->status1 }}</b></i></td>
            </tr>
        </table>

        <hr>

        <h4>Order Information</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->brand->name }}</td>
                        <td style="text-align: right">{{ $detail->quantity }}</td>
                        <td style="text-align: right">${{ number_format($detail->product->price, 2) }}</td>
                        <td style="text-align: right">
                            ${{ number_format($detail->quantity * $detail->product->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">Total Price:</td>
                    <td style="text-align: right">${{ number_format($order->totalPrice, 2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">Voucher Discount (5%):</td>
                    <td style="text-align: right">${{ number_format($voucher, 2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">Tax (10%):</td>
                    <td style="text-align: right">${{ number_format($tax, 2) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right"><strong>Payment:</strong></td>
                    <td style="text-align: right"><strong>${{ number_format($payment, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
