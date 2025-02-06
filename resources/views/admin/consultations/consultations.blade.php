@extends('admin.layout.index')
@section('content')
    <style>
        .alarm {
            animation: flash 1s infinite;
        }

        @keyframes flash {
            0% {
                background-color: transparent;
            }

            50% {
                background-color: yellow;
            }

            100% {
                background-color: transparent;
            }
        }
    </style>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No consultation found matching your search criteria.
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
        <form action="{{ route('consultations.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Consultations Management</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by consolation ...."
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Display Existing Consultations -->
        <table class="table table-bordered">
            <thead>
                <tr style="text-align:center">
                    <th>Designer Name
                        <a href="javascript:void(0);" onclick="sortColumn('designerID')" class="sort-link"
                            id="sort-designerID">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'designerID' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Customer Name
                        <a href="javascript:void(0);" onclick="sortColumn('customerID')" class="sort-link"
                            id="sort-customerID">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'customerID' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Scheduled At
                        <a href="javascript:void(0);" onclick="sortColumn('scheduledAT')" class="sort-link"
                            id="sort-scheduledAT">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'scheduledAT' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Consul. Status
                        <a href="javascript:void(0);" onclick="sortColumn('status1')" class="sort-link" id="sort-status1">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'status1' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Note
                        <a href="javascript:void(0);" onclick="sortColumn('note')" class="sort-link" id="sort-note">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'note' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Actions</th>
                    <th>Status
                        <a href="javascript:void(0);" onclick="sortColumn('status')" class="sort-link" id="sort-status">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'status' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Alert sent</th>
                    <th>Send email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->designer->fullname ?? 'No Name' }}</td>
                        <td>{{ $consultation->customer->fullname ?? 'No Name' }}</td>
                        <td class="scheduled-time">{{ $consultation->scheduledAT }}</td>
                        <td>{{ $consultation->status1 }}</td>
                        <td>{{ substr($consultation->note, 0, 30) }}...</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm"
                                onclick="editConsultation({{ $consultation }})">edit</button>

                            <form action="{{ route('consultations.toggleStatus', $consultation->consultationID) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $consultation->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: center">
                            {{ $consultation->status ? 'Active' : 'Inactive' }}
                        </td>
                        <td style="text-align: center">
                            {{ $consultation->alert_sent }}
                        </td>
                        <td><a href="{{ route('consultations.sendMail', $consultation->consultationID) }}"
                                class="btn btn-secondary btn-sm"
                                onclick="return confirm('Are you sure you want to send via email?')">Send
                                Email</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $consultations->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@section('script-section')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
            const columns = ['designerID', 'customerID', 'scheduledAT', 'status1', 'note', 'status'];
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

        //4. blink scheduled
        document.addEventListener('DOMContentLoaded', function() {
            const currentDateTime = new Date();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const scheduledCell = row.querySelector('.scheduled-time');
                const scheduledAt = new Date(scheduledCell.textContent);

                if (!isNaN(scheduledAt)) { // Check if date is valid
                    const timeDifference = scheduledAt - currentDateTime;

                    // Highlight row
                    if (timeDifference > 0 && timeDifference <= 86400000) {
                        row.classList.add('alarm');
                    }
                }
            });
        });
    </script>
@endsection
