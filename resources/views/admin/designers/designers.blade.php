@extends('admin.layout.index')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('Asset/js/viewProfileDesigner.js') }}"></script>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No designer name found matching your search criteria.
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
        <form action="{{ route('designers.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Designer Management</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by designer..."
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- 1. pages --}}
        {{-- view --}}
        <table class="table table-bordered">
            <thead>
                <tr style="text-align: center">
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
                    <th>Portfolio
                        <a href="javascript:void(0);" onclick="sortColumn('portfolio')" class="sort-link"
                            id="sort-portfolio">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'portfolio' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Experience
                        <a href="javascript:void(0);" onclick="sortColumn('experienceYear')" class="sort-link"
                            id="sort-experienceYear">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'experienceYear' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Specialization
                        <a href="javascript:void(0);" onclick="sortColumn('specialization')" class="sort-link"
                            id="sort-specialization">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'specialization' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Rating
                        <a href="javascript:void(0);" onclick="sortColumn('rating')" class="sort-link" id="sort-rating">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'rating' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>
                    <th>Image</th>
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
                @foreach ($designers as $designer)
                    <tr>
                        <td>
                            <a href="javascript:void(0)" onclick="viewDesigner({{ $designer->designerID }})"
                                style="text-decoration: underline; cursor: pointer;">
                                {{ $designer->fullname }}</a>
                        </td>
                        <td>{{ substr($designer->email, 0, 5) }}...</td>
                        <td>{{ substr($designer->password, 0, 5) }}...</td>
                        <td>{{ substr($designer->phone, 0, 5) }}...</td>
                        <td>
                            <a href="{{ asset('Asset/PDF/portfolio/' . $designer->portfolio) }}"
                                onclick="openPdfPopup('{{ asset('Asset/PDF/portfolio/' . $designer->portfolio) }}'); return false;">
                                {{ substr($designer->portfolio, 0, 5) }}...
                            </a>
                        </td>
                        <td>{{ $designer->experienceYear }} years</td>
                        <td>{{ $designer->specialization }}</td>
                        <td>{{ $designer->rating }}</td>
                        <td>
                            @if ($designer->image)
                                <img src="{{ asset('Asset/Image/designer/' . $designer->image) }}"
                                    alt="{{ $designer->image }}" style="width: 70%; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Default Image"
                                    style="width: 70%; height: 80px; object-fit: cover;">
                            @endif

                        </td>
                        <td>
                            <form action="{{ route('designers.toggleStatus', $designer->designerID) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $designer->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: center">
                            {{ $designer->status ? 'Active' : 'Inactive' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $designers->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- 4.view Déigner --}}
    <div class="modal fade" id="viewDesignerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center w-100">Designer information</h3>
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
                            <th>Portfolio:</th>
                            <td>
                                <a id="view_portfolio" target="_blank">View Portfolio</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Experience (Years):</th>
                            <td><span id="view_experienceYear"></span></td>
                        </tr>
                        <tr>
                            <th>Specialization:</th>
                            <td><span id="view_specialization"></span></td>
                        </tr>
                        <tr>
                            <th>Rating:</th>
                            <td><span id="view_rating"></span></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><span id="view_status"></span></td>
                        </tr>
                        <tr>
                            <th>Image:</th>
                            <td>
                                <img id="view_image" src="" alt="" style="width: 300px; height: auto;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-section')
    @parent
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
            const columns = ['fullname', 'email', 'phone', 'portfolio', 'experienceYear', 'specialization',
                'rating', 'status'
            ];
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

        function openPdfPopup(url) {
            window.open(url, 'PDF', 'width=800,height=600,resizable=yes,scrollbars=yes');
        }
    </script>
@endsection
