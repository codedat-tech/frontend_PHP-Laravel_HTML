@extends('admin.layout.index')
@section('content')

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($noResults)
            <div class="alert alert-warning">
                No product name found matching your search criteria.
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
        {{-- 1. pages --}}
        <form action="{{ route('products.index') }}" method="GET">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Product List</h2>
                <div class="d-flex align-items-center">
                    <input type="number" name="paginate" class="form-control" value="{{ request()->paginate ?? 10 }}"
                        size="2" style="width: 70px; overflow-y: scroll;" onchange="this.form.submit()">
                    <span style="margin-left: 5px;">entries per page</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by product name"
                            value="{{ request()->search }}" size="50">
                    </div>
                    <div class="mr-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- 1.1 view table --}}
        <table class="table table-bordered">
            <thead>
                <tr style="text-align:center">

                    <th>Product Name
                        <a href="javascript:void(0);" onclick="sortColumn('name')" class="sort-link" id="sort-name">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'name' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Category
                        <a href="javascript:void(0);" onclick="sortColumn('category')" class="sort-link" id="sort-category">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'category' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Brand
                        <a href="javascript:void(0);" onclick="sortColumn('brand')" class="sort-link" id="sort-brand">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'brand' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Price
                        <a href="javascript:void(0);" onclick="sortColumn('price')" class="sort-link" id="sort-price">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'price' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    <th>Qty InStock
                        <a href="javascript:void(0);" onclick="sortColumn('quantityInStock')" class="sort-link"
                            id="sort-quantityInStock">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'quantityInStock' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th>

                    {{-- <th>In Stocked
                        <a href="javascript:void(0);" onclick="sortColumn('inStocked')" class="sort-link"
                            id="sort-inStocked">
                            <i
                                class="fas fa-angle-{{ request()->get('sort_by') === 'inStocked' && request()->get('sort') === 'asc' ? 'up' : 'down' }}"></i>
                        </a>
                    </th> --}}

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
            <tbody id="product-table-body">
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="javascript:void(0)" onclick="showEditForm({{ $product }})"
                                style="text-decoration: underline; cursor: pointer;">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                        <td>{{ $product->brand->name ?? 'No Brand' }}</td>
                        <td style="text-align:center">${{ $product->price }}</td>
                        <td style="text-align:center">{{ $product->quantityInStock }}</td>
                        {{-- <td style="text-align:center">{{ $product->inStocked }}</td> --}}

                        <td style="text-align:center">
                            @if ($product->image)
                                <img src="{{ asset('Asset/Image/product/' . $product->image) }}"
                                    alt="{{ $product->image }}" style="width: 70%; height: 80px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Default Image"
                                    style="width: 70%; height: 80px; object-fit: cover;">
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="showEditForm({{ $product }})"
                                data-toggle="modal" data-target="#updateProductModal">Update</button>

                            <form action="{{ route('products.toggleStatus', $product->productID) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    {{ $product->status ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center" style="margin:20px 0; margin-left: -200px">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- 2. Update Product Modal -->
    <div class="modal fade" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="productID" id="editProductID">

                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" name="name" id="productName"
                                value="{{ $product->name }}" data-old-name="{{ $product->name }}" required>
                            <small class="text-danger" id="name-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="numeric" class="form-control" name="price" id="productPrice" required>
                            <small class="text-danger" id="price-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="productQuantityInStock">QuantityInStock</label>
                            <input type="number" class="form-control" name="quantityInStock"
                                id="productQuantityInStock">
                            <small class="text-danger" id="quantity-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="InStocked" hidden>In Stocked</label>
                            <input type="number" class="form-control" name="inStocked" id="InStocked" hidden>
                            <small class="text-danger" id="inStocked-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="categoryID">Category</label>
                            <select class="form-control" name="categoryID" id="categoryID" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="category-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="brandID">Brand</label>
                            <select class="form-control" name="brandID" id="brandID" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->brandID }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="brand-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                            <small class="text-danger" id="description-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Current Image:</label><br>
                            <img id="edit_currentImage" src="" alt=""
                                style="width: 300px; height: auto;">
                            <p id="edit_imageName"></p>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Image</label>
                            <input type="file" class="form-control" name="image" id="productImage">
                            <small class="text-danger" id="image-error"></small>
                        </div>
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Are you sure you want to update?')">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showEditForm(product) {
            document.getElementById('editProductID').value = product.productID;
            document.getElementById('productName').value = product.name;
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productQuantityInStock').value = product.quantityInStock;
            // document.getElementById('InStocked').value = product.inStocked;
            document.getElementById('InStocked').value = product.quantityInStock;

            document.getElementById('categoryID').value = product.categoryID;
            document.getElementById('brandID').value = product.brandID;
            document.getElementById('description').value = product.description;
            document.getElementById('status').value = product.status;

            if (product.image) {
                document.getElementById('edit_currentImage').src = `/Asset/Image/product/${product.image}`;
                document.getElementById('edit_imageName').innerText = product.image;
            } else {
                document.getElementById('edit_currentImage').src = '';
                document.getElementById('edit_imageName').innerText = 'No image available';
            }
            $('#updateProductModal').modal('show');

            // Set the action dynamically
            document.getElementById('editProductForm').action =
                `{{ url('admin/products/update') }}/${product.productID}`;

            // Store the old product name to compare
            productNameOld = product.name;
        }

        $(document).ready(function() {
            let debounceTimer;
            const submitButton = $('#editProductForm button[type="submit"]');

            const checkName = () => {
                const name = $('#productName').val().trim();
                console.log("Current product name:", name);

                if (name.length < 5) {
                    $('#name-error').text('Product name must be at least 5 characters.');
                    submitButton.prop('disabled', true);
                    return;
                } else {
                    $('#name-error').text('');
                }

                // Only check if name has changed
                if (name === productNameOld) {
                    $('#name-error').text('');
                    submitButton.prop('disabled', false);
                    return;
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
                            console.log("AJAX response:", response);

                            // If the name is different, check if it already exists
                            if (response.exists) {
                                $('#name-error').text('Product name already exists.');
                                submitButton.prop('disabled', true);
                            } else {
                                $('#name-error').text('');
                                submitButton.prop('disabled', false);
                            }
                        },
                        error: function() {
                            $('#name-error').text('Error checking product name.');
                            submitButton.prop('disabled', true);
                        }
                    });
                }, 300); // Debounce time
            };

            $('#productName').on('input', checkName); // Use input event instead of change

            // 2. Image check
            const checkImage = () => {
                const file = $('input[name="image"]')[0].files[0];
                const fileName = file ? file.name : '';
                const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

                if (!allowedExtensions.exec(fileName)) {
                    $('#image-error').text('Nullable. Only JPG, JPEG, PNG, and GIF files are allowed.');
                    $('input[name="image"]').val(''); // Clear input
                    return;
                } else {
                    $('#image-error').text('');
                }

                $.ajax({
                    url: "{{ route('products.checkImageName') }}",
                    method: 'POST',
                    data: {
                        imageName: fileName,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#image-error').text(
                                'Image with this name already exists. Please rename your file.');
                        } else {
                            $('#image-error').text('');
                        }
                    },
                    error: function() {
                        $('#image-error').text('Error checking image name.');
                    }
                });
            };
            $('input[name="image"]').on('change', checkImage);

            // 3.Price check
            const checkPrice = () => {
                const price = parseFloat($('#productPrice').val());
                if (isNaN(price) || price <= 0) {
                    $('#price-error').text('Price must be a positive number.');
                } else {
                    $('#price-error').text('');
                }
            };
            $('#productPrice').on('input', checkPrice);

            // 4. Quantity In Stock > 0
            const checkQuantityInStock = () => {
                const quantity = parseInt($('#productQuantityInStock').val());
                if (isNaN(quantity) || quantity <= 0) {
                    $('#quantity-error').text('Quantity in stock must be a positive integer.');
                } else {
                    $('#quantity-error').text('');
                }
            };
            $('#productQuantityInStock').on('input', checkQuantityInStock);

            // 5. Quantity In Stock >= InStocked > 0
            const checkInStocked = () => {
                const instocked = parseInt($('#InStocked').val());
                const quantity = parseInt($('#productQuantityInStock').val());
                if (isNaN(instocked) || instocked <= 0) {
                    $('#inStocked-error').text('Quantity must be a positive integer.');
                } else if (instocked > quantity) {
                    $('#inStocked-error').text(
                        'Quantity in stock cannot be greater than the available quantity.');
                } else {
                    $('#inStocked-error').text('');
                }
            };
            $('#InStocked').on('input', checkInStocked);

            // 6. Category được chọn
            const checkCategory = () => {
                if ($('#categoryID').val() === "") {
                    $('#category-error').text('Please select a category.');
                } else {
                    $('#category-error').text('');
                }
            };
            $('#categoryID').on('change', checkCategory);

            // 7. Brand được chọn
            const checkBrand = () => {
                if ($('#brandID').val() === "") {
                    $('#brand-error').text('Please select a brand.');
                } else {
                    $('#brand-error').text('');
                }
            };
            $('#brandID').on('change', checkBrand);

            // 8. Description
            const checkDescription = () => {
                if ($('#description').val().trim().length < 5) {
                    $('#description-error').text('Description must be at least 5 characters.');
                } else {
                    $('#description-error').text('');
                }
            };
            $('#description').on('input', checkDescription);
        });

        function sortColumn(column) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentSortBy = urlParams.get('sort_by');
            const currentSortOrder = urlParams.get('sort') || 'asc';

            const newSortOrder = (currentSortBy === column && currentSortOrder === 'asc') ? 'desc' : 'asc';

            urlParams.set('sort_by', column);
            urlParams.set('sort', newSortOrder);
            window.location.search = urlParams.toString();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['name', 'category', 'brand', 'price', 'quantityInStock', 'inStocked', 'status'];
            const currentSortBy = new URLSearchParams(window.location.search).get('sort_by');

            columns.forEach(column => {
                const link = document.getElementById(`sort-${column}`);
                if (link) {
                    if (column === currentSortBy) {
                        link.classList.add('active-sort');
                        link.style.opacity = 1;
                    } else {
                        link.classList.remove('active-sort');
                        link.style.opacity = 0.3;
                    }
                }
            });
        });
    </script>

@endsection
