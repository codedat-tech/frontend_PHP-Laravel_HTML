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

        <div class="container">
            <h1>Review Orders Management</h1>

            <!-- Display Existing Review Orders -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Review Order ID</th>
                        <th>Order ID</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviewOrders as $reviewOrder)
                        <tr>
                            <td>{{ $reviewOrder->reviewOrderID }}</td>
                            <td>{{ $reviewOrder->order->orderID }}</td>
                            <td>{{ $reviewOrder->rating }}</td>
                            <td>{{ $reviewOrder->comment }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm" onclick="editReviewOrder({{ $reviewOrder->toJson() }})"
                                    data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

                                <!-- Delete Form -->
                                <form action="{{ route('review_orders.destroy', $reviewOrder->reviewOrderID) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Edit Review Order Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Review Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="editReviewOrderForm" method="POST">

                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="reviewOrderID" id="modalReviewOrderID">
                            <div class="mb-3">
                                <label for="modalOrderID" class="form-label">Order ID</label>
                                <select name="orderID" class="form-select" id="modalOrderID" required>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->orderID }}">{{ $order->orderID }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="modalRating" class="form-label">Rating</label>
                                <input type="number" name="rating" class="form-control" id="modalRating" min="1"
                                    max="5" required>
                            </div>

                            <div class="mb-3">
                                <label for="modalComment" class="form-label">Comment</label>
                                <textarea name="comment" class="form-control" id="modalComment" required></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function editReviewOrder(reviewOrder) {
                document.getElementById('editModalLabel').innerText = 'Edit Review Order';
                document.getElementById('modalReviewOrderID').value = reviewOrder.reviewOrderID;
                document.getElementById('modalOrderID').value = reviewOrder.orderID;
                document.getElementById('modalRating').value = reviewOrder.rating;
                document.getElementById('modalComment').value = reviewOrder.comment;
                document.getElementById('editReviewOrderForm').action = '/review_orders/' + reviewOrder.reviewOrderID;
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
@endsection
