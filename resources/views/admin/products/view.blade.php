@extends('admin.layout.index')
@section('content')

    <div class="container mt-4">
        <h1>Product View</h1>

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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Actions</th> <!-- Added Actions column for Update/Delete -->
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('Asset/Image/product/' . $product->image) }}" alt="{{ $product->name }}"
                                    style="width: 50px; height: auto;">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Default Image"
                                    style="width: 50px; height: auto;">
                            @endif
                        </td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                        <td>{{ $product->brand->name ?? 'No Brand' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="showEditForm({{ $product }})"
                                data-toggle="modal" data-target="#updateProductModal">Update</button>
                            <form action="{{ route('products.destroy', $product->productID) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirmDelete()">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Update Product Modal -->
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
                    <form id="productEditForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="productID" id="editProductID">

                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" name="name" id="productName" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" class="form-control" name="price" id="productPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="productQuantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="productQuantity" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryID">Category</label>
                            <select class="form-control" name="categoryID" id="categoryID" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->categoryID }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brandID">Brand</label>
                            <select class="form-control" name="brandID" id="brandID" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->brandID }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Image</label>
                            <input type="file" class="form-control" name="image" id="productImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script-section')
    <script>
        function showEditForm(product) {
            document.getElementById('editProductID').value = product.productID;
            document.getElementById('productName').value = product.name;
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productQuantity').value = product.quantity;
            document.getElementById('categoryID').value = product.categoryID;
            document.getElementById('brandID').value = product.brandID;
            $('#updateProductModal').modal('show');

            // Set the action dynamically
            document.getElementById('productEditForm').action = `{{ url('admin/products/update') }}/${product.productID}`;
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
@endsection
