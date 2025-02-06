@extends('admin.layout.index')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table style="width: 70%;">
            <tr>
                <td style="width: 50%;">
                    <img src="{{ asset('storage/Image/LOGO.png') }}" alt="Logo" style="max-width:150px">
                </td>
                <td style="text-align: right;">
                    <h2>Bucki Store</h2>
                    <p>590 Nguyen Thi Minh Khai, distrist 3, Ho Chi Minh city, VietNam</p>
                    <p>Phone: (123) 456-7890</p>
                </td>
            </tr>
        </table>
        <table>
            <h3 class="mb-4 text-align: center">Order Detail: # {{ $order->orderID }}</h3>

            <div class="mb-4">
                <tr>
                    <td colspan="2">
                        <h4>Customer Information</h4>
                    </td>
                </tr>
                <tr>
                    <td><strong>Full Name:</strong></td>
                    <td>{{ $order->customer->fullname }}</td>
                </tr>
                <tr>
                    <td><strong>Telephone:</strong></td>
                    <td>{{ $order->customer->phone }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $order->customer->email }}</td>
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
            </div>
        </table>
        <h4>Order Information</h4>
        <div class="table-responsive">
            <table class="table table-striped" style="width: 70%">
                <thead>
                    <tr style="text-align: center">
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr class="table-bordered">
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
                        <td></td>
                        <td style="text-align: right">Total Price:</td>
                        <td>${{ number_format($order->totalPrice, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">Voucher Discount (5%):</td>
                        <td>${{ number_format($voucher, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">Tax (10%):</td>
                        <td>${{ number_format($tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right"><strong>Payment:</strong></td>
                        <td><strong>${{ number_format($payment, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="{{ route('orders.downloadPDF', $order->orderID) }}" class="btn btn-primary"
            onclick="return confirm('Are you sure you want to download the order?')">Download PDF</a>
        <a href="{{ route('orders.sendMail', $order->orderID) }}" class="btn btn-secondary"
            onclick="return confirm('Are you sure you want to send the order details via email?')">Send Email</a>
    </div>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
