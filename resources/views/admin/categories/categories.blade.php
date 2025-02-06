@extends('admin.layout.index')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No category name found matching your search criteria.
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

        <form action="{{ route('categories.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Categories Management</h2>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by category name"
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Button to trigger Add Category modal -->
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addCategoriesModal">
            Create New Category
        </button>

        {{-- 1. view table --}}
        <div class="container d-flex justify-content-center">
            <table class="table table-bordered" style="width: 70%;">
                <colgroup>
                    <col style="width: 40%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                </colgroup>
                <thead>
                    <tr style="text-align: center">
                        <th>Category Name
                            <a href="javascript:void(0);" onclick="sortColumn('name')" class="sort-link" id="sort-name">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'name' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <a href="javascript:void(0)" onclick="edit({{ $category->categoryID }})"
                                    style="text-decoration: underline; cursor: pointer;">
                                    {{ $category->name }}
                                </a>
                            </td>

                            <td style="text-align: center">
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="edit({{ $category->categoryID }})">Update</button>

                                <form action="{{ route('categories.toggleStatus', $category->categoryID) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to change the status?')">
                                        {{ $category->status ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            @if ($categories instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $categories->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>

    <!-- 2.Add Category Modal -->
    <div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="addCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoriesModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required>
                            <span id="name-error" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="edit_status">Status:</label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="categoryID">
                        <div class="form-group">
                            <label for="edit_name">Name:</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                            <span id="edit_name-error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">Status:</label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Are you sure you want to update?')">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function edit(id) {
            fetch(`/categories/${id}/edit`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_id').value = data.categoryID;
                    document.getElementById('edit_name').value = data.name;
                    // document.getElementById('edit_description').value = data.description;
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('editCategoryForm').action = `/categories/${data.categoryID}`;
                    $('#editCategoryModal').modal('show');
                });
        }

        $(document).ready(function() {
            const checkCategoryName = (isEdit = false) => {
                const nameField = isEdit ? $('#edit_name') : $('#name');
                const errorField = isEdit ? $('#edit_name-error') : $('#name-error');
                const submitButton = isEdit ? $('#editCategoryForm button[type="submit"]') : $(
                    '#addCategoriesModal button[type="submit"]');
                const name = nameField.val().trim();

                if (name.length < 5) {
                    errorField.text('Category name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    errorField.text('');
                }

                // Kiểm tra trùng tên bằng AJAX
                $.ajax({
                    url: "{{ route('categories.checkCategoryName') }}",
                    method: 'POST',
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (!response.isAvailable) {
                            errorField.text('Category name already exists.');
                            submitButton.prop('disabled', true); // Vô hiệu hóa nút lưu
                        } else {
                            errorField.text('');
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function() {
                        errorField.text('Error checking category name.');
                        submitButton.prop('disabled', true);
                    }
                });
            };

            checkCategoryName();
            checkCategoryName(true);

            // Kiểm tra khi người dùng nhập liệu
            $('#name').on('blur input', function() {
                checkCategoryName();
            });

            $('#edit_name').on('blur input', function() {
                checkCategoryName(true);
            });
        });
    </script>

    <script>
        // sort
        function sortColumn(column) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentSortBy = urlParams.get('sort_by');
            const currentSortOrder = urlParams.get('sort') || 'asc';

            //
            const newSortOrder = (currentSortBy === column && currentSortOrder === 'asc') ? 'desc' : 'asc';

            // URL
            urlParams.set('sort_by', column);
            urlParams.set('sort', newSortOrder);
            window.location.search = urlParams.toString();
        };

        // set style cursor
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['name', 'status'];
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
