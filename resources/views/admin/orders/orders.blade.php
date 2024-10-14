@extends('admin.layout.index')
@section('content')
    <div class="container mt-4">
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

        {{-- Orders List --}}
        <h2>Orders List</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th>Order ID</th> --}}
                        <th>Customer ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Shipping Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            {{-- <td>{{ $order->orderID }}</td> --}}
                            <td>{{ $order->customerID }}</td>
                            <td>{{ $order->orderDate }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->totalPrice }}</td>
                            <td>{{ $order->shippingAddress }}</td>
                            <td>
                                {{-- Edit button --}}
                                <button type="button" class="btn btn-warning" onclick="editOrder({{ $order->orderID }})">
                                    Edit
                                </button>

                                {{-- Delete button --}}
                                <form action="{{ route('orders.destroy', $order->orderID) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Order Modal --}}
    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_orderID" name="orderID" value="{{ $order->orderID }}">
                        <div class="form-group">
                            <label for="edit_orderDate">Order ID: {{ $order->orderID }}</label>
                        </div>
                        <div class="form-group">
                            <label for="edit_orderDate">Order Date</label>
                            <input type="text" id="edit_orderDate" name="orderDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <input type="text" id="edit_status" name="status" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_totalPrice">Total Price</label>
                            <input type="number" id="edit_totalPrice" name="totalPrice" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_shippingAddress">Shipping Address</label>
                            <input type="text" id="edit_shippingAddress" name="shippingAddress" class="form-control"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editOrder(id) {
            fetch(`/orders/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_orderID').value = data.orderID;
                    document.getElementById('edit_orderDate').value = data.orderDate;
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('edit_totalPrice').value = data.totalPrice;
                    document.getElementById('edit_shippingAddress').value = data.shippingAddress;
                    document.getElementById('editForm').action = `/orders/${data.orderID}`;
                    $('#editOrderModal').modal('show');
                })
                .catch(error => console.error('Error fetching order details:', error));
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
    </div>
@endsection
