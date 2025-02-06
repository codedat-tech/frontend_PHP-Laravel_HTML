@extends('admin.layout.index')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No customers name found matching your search criteria.
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
        <form action="{{ route('customers.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Customer Management</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search: Name, Phone Number, Email or Address" value="{{ request()->search }}"
                            size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- 1. list --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name
                        <a href="javascript:void(0);" onclick="sortColumn('fullname')" class="sort-link" id="sort-fullname">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'fullname' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Email
                        <a href="javascript:void(0);" onclick="sortColumn('email')" class="sort-link" id="sort-email">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'email' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Password</th>
                    <th>Phone
                        <a href="javascript:void(0);" onclick="sortColumn('phone')" class="sort-link" id="sort-phone">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'phone' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Address
                        <a href="javascript:void(0);" onclick="sortColumn('address')" class="sort-link" id="sort-address">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'address' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
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
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <a href="javascript:void(0)" onclick="viewCustomer({{ $customer->customerID }})"
                                style="text-decoration: underline; cursor: pointer;">
                                {{ $customer->fullname }}</a>
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ substr($customer->password, 0, 8) }}...</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <form action="{{ route('customers.toggleStatus', $customer->customerID) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $customer->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: center">
                            {{ $customer->status ? 'Active' : 'Inactive' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- 2.view Customer --}}
    <div class="modal fade" id="viewCustomerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center w-100">Customer information</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name:</th>
                            <td><span id="view_fullname"></span></td>
                        </tr>

                        <tr>
                            <th>Email:</th>
                            <td><span id="view_email"></span></td>
                        </tr>

                        <tr>
                            <th>Phone:</th>
                            <td><span id="view_phone"></span></td>
                        </tr>

                        <tr>
                            <th>Address:</th>
                            <td><span id="view_address"></span></td>
                        </tr>

                        <tr>
                            <th>Status:</th>
                            <td><span id="view_status"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. view customer
        function viewCustomer(id) {
            $.ajax({
                url: `/customers/${id}/edit`,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('view_fullname').innerText = data.fullname;
                    document.getElementById('view_email').innerText = data.email;
                    document.getElementById('view_phone').innerText = data.phone;
                    document.getElementById('view_address').innerText = data.address;
                    document.getElementById('view_status').innerText = data.status == 1 ? 'Active' : 'Inactive';

                    $('#viewCustomerModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching designer details:', error);
                }
            });
        }

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
            const columns = ['fullname', 'email', 'phone', 'address', 'status'];
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
    </script>
@endsection
