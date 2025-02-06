@extends('admin.layout.index')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No blueprint name found matching your search criteria.
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
        <form action="{{ route('blueprints.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Blueprint List</h2>

                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 5 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search by blueprint name, design category or desiner"
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- view table --}}
        <table class="table table-striped">
            <colgroup>
                <col style="width: 22%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 25%;">
                <col style="width: 15%;">
                <col style="width: 8%;">
            </colgroup>
            <thead>
                <tr style="text-align: center">

                    <th>Blueprint Name
                        <a href="javascript:void(0);" onclick="sortColumn('name')" class="sort-link" id="sort-name">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'name' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Design Category
                        <a href="javascript:void(0);" onclick="sortColumn('category')" class="sort-link" id="sort-category">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'category' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Designer
                        <a href="javascript:void(0);" onclick="sortColumn('designer')" class="sort-link" id="sort-designer">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'designer' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
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
                @foreach ($blueprints as $blueprint)
                    <tr>
                        <td>
                            <a href="javascript:void(0)" onclick="editBlueprint({{ $blueprint }})"
                                style="text-decoration: underline; cursor: pointer;">
                                {{ $blueprint->name }}</a>

                        </td>


                        <td>{{ $blueprint->categoryDesign->name }}</td>
                        <td>
                            @if ($blueprint->designer)
                                <a href="javascript:void(0)" onclick="viewDesigner({{ $blueprint->designer->designerID }})"
                                    style="text-decoration: underline; cursor: pointer;">
                                    {{ $blueprint->designer->fullname }}</a>
                            @else
                                No Designer
                            @endif
                        </td>
                        <td>
                            @if ($blueprint->image)
                                <img src="{{ asset('Asset/Image/blueprint/' . $blueprint->image) }}"
                                    alt="{{ $blueprint->image }}" style="width: 70%; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Default Image"
                                    style="width: 70%; height: 80px; object-fit: cover;">
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editBlueprint({{ $blueprint }})"
                                data-toggle="modal" data-target="#editBlueprintModal">Update</button>

                            <form action="{{ route('blueprints.toggleStatus', $blueprint->blueprintID) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $blueprint->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            {{ $blueprint->status ? 'Active' : 'Inactive' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $blueprints->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- 3.view Déigner --}}
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
                                <img id="view_image1" src="" alt="" style="width: 300px; height: auto;">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 2.Edit Modal -->
    <div class="modal fade" id="editBlueprintModal" tabindex="-1" role="dialog"
        aria-labelledby="editBlueprintModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlueprintModalLabel">Update Blueprint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="blueprintEditForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editBlueprintID" name="blueprintID">

                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                value="{{ $blueprint->name }}" data-old-name="{{ $blueprint->name }}" required>
                            <small class="text-danger" id="name-error"></small>
                        </div>

                        <div class="mb-3">
                            <label for="edit_categoryD" class="form-label">Design Category</label>
                            <select name="categoryDesignID" class="form-control" id="edit_categoryD" required>
                                <option value="">Select Design Category</option>
                                @foreach ($categoryDesigns as $categoryD)
                                    <option value="{{ $categoryD->categoryDesignID }}">{{ $categoryD->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_designer" class="form-label">Designer</label>
                            <select name="designerID" class="form-control" id="edit_designer" required>
                                <option value="">Select Designer</option>
                                @foreach ($designers as $designer)
                                    <option value="{{ $designer->designerID }}">{{ $designer->fullname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <div id="edit_imageName" class="mb-3"></div>
                            <img id="edit_currentImage" src="" alt="Blueprint Image" class="img-thumbnail"
                                style="width: 300px;">
                        </div>

                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Upload New Image</label>
                            <input type="file" class="form-control" id="edit_image" name="image"
                                accept="./Asset/Image/blueprint/">
                            <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
                        </div>

                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBlueprintBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function editBlueprint(blueprint) {
            document.getElementById('editBlueprintID').value = blueprint.blueprintID;
            document.getElementById('edit_name').value = blueprint.name;
            document.getElementById('edit_categoryD').value = blueprint.categoryDesignID;
            document.getElementById('edit_designer').value = blueprint.designerID;
            document.getElementById('edit_status').value = blueprint.status;

            // Hiển thị hình ảnh cũ
            if (blueprint.image) {
                document.getElementById('edit_currentImage').src = `/Asset/Image/blueprint/${blueprint.image}`;
                document.getElementById('edit_imageName').innerText = blueprint.image;
            } else {
                document.getElementById('edit_currentImage').src = '';
                document.getElementById('edit_imageName').innerText = 'No image available';
            }
            $('#editBlueprintModal').modal('show');

            // Set the form action
            document.getElementById('blueprintEditForm').action =
                `{{ url('admin/blueprints/update') }}/${blueprint.blueprintID}`;
            blueprintNameOld = blueprint.name;
        }

        $(document).ready(function() {
            let debounceTimer;
            const submitButton = $('#blueprintEditForm button[type="submit"]');

            const checkName = () => {
                const name = $('#edit_name').val().trim();
                console.log("Current product name:", name);

                if (name.length < 5) {
                    $('#name-error').text('Blueprint name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    $('#name-error').text('');
                }

                // Only check if name has changed
                if (name === blueprintNameOld) {
                    $('#name-error').text('');
                    submitButton.prop('disabled', false);
                    return;
                }

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('blueprints.checkName') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log("AJAX response:", response);

                            // If the name is different, check if it already exists
                            if (response.exists) {
                                $('#name-error').text('Blueprint name already exists.');
                                submitButton.prop('disabled', true);
                            } else {
                                $('#name-error').text('');
                                submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            $('#name-error').text('Error checking blueprint name.');
                            submitButton.prop('disabled', true);
                        }
                    });
                }, 300); // Debounce time
            };

            $('#edit_name').on('blur input', checkName); // Use input event instead of change
        });

        {{-- 2.view déigner --}}

        function viewDesigner(id) {
            $.ajax({
                url: `/designers/${id}/edit`,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('view_fullname').innerText = data.fullname;
                    document.getElementById('view_email').innerText = data.email;
                    document.getElementById('view_phone').innerText = data.phone;
                    document.getElementById('view_address').innerText = data.address;
                    document.getElementById('view_portfolio').innerText = data.portfolio;
                    document.getElementById('view_experienceYear').innerText = data.experienceYear;
                    document.getElementById('view_specialization').innerText = data.specialization;
                    document.getElementById('view_rating').innerText = data.rating;
                    document.getElementById('view_status').innerText = data.status == 1 ? 'Active' :
                        'Inactive';
                    document.getElementById('view_image1').src = `/Asset/Image/designer/${data.image}`;
                    const portfolioLink = document.getElementById('view_portfolio');
                    portfolioLink.href = `/Asset/PDF/portfolio/${data.portfolio}`;
                    portfolioLink.innerText = data.portfolio ? "View Portfolio" : "No Portfolio Available";

                    $('#viewDesignerModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching designer details:', error);
                }
            })
        }
    </script>
    {{-- 3. sỏrt --}}
    <script>
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

        // set style cursor
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['name', 'category', 'designer', 'status'];
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
