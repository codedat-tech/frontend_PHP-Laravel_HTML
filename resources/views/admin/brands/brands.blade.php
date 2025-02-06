@extends('admin.layout.index')
@section('content')

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No brand name found matching your search criteria.
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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

        <form action="{{ route('brands.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Brands Management</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

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
        <!-- Button to trigger Add Brand modal -->
        <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addBrandModal">
            Create New Brand
        </button>

        <!-- 1. Brands List -->
        <div class="container d-flex justify-content-center">
            <table class="table table-bordered" style="width: 100%;">
                <colgroup>
                    <col style="width: 18%;">
                    <col style="width: 30%;">
                    <col style="width: 25%;">
                    <col style="width: 15%;">
                    <col style="width: 10%;">
                </colgroup>
                <thead>
                    <tr style="text-align: center">
                        <th>Brand Name
                            <a href="javascript:void(0);" onclick="sortColumn('name')" class="sort-link" id="sort-name">
                                <i
                                    class="fas fa-angle-{{ request()->get('sort_by') === 'name' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                            </a>
                        </th>

                        <th>Description</th>

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
                    @foreach ($brands as $brand)
                        <tr>
                            <td>
                                <a href="javascript:void(0)" onclick="editBrand({{ $brand->brandID }})"
                                    style="text-decoration: underline; cursor: pointer;">
                                    {{ $brand->name }}</a>
                            </td>
                            <td>{{ Str::substr($brand->description ?? 'null', 0, 200) }}...</td>
                            <td style="text-align: center">
                                @if ($brand->image)
                                    <img src="{{ asset('./Asset/Image/brand/' . $brand->image) }}"
                                        alt="{{ $brand->image }}" style="width: 100%; height: 150px; object-fit: contain;">
                                @else
                                    <img src="{{ asset('img/default.png') }}" alt="Default Image"
                                        style="width: 100%; height: 150px; object-fit: contain;">
                                @endif
                            </td>

                            <td style="text-align: center">
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="editBrand({{ $brand->brandID }})">Update</button>

                                <form action="{{ route('brands.toggleStatus', $brand->brandID) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to change the status?')">
                                        {{ $brand->status ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center">
                                {{ $brand->status ? 'Active' : 'Inactive' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $brands->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- 2. Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Add New Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <span id="name-error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">Status:</label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" id="image" name="image" class="form-control-file"
                                accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Edit Brand Modal -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBrandForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="brandID">
                        <div class="form-group">
                            <label for="edit_name">Name:</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                            <span id="edit_name-error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description:</label>
                            <textarea id="edit_description" name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Current Image:</label>
                            <p id="edit_imageName"></p>
                            <img id="edit_currentImage" src="" alt="Brand Image" class="img-thumbnail"
                                style="width: 300px;">
                        </div>

                        <div class="form-group">
                            <label for="edit_image">Upload New Image:</label>
                            <input type="file" id="edit_image" name="image" class="form-control-file"
                                accept="./Asset/Image/brand/">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control" required>
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
        $(document).ready(function() {
            let debounceTimer;

            const checkBrandName = (isEdit = false) => {
                const nameField = isEdit ? $('#edit_name') : $('#name');
                const errorField = isEdit ? $('#edit_name-error') : $('#name-error');
                const submitButton = isEdit ? $('#editBrandForm button[type="submit"]') : $(
                    '#addBrandModal button[type="submit"]');
                const name = nameField.val().trim();

                if (name.length < 5) {
                    errorField.text('Brand name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', false);
                }

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('brands.checkBrandName') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (!response.isAvailable) {
                                errorField.text('Brand name already exists.');
                                submitButton.prop('disabled', true);
                            } else {
                                errorField.text('');
                                submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            errorField.text('Error checking brand name.');
                            submitButton.prop('disabled', true);
                        }
                    });
                }, 300);
            };
            $('#name').on('blur input', function() {
                checkBrandName();
            });
            $('#edit_name').on('blur input', function() {
                checkBrandName(true);
            });
        });

        function editBrand(id) {
            fetch(`/brands/${id}/edit`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_id').value = data.brandID;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_description').value = data.description;

                    // Cập nhật trạng thái
                    document.getElementById('status').value = data.status;

                    // Hiển thị hình ảnh cũ
                    if (data.image) {
                        document.getElementById('edit_currentImage').src = `/Asset/Image/brand/${data.image}`;
                        document.getElementById('edit_imageName').innerText = data.image;
                    } else {
                        document.getElementById('edit_currentImage').src = '';
                        document.getElementById('edit_imageName').innerText = 'No image available';
                    }
                    document.getElementById('editBrandForm').action = `/brands/${data.brandID}`;
                    $('#editBrandModal').modal('show');
                })
                .catch(error => console.error('Error fetching brand data:', error));
        }
    </script>

    {{-- sort --}}
    <script>
        // sort
        function sortColumn(column) {
            // Lấy các tham số hiện tại của trang
            const urlParams = new URLSearchParams(window.location.search);
            const currentSortBy = urlParams.get('sort_by');
            const currentSortOrder = urlParams.get('sort') || 'asc';

            // 
            const newSortOrder = (currentSortBy === column && currentSortOrder === 'asc') ? 'desc' : 'asc';

            // Cập nhật URL
            urlParams.set('sort_by', column);
            urlParams.set('sort', newSortOrder);
            window.location.search = urlParams.toString();
        }

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
