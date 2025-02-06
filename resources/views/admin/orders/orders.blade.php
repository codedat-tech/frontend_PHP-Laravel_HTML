@extends('admin.layout.index')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No order found matching your search criteria.
            </div>
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

        {{-- 1.search --}}
        <form action="{{ route('orders.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Order Management</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by order..."
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- 2.Orders List --}}
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order of Customer
                            <a href="javascript:void(0);" onclick="sortColumn('customer')" class="sort-link"
                                id="sort-customer">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'customer' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>

                        <th>Order Date
                            <a href="javascript:void(0);" onclick="sortColumn('orderDate')" class="sort-link"
                                id="sort-orderDate">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'orderDate' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>
                        <th>Order Status
                            <a href="javascript:void(0);" onclick="sortColumn('status1')" class="sort-link"
                                id="sort-status1">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'status1' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>
                        <th>Total Price
                            <a href="javascript:void(0);" onclick="sortColumn('totalPrice')" class="sort-link"
                                id="sort-totalPrice">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'totalPrice' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>
                        <th>Shipping Address
                            <a href="javascript:void(0);" onclick="sortColumn('shippingAddress')" class="sort-link"
                                id="sort-shippingAddress">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'shippingAddress' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>
                        <th>Actions</th>
                        <th>Status
                            <a href="javascript:void(0);" onclick="sortColumn('status')" class="sort-link" id="sort-status">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'status' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <a href="javascript:void(0)" onclick="viewOrder({{ $order->orderID }})"
                                    style="text-decoration: underline; cursor: pointer;">
                                    {{ $order->customer->fullname }}</a>
                            </td>
                            <td>{{ $order->orderDate }}</td>
                            <td>{{ $order->status1 }}</td>
                            <td>{{ $order->totalPrice }}</td>
                            <td>{{ $order->shippingAddress }}</td>
                            <td>
                                <form action="{{ route('orders.toggleStatus', $order->orderID) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to change the status?')">
                                        {{ $order->status ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                {{ $order->status ? 'Active' : 'Inactive' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
        // 2. sort column
        function sortColumn(column) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentSortBy = urlParams.get('sort_by');
            const currentSortOrder = urlParams.get('sort') || 'asc';

            // 
            const newSortOrder = (currentSortBy === column && currentSortOrder === 'asc') ? 'desc' : 'asc';

            urlParams.set('sort_by', column);
            urlParams.set('sort', newSortOrder);
            window.location.search = urlParams.toString();
        }

        // 3. set style cursor
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['customer', 'orderDate', 'status1', 'totalPrice', 'shippingAddress', 'status'];
            const currentSortBy = new URLSearchParams(window.location.search).get('sort_by');

            columns.forEach(column => {
                const link = document.getElementById(`sort-${column}`);
                if (link) {
                    if (column === currentSortBy) {
                        link.classList.add('active-sort'); //highlight cột
                        link.style.opacity = 1;
                    } else {
                        link.classList.remove('active-sort');
                        link.style.opacity = 0.3; // Làm mờ cột
                    }
                }
            });
        });

        // 4. view order
        function viewOrder(orderID) {
            window.location.href = `/orders/${orderID}`;
        }
    </script>
@endsection
