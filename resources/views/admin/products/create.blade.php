@extends('admin.layout.index')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3 class="h3">Add New Product</h3>
        <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="productName" class="form-control" placeholder="Product Name"
                    required>
                <small class="text-danger" id="name-error"></small>
            </div>

            <div class="form-group mb-3">
                <label for="price">Product Price</label>
                <input type="number" step="0.01" name="price" id="productPrice" class="form-control"
                    placeholder="Product Price" required>
                <small class="text-danger" id="price-error"></small>
            </div>

            <div class="form-group mb-3">
                <label for="quantityInStock">Product Quantity In Stock</label>
                <input type="number" name="quantityInStock" id="quantityInStock" class="form-control"
                    placeholder="Product Quantity" required>
                <small class="text-danger" id="quantity-error"></small>
            </div>

            <div class="form-group mb-3" style="display: none;" id="inStockedGroup">
                <label for="InStocked">In Stocked</label>
                <input type="number" name="inStocked" id="InStocked" class="form-control" placeholder="In Stock" readonly>
                <small class="text-danger" id="instock-error"></small>
            </div>

            <div class="form-group mb-3">
                <label for="categoryID">Category</label>
                <select name="categoryID" id="categoryID" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <small class="text-danger" id="category-error"></small>
            </div>

            <div class="form-group mb-3">
                <label for="brandID">Brand</label>
                <select name="brandID" id="brandID" class="form-control" required>
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brandID }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <small class="text-danger" id="brand-error"></small>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
                <small class="text-danger" id="description-error"></small>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="productImage" class="form-control-file" accept="image/*">
                <small class="text-danger" id="image-error"></small>
            </div>

            <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to save?')">Add
                Product</button>
        </form>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let debounceTimer;
            // 1. Product Name && duplicate
            const checkProductName = () => {
                const errorField = $('#name-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                const name = $('#productName').val().trim();
                if (name.length < 5) {
                    errorField.text('Product name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', false);
                }

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('products.checkName') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.exists) {
                                errorField.text('Product name already exists.');
                                submitButton.prop('disabled', true);
                            } else {
                                errorField.text('');
                                submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            errorField.text('Error checking product name.');
                            submitButton.prop('disabled', true);
                        }
                    });
                }, 300);
            };
            $('#productName').on('blur input', function() {
                checkProductName();
            });

            // 2. Image duplicate check
            const checkImage = () => {
                const errorField = $('#image-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                const file = $('#productImage')[0].files[0];
                const fileName = file ? file.name : '';
                const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if (!allowedExtensions.exec(fileName)) {
                    errorField.text('Only JPG, JPEG, PNG, and GIF files are allowed.');
                    $('#productImage').val('');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    errorField.text('');
                }
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('products.checkImageName') }}",
                        method: 'POST',
                        data: {
                            imageName: fileName,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.exists) {
                                errorField.text(
                                    'Image with this name already exists.'
                                );
                                submitButton.prop('disabled', true);
                            } else {
                                errorField.text('');
                                submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            errorField.text('Error checking image name.');
                            submitButton.prop('disabled', true);
                        }
                    });
                }, 300);
            };
            $('#productImage').on('change', checkImage);

            // 3.Price check
            const checkPrice = () => {
                const errorField = $('#price-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                const price = parseFloat($('#productPrice').val());
                if (isNaN(price) || price <= 0) {
                    errorField.text('Price must be a positive number.');
                    submitButton.prop('disabled', true);
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', true);
                }
            };
            $('#productPrice').on('blur input', checkPrice);

            // 4. Quantity In Stock > 0
            const checkQuantityInStock = () => {
                const errorField = $('#quantity-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                const quantity = parseInt($('#quantityInStock').val());
                if (isNaN(quantity) || quantity <= 0) {
                    errorField.text('Quantity in stock must be a positive integer.');
                    submitButton.prop('disabled', true);
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', true);
                }
            };
            $('#quantityInStock').on('blur input', checkQuantityInStock);

            // 5. Quantity In Stock >= InStocked > 0
            const checkInStocked = () => {
                const errorField = $('#instock-error');
                const instocked = parseInt($('#InStocked').val());
                const quantity = parseInt($('#quantityInStock').val());
                if (isNaN(instocked) || instocked <= 0) {
                    errorField.text('Quantity must be a positive integer.');
                } else if (instocked > quantity) {
                    errorField.text(
                        'Quantity in stock cannot be greater than the available quantity.');
                    submitButton.prop('disabled', true);
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', true);
                }
            };
            $('#InStocked').on('blur input', checkInStocked);

            // 6. Category được chọn
            const checkCategory = () => {
                const errorField = $('#category-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                if ($('#categoryID').val() === "") {
                    $('#category-error').text('Please select a category.');
                    submitButton.prop('disabled', true);
                } else {
                    $('#category-error').text('');
                    submitButton.prop('disabled', true);
                }
            };
            checkCategory();
            $('#categoryID').on('blur change', checkCategory);

            // 7. Brand được chọn
            const checkBrand = () => {
                const errorField = $('#brand-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                if ($('#brandID').val() === "") {
                    errorField.text('Please select a brand.');
                    submitButton.prop('disabled', true);
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', true);
                }
            };
            checkBrand();
            $('#brandID').on('blur change', checkBrand);

            // 8. Description
            const checkDescription = () => {
                const description = $('#description').val().trim();
                const errorField = $('#description-error');
                const submitButton = $('#addProductForm button[type="submit"]');
                if (description.length < 5) {
                    errorField.text('Description must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                } else {
                    errorField.text('');
                    submitButton.prop('disabled', false);
                }
            };
            checkDescription();
            $('#description').on('blur input', checkDescription);
        });
        document.getElementById('quantityInStock').addEventListener('input', function() {
            var quantity = this.value; // Lấy giá trị từ trường quantityInStock
            var inStockedInput = document.getElement ById('InStocked'); // Lấy trường inStocked
            inStockedInput.value = quantity; // Gán giá trị cho trường inStocked
            document.getElementById('inStockedGroup').style.display = 'block'; // Hiện trường inStocked
        });
    </script>
@endsection
