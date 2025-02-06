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

        <!-- Form to Create Design Category -->
        <h2>Create Design Category</h2>
        <form action="{{ route('category-design.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Category Name" required>
                <small class="text-danger" id="edit_name-error"></small>
            </div>
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Are you sure you want to add new Design Category?')">Create Category</button>
        </form>

        <hr>

        <!-- Form to Create Blueprint -->
        <h2>Create Blueprint</h2>
        <form action="{{ route('blueprints.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="blueprint_name" placeholder="Blueprint Name" class="form-control"
                    required>
                <small class="text-danger" id="name-error"></small>
            </div>

            <div class="form-group">
                <select name="categoryDesignID" id="categoryDesignID" class="form-control" required>
                    <option value="">Select Design Category</option>
                    @foreach ($categoryDesigns as $categoryD)
                        <option value="{{ $categoryD->categoryDesignID }}">{{ $categoryD->name }}</option>
                    @endforeach
                </select>
                <small class="text-danger" id="category-error">Please select a design category.</small>
            </div>

            <div class="form-group">
                <select name="designerID" id="designerID" class="form-control">
                    <option value="">Select Designer</option>
                    @foreach ($designers as $designer)
                        <option value="{{ $designer->designerID }}">{{ $designer->fullname }}</option>
                    @endforeach
                </select>
                <small class="text-danger" id="designer-error">Please select a designer.</small>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                <small class="text-danger" id="image-error">Please upload image < 2MB</small>
            </div>

            <button type="submit" id="submitBtn" class="btn btn-success">Create Blueprint</button>
        </form>

        <h2>List Design Category</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center">Design category Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryDesigns as $category_Design)
                    <tr>
                        <td>{{ $category_Design->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let debounceTimer;
            const submitButton = $('#submitBtn');
            const nameInput = $('#blueprint_name');
            const nameError = $('#name-error');
            const categorySelect = $('#categoryDesignID');
            const categoryError = $('#category-error');
            const designerSelect = $('#designerID');
            const designerError = $('#designer-error');
            const imageInput = $('#image');
            const imageError = $('#image-error');

            // Kiểm tra tên blueprint
            const checkName = () => {
                const name = nameInput.val().trim();
                if (name.length < 5) {
                    nameError.text('Blueprint name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    nameError.text('');
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
                            if (response.exists) {
                                nameError.text('Blueprint name already exists.');
                                // submitButton.prop('disabled', true);
                            } else {
                                nameError.text('');
                                // submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            nameError.text('Error checking blueprint name.');
                            // submitButton.prop('disabled', true);
                        }
                    });
                }, 300);
            };
            nameInput.on('input blur', checkName);

            // Kiểm tra category
            categorySelect.on('change', function() {
                if (!categorySelect.val()) {
                    categoryError.text('Please select a design category.');
                    // submitButton.prop('disabled', true);
                } else {
                    categoryError.text('');
                    checkFormValidity();
                }
            });

            // Kiểm tra designer
            designerSelect.on('change', function() {
                if (!designerSelect.val()) {
                    designerError.text('Please select a designer.');
                    // submitButton.prop('disabled', true);
                } else {
                    designerError.text('');
                    checkFormValidity();
                }
            });

            // Kiểm tra image ngay khi người dùng chọn file
            imageInput.on('change input', function() {
                const file = imageInput[0].files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file) {
                    const fileType = file.type.split('/')[0];
                    const fileSize = file.size;

                    if (fileType !== 'image') {
                        imageError.text('Only image files are allowed.');
                    } else if (fileSize > maxSize) {
                        imageError.text('File size must be less than 2MB.');
                    } else {
                        imageError.text('');
                        checkFormValidity();
                    }
                } else {
                    imageError.text('Please select an image file.');
                }
            });

            // Kiểm tra tính hợp lệ của form
            const checkFormValidity = () => {
                if (nameError.text() === '' && categoryError.text() === '' && designerError.text() === '' &&
                    imageError.text() === '') {
                    submitButton.prop('disabled', false);
                } else {
                    submitButton.prop('disabled', true);
                }
            };

            // Khi submit form, chỉ kiểm tra lại một lần nữa
            $('form').on('submit', function(e) {
                if (submitButton.prop('disabled')) {
                    e.preventDefault(); // Ngừng submit nếu form không hợp lệ
                }
            });
        });
    </script>

@endsection
