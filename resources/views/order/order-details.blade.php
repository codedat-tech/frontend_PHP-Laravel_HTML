@extends('layouts.index') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <h1>Order Details</h1>

    @if($orderDetails->isEmpty())
        <p>No details found for this order.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->productID }}</td>
                        <td>{{ $detail->product->name ?? 'N/A' }}</td> <!-- Assuming the Product model has a 'name' attribute -->
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection